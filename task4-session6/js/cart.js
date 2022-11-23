const productNameInp = document.getElementById("product-name");
const priceInp = document.getElementById("price");
const quantityInp = document.getElementById("quantity");
const addBtn = document.getElementById("add-btn");
const tableBody = document.getElementById("products");

const clearInputs = function () {
  productNameInp.value = "";
  priceInp.value = "";
  quantityInp.value = "";
};

const calculateTotal = function (price, quantity) {
  return parseFloat((price * quantity).toFixed(2));
};

addBtn.addEventListener("click", () => {

  // Getting input values.
  const productName = productNameInp.value;
  const price = Number(priceInp.value);
  const quantity = Number(quantityInp.value);

  // Check if the user types string in the inputs that require number type.
  if (isNaN(price) || isNaN(quantity)) {
    alert("Please, the price and quantity should be numbers");
    clearInputs();
    return;
  }

  // Check if the user types negative values in price or quantity inputs.
  if (price <= 0 || quantity <= 0) {
    alert("Please, enter positive numbers for the price and quantity");
    clearInputs();
    return;
  }

  const total = calculateTotal(price, quantity);

  tableBody.innerHTML += `<tr><td>${productName}</td><td>$${price}</td><td>${quantity}</td><td>$${total}</td><td><button class="btn btn-primary">Remove</button></td></tr>`;

  // Clear inputs after adding product
  clearInputs();
});
