import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { environment } from "src/environment/environment";

@Injectable({
  providedIn: "root",
})
export class OrderService {
  constructor(private httpClient: HttpClient) {}

  getOrdersData() {
    return this.httpClient.get(`${environment.apiUrl}orders`);
  }

  addOrder(order: any, userToken: string) {
    const headers = new HttpHeaders({
      "Content-Type": "application/json",
      "x-access-token": userToken,
    });

    return this.httpClient.post(`${environment.apiUrl}orders`, order, {headers});
  }
}
