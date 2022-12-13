const categoriesContainer = document.getElementById("categories-conatiner");
const featuredProductsContainer = document.getElementById("featured-products");
const recentProductsConatainer = document.getElementById("recent-products");

const getHTMLCategoryElement = (category) => {
  return `<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="catgeory/${category._id}">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="${category.image}" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>${category.name}</h6>
                            <small class="text-body">${category.productCount} Products</small>
                        </div>
                    </div>
                </a>
            </div>`;
};

const getStars = (rating) => {
  let stars = ``;
  for (let i = 1; i <= 5; i++) {
    if (rating >= i) {
      stars += `<small class="fa fa-star text-primary mr-1"></small>`;
    } else if (Math.floor(Math.abs(i - rating)) == 0) {
      stars += `<small class="fa fa-star-half-alt text-primary mr-1"></small>`;
    } else {
      stars += `<small class="far fa-star text-primary mr-1"></small>`;
    }
  }
  return stars;
};

const getHTMLProductElement = (product) => {
  return `<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
          <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
              <img class="img-fluid w-100" src="${product.image}" alt="" />
              <div class="product-action">
                <a
                  class="btn btn-outline-dark btn-square"
                  href=""
                  onclick="addSingleProductToCart({ id: '${
                    product._id
                  }', productName: '${product.name}', image: '${
    product.image
  }', price: ${product.price - product.price * product.discount} })"
                  ><i class="fa fa-shopping-cart"></i
                ></a>
                <a class="btn btn-outline-dark btn-square" href=""
                  ><i class="far fa-heart"></i
                ></a>
                <a class="btn btn-outline-dark btn-square" href=""
                  ><i class="fa fa-sync-alt"></i
                ></a>
                <a class="btn btn-outline-dark btn-square" href=""
                  ><i class="fa fa-search"></i
                ></a>
              </div>
            </div>
            <div class="text-center py-4">
              <a class="h6 text-decoration-none text-truncate" href=""
                >${product.name}</a
              >
              <div
                class="d-flex align-items-center justify-content-center mt-2"
              >
                <h5>$${product.price - product.price * product.discount}</h5>
                <h6 class="text-muted ml-2"><del>$${product.price}</del></h6>
              </div>
              <div
                class="d-flex align-items-center justify-content-center mb-1"
              >
                ${getStars(product.rating)}
                <small>(${product.rating_count})</small>
              </div>
            </div>
          </div>
        </div>`;
};

const createCategoriesElemenets = (data) => {
  if (data["status"] === "success") {
    data.data.forEach((category) => {
      categoriesContainer.innerHTML += getHTMLCategoryElement(category);
    });
  }
};

const createProductsElemenets = (data, container) => {
  if (data["status"] === "success") {
    data.data.forEach((product) => {
      container.innerHTML += getHTMLProductElement(product);
    });
  }
};

const getProductsData = async (container, url) => {
  try {
    const response = await fetch(`${baseAPIUrl}${url}`);
    const data = await response.json();
    createProductsElemenets(data, container);
  } catch (err) {
    console.log(err.message);
    alert(err.message);
  }
};

const getCategoriesData = async () => {
  try {
    const response = await fetch(`${baseAPIUrl}categories/`);
    const data = await response.json();
    createCategoriesElemenets(data);
  } catch (err) {
    console.log(err.message);
    alert(err.message);
  }
};

getCategoriesData();
getProductsData(recentProductsConatainer, "products/getRecent");
getProductsData(featuredProductsContainer, "products/getFeatured");
