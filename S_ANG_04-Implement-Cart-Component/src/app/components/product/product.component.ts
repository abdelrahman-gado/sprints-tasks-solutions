import { Component, Input } from '@angular/core';
import { Product } from 'src/app/classes/product';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css'],
})
export class ProductComponent {
  @Input() product: Product = {} as Product;

  constructor(private storageService: StorageService) { }

  addProductToCart() {
    this.storageService.addProduct(this.product, 1);
  }
}
