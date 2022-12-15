import { NgModule } from "@angular/core";
import { RouterModule, Routes } from "@angular/router";
import { CheckoutComponent } from "./components/checkout/checkout.component";
import { ContactComponent } from "./components/contact/contact.component";
import { CartComponent } from "./components/layouts/cart/cart.component";
import { DetailComponent } from "./components/layouts/detail/detail.component";
import { HomeComponent } from "./components/layouts/home/home.component";
import { ShopComponent } from "./components/layouts/shop/shop.component";
import { LoginComponent } from "./components/login/login.component";
import { RegisterComponent } from "./components/register/register.component";
import { AuthGuard } from "./services/auth.guard";

const routes: Routes = [
  { path: "home", component: HomeComponent },
  { path: "", redirectTo: "/home", pathMatch: "full" },
  { path: "shop", component: ShopComponent },
  {path: "contact", component: ContactComponent},
  { path: "pages/cart", component: CartComponent },
  {
    path: "pages/checkout",
    component: CheckoutComponent,
    canActivate: [AuthGuard],
  },
  { path: "detail/:id", component: DetailComponent },
  { path: "login", component: LoginComponent },
  { path: "register", component: RegisterComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
