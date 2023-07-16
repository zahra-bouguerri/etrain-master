let body = document.querySelector("body");
let icon = document.getElementById("mode-icon");
let nav = document.getElementById("nav");
let main = document.getElementById("main");

function dark() {
  body.classList.toggle("dark-body");
  nav.classList.toggle("dark-nav");
  main.classList.toggle("dark-body");

  // Update localStorage value
  if (body.classList.contains("dark-body")) {
    localStorage.setItem('dark', 'true');
    icon.setAttribute("class", "fas fa-sun");
  } else {
    localStorage.setItem('dark', 'false');
    icon.setAttribute("class", "fas fa-moon");
  }
}
// Load dark mode on page load
var darkMode = localStorage.getItem('dark');
if (darkMode === 'true') {
  dark(); // Apply dark mode styles
}