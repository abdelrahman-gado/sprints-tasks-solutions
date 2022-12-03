const addSingleProductToCart = (productObj) => {
  const products = JSON.parse(localStorage.getItem('products') || '[]');
  const foundProductIndex = products.findIndex((product) => product.id === productObj.id);
  if (foundProductIndex >= 0) {
    products[foundProductIndex].quantity++;
  } else {
    products.push({ ...productObj, quantity: 1 });
  }

  localStorage.setItem('products', JSON.stringify(products));
}