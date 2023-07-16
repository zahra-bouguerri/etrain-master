const sign_in_btn = document.querySelector("#sign-up-btn");
const sign_up_btn = document.querySelector("#sign-in-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

// Get the error message element
var errorElement = document.getElementById("error");

// Check if the error message element exists
if (errorElement) {
  // Hide the error message after 3 seconds
  setTimeout(function() {
    errorElement.style.display = "none";
  }, 9000);

  // Add an event listener to hide the error message when the user clicks on it
  errorElement.addEventListener("click", function() {
    errorElement.style.display = "none";
  });
}

function showLoginMessage() {
  var message = document.getElementById('login-message');
  message.style.display = 'block';
}

function closeLoginMessage() {
  var message = document.getElementById('login-message');
  message.style.display = 'none';
}

