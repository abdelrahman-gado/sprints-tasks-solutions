// Get cart Object from current local storage items to reuse its methods (calculateSubTotal(), calculateShipping(), ..)
const cart = Cart.getCartObject();

// Convert cart object to array of ordinary objects to view them in ORDER TOTAL Section.
const cartProducts = cart.getProductsArr();

// Capture the products, Subtotal, Shipping, Total of ORDER TOTAL Section
const productsConatiner = document.getElementById("products");
const subTotalHTag = document.getElementById("sub-total");
const shippingHTag = document.getElementById("shipping");
const totalHTag = document.getElementById("total");

// Values of sub-total, shipping and total of the order.
const subTotalValue = cart.calculateSubTotal();
const shippingValue = cart.calculateShipping();
const totalValue = cart.calculateSubTotal();

// Capture the place order button
const placeOrderBtn = document.getElementById("place-order-btn");

const getProductHTMLElement = (productObj) => {
  return `<div class="d-flex justify-content-between">
            <p>${productObj.productName}</p>
            <p>$${productObj.price}</p>
          </div>`;
};

const getOrderTotal = (orderedProducts) => {
  orderedProducts.forEach((product) => {
    productsConatiner.innerHTML += getProductHTMLElement(product);
  });

  subTotalHTag.textContent = `$${subTotalValue}`;
  shippingHTag.textContent = `$${shippingValue}`;
  totalHTag.textContent = `$${totalValue}`;
};

const checkUserToken = () => {
  return localStorage.getItem("token") !== null;
};

const getOrderDeatilsArr = (cartProducts) => {
  return cartProducts.map((productObj) => {
    return {
      product_id: productObj.id,
      price: productObj.price,
      qty: productObj.quantity,
    };
  });
};

const getOrder = (
  user_id,
  firstName,
  lastName,
  email,
  mobile,
  address1,
  address2,
  city,
  state,
  zipCode,
  cartProducts,
  subTotal,
  shipping,
  total
) => {
  const orderDetailsArr = getOrderDeatilsArr(cartProducts);
  return {
    sub_total_price: Number(subTotal),
    shipping: Number(shipping),
    total_price: Number(total),
    user_id: user_id,
    order_date: new Date().toISOString(),
    order_details: orderDetailsArr,
    shipping_info: {
      first_name: firstName,
      last_name: lastName,
      email: email,
      mobile_number: mobile,
      address1: address1,
      address2: address2,
      country: String(country),
      city: city,
      state: state,
      zip_code: zipCode,
    },
  };
};

const addOrder = async (order, token) => {
  try {
    const response = await fetch(`${baseAPIUrl}orders`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "x-access-token": token,
      },
      body: JSON.stringify(order),
    });

    const SubmittedData = await response.json();

    return SubmittedData;
  } catch (err) {
    console.log(err.message);
    alert(err.message);
  }
};


placeOrderBtn.addEventListener("click", (e) => {
  // Check if user logged in before placing an order.
  if (!checkUserToken()) {
    alert("You need to login before placing an order");
    window.location.href = "sign-in.html";
    return;
  }

  // Check if user cart is empty, then alert him and redirect him to home page.
  if (cartProducts.length === 0) {
    alert("You need to add products to your cart before placing an order");
    window.location.href = "index.html";
    return;
  }

  // Capture the Select tag
  const countrySelect = document.getElementById("country");
  // Get the text of the selected option.
  const country =
    countrySelect.options[countrySelect.selectedIndex].textContent;

  const firstName = document.getElementById("first-name").value;
  const lastName = document.getElementById("last-name").value;
  const email = document.getElementById("email").value;
  const mobile = document.getElementById("mobile").value;
  const address1 = document.getElementById("address1").value;
  const address2 = document.getElementById("address2").value;
  const city = document.getElementById("city").value;
  const state = document.getElementById("state").value;
  const zipCode = document.getElementById("zip-code").value;


  const user_id = localStorage.getItem("user_id");
  const token = localStorage.getItem("token");

  const order = getOrder(
    user_id,
    firstName,
    lastName,
    email,
    mobile,
    address1,
    address2,
    city,
    state,
    zipCode,
    cartProducts,
    subTotalValue,
    shippingValue,
    totalValue
  );

  const data = addOrder(order, token);

  // If order is submitted successfully, then clear the local storage from current cart products and redirect to home page
  data
    .then(() => {
      localStorage.removeItem("products");
      alert("The order is submitted successfully");
      window.location.href = "index.html";
    })
    .catch(() => {
      console.log(err.message);
      alert(err.message);
    });
});

getOrderTotal(cartProducts);
