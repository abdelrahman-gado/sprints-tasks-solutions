
export default class CartLine {
  #_id;
  #_product;
  #_quantity;

  constructor(id, product, quantity) {
    this.#_id = id;
    this.#_product = product;
    this.#_quantity = quantity;
  }

  get id() {
    return this.#_id;
  }

  get product() {
    return this.#_product;
  }

  get quantity() {
    return this.#_quantity;
  }

  set quantity(newQuantity) {
    this.#_quantity = newQuantity;
  }

  decQuantity() {
    if (this.quantity <= 1) {
      return;
    }

    this.quantity = this.quantity - 1;
  }

  incQuantity() {
    this.quantity = this.quantity + 1;
  }

  calculateTotal() {
    return this.quantity * this.product.price;
  }

}
