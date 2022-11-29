const saveProductsToLocalStorage = () => {
  localStorage.setItem("products", JSON.stringify(products));
};

const incQuantity = (index) => {
  products[index].quantity++;

  // Write the changes made to products array to localStorage
  saveProductsToLocalStorage();

  // render HTML
  renderHTML();
}

const decQuantity = (index) => {
  let productQuantity = products[index].quantity;
  if (productQuantity > 1) {
    products[index].quantity--;
  }

  // Write the changes made to products array to localStorage
  saveProductsToLocalStorage();

  // render HTML
  renderHTML();
}

const removeProduct = (index) => {
  products.splice(index, 1);

  // Write the changes made to product array to localStorage
  saveProductsToLocalStorage();

  // render HTML
  renderHTML();
}


const createProductHTMLRow = (productObj, index) => {
  return `
  <tr>
    <td class="align-middle"><img src="img/${
      productObj.productName
    }.jpg" alt="" style="width: 50px;"> ${productObj.productName}</td>
    <td class="align-middle">$${productObj.price}</td>
    <td class="align-middle">
        <div class="input-group quantity mx-auto" style="width: 100px;">
            <div class="input-group-btn">
                <button type="button" class="btn btn-sm btn-primary btn-minus" onclick="decQuantity(${index})">
                <i class="fa fa-minus"></i>
                </button>
            </div>
            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="${
              productObj.quantity
            }">
            <div class="input-group-btn">
                <button type="button" class="btn btn-sm btn-primary btn-plus" onclick="incQuantity(${index})">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </td>
    <td class="align-middle">$${productObj.price * productObj.quantity}</td>
    <td class="align-middle"><button class="btn btn-sm btn-danger" type="button" onclick="removeProduct(${index})"><i class="fa fa-times"></i></button></td>
  </tr>`;
};

const calculateSubTotal = () => {
  
  if (products.length === 0) {
    return 0;
  }

  return products
    .map((product) => product.price * product.quantity)
    .reduce((total, subTotal) => total += subTotal);
}

const calculateShipping = () => {

  if (products.length === 0) {
    return 0;
  }

  return products.length * 10;
}

const calculateTotal = () => {
  const cartTotal = calculateSubTotal() + calculateShipping();
  return cartTotal;
}


const renderHTML = () => {
  
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
  products.forEach((productObj, index) => {
    productsTbody.innerHTML += createProductHTMLRow(productObj, index);
  });

  // add sub-total, shipping and cartTotal values
  subTotal.textContent = `$${calculateSubTotal()}`;
  shipping.textContent = `$${calculateShipping()}`;
  total.textContent = `$${calculateTotal()}`;

};

const products = JSON.parse(localStorage.getItem("products") || "[]");
renderHTML();
