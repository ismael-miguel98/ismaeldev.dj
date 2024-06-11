let login = document.getElementById("login");
let container = document.getElementById("container");
let registrar = document.getElementById("registrar");

login.addEventListener("click", () => {
  container.classList.add("active");
});
registrar.addEventListener("click", () => {
  container.classList.remove("active");
});
// JavaScript
document.getElementById("login").addEventListener("click", function() {
    document.querySelector(".form-container.registrar").style.display = "none";
    document.querySelector(".form-container.login").style.display = "block";
});

document.getElementById("registrar").addEventListener("click", function() {
    document.querySelector(".form-container.registrar").style.display = "block";
    document.querySelector(".form-container.login").style.display = "none";
});
