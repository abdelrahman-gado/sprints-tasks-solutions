import { Component, Input, OnInit } from '@angular/core';
import { Product } from 'src/app/classes/product';
import { ProductService } from 'src/app/services/product.service';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css'],
})
export class ProductsComponent implements OnInit {
  @Input() title: string = '';
  @Input() type: string = '';
  products: Product[] = [];
  constructor(private productService: ProductService) {}

  ngOnInit() {
    const getProducts = (data: any) => {
      this.products = data.data as Product[];
    };
    
    if (this.type == 'featured') {
      this.productService.getFeaturedProducts().subscribe(getProducts);
    } else {
      this.productService.getRecentProducts().subscribe(getProducts);
    }
  }
}
