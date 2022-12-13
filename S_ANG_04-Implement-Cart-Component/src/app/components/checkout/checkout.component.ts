import { Component } from '@angular/core';
import { Cart } from 'src/app/classes/cart';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent {

  cart: Cart;
  
  constructor(private storageService: StorageService) {
    this.cart = storageService.getCartObject();
  }

}
