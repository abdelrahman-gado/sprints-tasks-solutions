export default class Product {

  #_productName;
  #_price;

  constructor(productName, price) {
    this.#_productName = productName;
    this.#_price = price;
  }

  get productName() {
    return this.#_productName;
  }

  set productName(newProductName) {
    this.#_productName = newProductName;
  }

  get price() {
    return this.#_price;
  }

  set price(newPrice) {
    this.#_price = newPrice;
  }
}