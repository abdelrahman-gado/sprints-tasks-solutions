import { Component } from "@angular/core";
import { FormControl, FormGroup, Validators } from "@angular/forms";
import { Router } from "@angular/router";
import { Order } from "src/app/classes/order";
import { AuthService } from "src/app/services/auth.service";
import { OrderService } from "src/app/services/order.service";
import { StorageService } from "src/app/services/storage.service";

@Component({
  selector: "app-checkout",
  templateUrl: "./checkout.component.html",
  styleUrls: ["./checkout.component.css"],
})
export class CheckoutComponent {
  order: Order;

  orderForm = new FormGroup({
    first_name: new FormControl("", [
      Validators.required,
      Validators.minLength(3),
    ]),
    last_name: new FormControl("", [
      Validators.required,
      Validators.minLength(3),
    ]),
    email: new FormControl("", [Validators.required, Validators.email]),
    mobile_number: new FormControl("", [
      Validators.required,
      Validators.minLength(11),
      Validators.pattern("[0-9]*"),
    ]),
    address1: new FormControl("", [Validators.required]),
    address2: new FormControl(""),
    country: new FormControl("Egypt", [Validators.required]),
    city: new FormControl("", [Validators.required]),
    state: new FormControl("", [Validators.required]),
    zip_code: new FormControl("", Validators.required),
  });

  constructor(
    private storageService: StorageService,
    private authService: AuthService,
    private orderService: OrderService,
    private router: Router
  ) {
    const cart = this.storageService.getCartObject();
    this.order = new Order(cart);
  }


  placeOrder() {
    if (this.orderForm.valid) {

      const userToken = this.authService.getToken();
      const user_id = this.authService.getUserId();

      const orderObject = this.order.createOrderObject(this.orderForm.value, user_id);
      
      this.orderService.addOrder(orderObject, userToken).subscribe({
        next: (data: any) => {
          alert("Your order is submitted successfully");
          this.router.navigate(["/home"]);
        },
        error: (errors: any) => {
          alert(errors.error);
        },
      });
    }
  }

  get c() {
    return this.orderForm.controls;
  }
}
