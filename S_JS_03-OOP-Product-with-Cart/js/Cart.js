
export default class Cart {
  #_cartList;

  constructor(cartList) {
    this.#_cartList = cartList;
  }

  get cartList() {
    return this.#_cartList;
  }

  set cartList(newCartList) {
    this.#_cartList = newCartList;
  }

  pushToCart(item) {
    this.cartList.push(item);
  }

  calculateSubTotal() {
    return this.cartList
      .map((cartLine) => {
        return cartLine.calculateTotal();
      })
      .reduce((subTotal, total) => (subTotal += total), 0);
  }

  calculateShipping() {
    return this.cartList.length * 10;
  }

  calculateCartTotal() {
    return this.calculateSubTotal() + this.calculateShipping();
  }

  removeCartLine(index) {
    if (index < this.cartList.length) {
      this.cartList.splice(index, 1);
      return true;
    } else {
      return false;
    }
  }

}
