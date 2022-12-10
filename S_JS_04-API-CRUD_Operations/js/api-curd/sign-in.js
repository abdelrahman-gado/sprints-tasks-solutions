const submitBtn = document.getElementById("submit-btn");

const redirect = () => {
  window.location.href = "index.html";
};

const storeToken = (token) => {
  localStorage.setItem("token", token);
};

const storeUserId = (user_id) => {
  localStorage.setItem("user_id", user_id);
};

const verifyCredentials = async (credentialObj) => {
  try {
    const response = await fetch(`${baseAPIUrl}users/login`, {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify(credentialObj),
    });

    const data = await response.json();
    console.log(data);
    const token = data["token"];
    const user_id = data["_id"];

    storeToken(token); // If success login, store token in local storage to place an order with it.
    storeUserId(user_id); // Then, store user_id in local storage to place an order with it.
    redirect(); // Finally, redirect to the home page
  } catch (err) {
    console.log(err.message);
    alert("Invalid Credentials");
  }
};

// Note: using click event instead of submit event on form, to make the page does not post back
submitBtn.addEventListener("click", (e) => {
  const email = document.getElementById("email-input").value;
  const password = document.getElementById("password-input").value;

  const credentials = { email, password };
  verifyCredentials(credentials);
});
