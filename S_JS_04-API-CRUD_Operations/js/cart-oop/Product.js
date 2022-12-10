class Product {

  #_productName;
  #_image;
  #_price;

  constructor(productName, image, price) {
    this.#_productName = productName;
    this.#_image = image;
    this.#_price = price;
  }

  get productName() {
    return this.#_productName;
  }

  set productName(newProductName) {
    this.#_productName = newProductName;
  }

  get image() {
    return this.#_image;
  }

  set image(newImage) {
    return this.#_image;
  } 

  get price() {
    return this.#_price;
  }

  set price(newPrice) {
    this.#_price = newPrice;
  }
}