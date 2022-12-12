import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app-component/app.component';
import { HeaderComponent } from './components/layouts/header/header.component';
import { FooterComponent } from './components/layouts/footer/footer.component';
import { HomeComponent } from './components/layouts/home/home.component';
import { FormsModule } from '@angular/forms';
import { ShopComponent } from './components/layouts/shop/shop.component';
import { CategoriesComponent } from './components/categories/categories.component';
import { CategoryComponent } from './components/category/category.component';
import { ProductComponent } from './components/product/product.component';
import { StarsComponent } from './components/stars/stars.component';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { ProductsComponent } from './components/products/products.component';
import { CartComponent } from './components/layouts/cart/cart.component';
import { CartTableComponent } from './components/cart-table/cart-table.component';
import { CartTotalComponent } from './components/cart-total/cart-total.component';
import { DetailComponent } from './components/layouts/detail/detail.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomeComponent,
    ShopComponent,
    CategoriesComponent,
    CategoryComponent,
    ProductComponent,
    StarsComponent,
    ProductsComponent,
    CartComponent,
    CartTableComponent,
    CartTotalComponent,
    DetailComponent,
  ],
  imports: [BrowserModule, AppRoutingModule, FormsModule, HttpClientModule],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
