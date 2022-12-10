import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environment/environment';
import { Product } from '../interfaces/product';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  likedList: Product[] = [];

  constructor(private httpClient: HttpClient) { }


  getProducts() {
    return this.httpClient.get(`${environment.baseAPIUrl}products/getRecent`);
  }

  updateLocalStorage() {
    localStorage.setItem('liked', JSON.stringify(this.likedList));    
  }

  addTolikedList(product: Product) {

    // Get liked products from local storage.
    this.likedList = JSON.parse(localStorage.getItem('liked') || '[]');

    // Check if the object is had added already to the liked list.
    if (this.likedList.findIndex((p) => p._id === product._id) < 0) {
      this.likedList.push(product);
    }
    
    this.updateLocalStorage();
    return;
  }
}
