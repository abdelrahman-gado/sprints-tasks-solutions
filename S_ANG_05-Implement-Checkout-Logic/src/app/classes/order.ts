import { Cart } from "./cart";

export class Order {
  cart: Cart;

  constructor(cart: Cart) {
    this.cart = cart;
  }

  
  createOrderObject(orderFormData: any, user_id: string) {
    /**
     * Create Object that will be posted to the api using the data from the form and user_id
     */
    return {
      sub_total_price: this.cart.getSubTotal(),
      shipping: this.cart.getShipping(),
      total_price: this.cart.getTotal(),
      user_id: user_id,
      order_date: new Date().toISOString(),
      order_details: this.cart.cartList.map((cartLine) => {
        return {
          product_id: cartLine.product._id,
          price: cartLine.price,
          qty: cartLine.quantity,
        };
      }),
      shipping_info: orderFormData,
    };
  }


}
