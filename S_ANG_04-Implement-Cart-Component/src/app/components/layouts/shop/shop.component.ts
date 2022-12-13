import { Component, OnInit } from "@angular/core";
import { Product } from "src/app/classes/product";
import { ProductService } from "src/app/services/product.service";

@Component({
  selector: "app-shop",
  templateUrl: "./shop.component.html",
  styleUrls: ["./shop.component.css"],
})
export class ShopComponent implements OnInit {
  products: Product[] = [];
  filter: any = {
    prices: [{ min: 0, max: 0 }],
    sizes: [""],
    colors: [""],
  };

  pageNumber: number = 0;
  itemsPerPage: number = 2;

  constructor(private productService: ProductService) {}

  ngOnInit(): void {
    this.productService.getProducts().subscribe((data: any) => {
      this.products = data.data as Product[];
    });
  }

  getFilteredProducts(): Product[] {
    return this.products.filter(
      (p) => this.filterPrice(p) && this.filterColor(p) && this.filterSize(p)
    );
  }

  getProducts(): Product[] {
    return this.products
      .filter(
        (p) => this.filterPrice(p) && this.filterColor(p) && this.filterSize(p)
      )
      .slice(
        this.pageNumber * this.itemsPerPage,
        (this.pageNumber * this.itemsPerPage) + this.itemsPerPage
       ); 
  }

  getTotalCount(): number {
    return this.getFilteredProducts().length;
  }

  filterChange(filter: any) {
    this.filter = filter;
  }

  filterPrice(p: Product) {
    return (
      this.filter.prices.findIndex(
        (price: any) =>
          (price.min <= p.price && price.max >= p.price) ||
          (price.min == 0 && price.max == 0)
      ) >= 0
    );
  }

  filterColor(p: Product) {
    if (this.filter.colors.includes("")) {
      return true;
    }
    return this.filter.colors.includes(p.color);
  }

  filterSize(p: Product) {
    if (this.filter.sizes.includes("")) {
      return true;
    }

    return this.filter.sizes.includes(p.size);
  }


  changePage(i: number) {
    this.pageNumber = i;
  }
}
