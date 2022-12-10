class Cart {
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

  addToCart(item) {
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

  incQuantityOfCartLine(i) {
    this.cartList[i].incQuantity();
  }

  decQuantityOfCartLine(i) {
    this.cartList[i].decQuantity();
  }

  removeCartLine(index) {
    this.cartList.splice(index, 1);
  }

  static getProductsFromLocalStorage() {
    return JSON.parse(localStorage.getItem("products") || "[]");
  }

  static getCartObject() {
    /**
     * Convert the json of products that lives in local storage to Cart object that holds all products.
     */

    const products = Cart.getProductsFromLocalStorage();
    const cart = new Cart([]);

    products.forEach((item) => {
      const product = new Product(
        item.productName,
        item.image,
        item.price
      );
      const cartLine = new CartLine(item.id, product, item.quantity);
      cart.addToCart(cartLine);
    });

    return cart;
  }

  getProductsArr() {
    /**
     * Convert the Cart object to array of product literal objects to store properties
     *  of Cart object in json format.
     */

    const productsArr = [];
    this.cartList.forEach((cartLineObj) => {
      const tempObj = {
        id: cartLineObj.id,
        productName: cartLineObj.product.productName,
        price: cartLineObj.product.price,
        image: cartLineObj.product.image,
        quantity: cartLineObj.quantity,
      };

      productsArr.push(tempObj);
    });

    return productsArr;
  }

  updateLocalStorage() {
    /**
     * Save changes after increasing, decreasing the quantity or even remove cart line in the local storage.
     */
    const productsArr = this.getProductsArr();
    localStorage.setItem("products", JSON.stringify(productsArr));
  }

  render() {
    const productsTbody = document.getElementById("products");
    const subTotal = document.getElementById("sub-total");
    const shipping = document.getElementById("shipping");
    const total = document.getElementById("total");

    // Firstly, we need remove rows in the tbody, sub-total, shipping and total and render the updated data again from products array.
    productsTbody.innerHTML = "";
    subTotal.textContent = "";
    shipping.textContent = "";
    total.textContent = "";

    // Create products rows in tbody
    this.cartList.forEach((cartLine, index) => {
      productsTbody.innerHTML += cartLine.createCartLineHTMLRow(index);
    });

    // add sub-total, shipping and cartTotal values
    subTotal.textContent = `$${this.calculateSubTotal()}`;
    shipping.textContent = `$${this.calculateShipping()}`;
    total.textContent = `$${this.calculateCartTotal()}`;
  }
}
