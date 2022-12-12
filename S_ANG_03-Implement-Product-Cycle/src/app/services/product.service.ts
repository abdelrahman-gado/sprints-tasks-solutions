import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environment/environment';
import { Product } from '../interfaces/product';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  cartProducts: Product[] = [];

  constructor(private httpClient: HttpClient) { }

  getFeaturedProducts(): any{
    return this.httpClient.get(`${environment.apiUrl}products/getFeatured`);
  }

  getRecentProducts(): any {
    return this.httpClient.get(`${environment.apiUrl}products/getRecent`);
  }

  addProduct(product: Product): void {
    this.cartProducts.push(product);
  }

  getProductById(id: string) {
    return this.httpClient.get(`${environment.apiUrl}products/${id}`);
  }

  getProductsByCategoryId(id: string) {
    return this.httpClient.get(`${environment.apiUrl}products/getByCategoryId/${id}`);
  }
}
