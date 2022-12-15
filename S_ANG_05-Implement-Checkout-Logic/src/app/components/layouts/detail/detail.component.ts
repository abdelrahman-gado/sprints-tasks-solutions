import { AfterViewInit, Component, OnDestroy, OnInit } from "@angular/core";
import { ActivatedRoute, Router } from "@angular/router";
import { Product } from "src/app/classes/product";
import { ColorService } from "src/app/services/color.service";
import { ProductService } from "src/app/services/product.service";
import { SizeService } from "src/app/services/size.service";
import { StorageService } from "src/app/services/storage.service";

declare var $: any;

@Component({
  selector: "app-detail",
  templateUrl: "./detail.component.html",
  styleUrls: ["./detail.component.css"],
})
export class DetailComponent implements AfterViewInit, OnInit {
  id: string = "";
  product: Product = {} as Product;
  products: Product[] = [];
  quantity: number = 1;
  color: string = "";
  colors: string[] = [];

  size: string = "";
  sizes: string[] = [];

  constructor(
    private activatedRoute: ActivatedRoute,
    private productService: ProductService,
    private colorService: ColorService,
    private sizeService: SizeService,
    private storageService: StorageService,
    private router: Router
  ) {}

  ngAfterViewInit(): void {
    // Related carousel
    setTimeout(() => {
      $(".related-carousel").owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
          0: {
            items: 1,
          },
          576: {
            items: 2,
          },
          768: {
            items: 3,
          },
          992: {
            items: 4,
          },
        },
      });
    }, 1000);
  }

  ngOnInit(): void {
    this.activatedRoute.params.subscribe((params) => {
      this.id = params["id"];
    });

    this.productService.getProductById(this.id).subscribe((data: any) => {
      const p = data.data;
      this.product = p as Product;
      this.color = this.product.color;
      this.size = this.product.size;
      this.productService
        .getProductsByCategoryId(this.product.category_id)
        .subscribe((data: any) => {
          this.products = data.data as Product[];
        });
    });

    this.colors = this.colorService.getColors();
    this.sizes = this.sizeService.getSizes();
  }

  incQuantity() {
    this.quantity = Number(this.quantity) + 1;
  }

  decQuantity() {
    if (this.quantity > 1) this.quantity = Number(this.quantity) - 1;
  }

  addToCartWithQuantity() {
    this.storageService.addProduct(this.product, this.quantity);
    this.router.navigate(["/pages", "cart"]);
  }
}
