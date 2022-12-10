import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CartComponent } from './components/cart/cart.component';
import { CheckoutComponent } from './components/checkout/checkout.component';
import { ContactComponent } from './components/contact/contact.component';
import { HomeComponent } from './components/home/home.component';
import { ShopDetailComponent } from './components/shop-detail/shop-detail.component';
import { ShopComponent } from './components/shop/shop.component';

const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'shop', component: ShopComponent },
  { path: 'detail', component: ShopDetailComponent },
  { path: 'pages/cart', component: CartComponent },
  { path: 'pages/checkout', component: CheckoutComponent },
  { path: 'contact', component: ContactComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
