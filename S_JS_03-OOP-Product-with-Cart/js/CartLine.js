class CartLine {
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

  createCartLineHTMLRow(index) {
    return `
  <tr>
    <td class="align-middle"><img src="img/${
      this.product.image
    }.jpg" alt="" style="width: 50px;"> ${this.product.productName}</td>
    <td class="align-middle">$${this.product.price}</td>
    <td class="align-middle">
        <div class="input-group quantity mx-auto" style="width: 100px;">
            <div class="input-group-btn">
                <button type="button" class="btn btn-sm btn-primary btn-minus" onclick="cart.decQuantityOfCartLine(${index});cart.updateLocalStorage();cart.render();">
                <i class="fa fa-minus"></i>
                </button>
            </div>
            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="${
              this.quantity
            }">
            <div class="input-group-btn">
                <button type="button" class="btn btn-sm btn-primary btn-plus" onclick="cart.incQuantityOfCartLine(${index});cart.updateLocalStorage();cart.render();">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </td>
    <td class="align-middle">$${this.calculateTotal()}</td>
    <td class="align-middle"><button class="btn btn-sm btn-danger" type="button" onclick="cart.removeCartLine(${index});cart.updateLocalStorage();cart.render();"><i class="fa fa-times"></i></button></td>
  </tr>`; 
  }
}
