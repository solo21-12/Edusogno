const passwordToggle = document.querySelector(".password-toggle");
const passwordInput = document.querySelector('input[type="password"]');

passwordToggle.addEventListener("click", function () {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordToggle.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
  } else {
    passwordInput.type = "password";
    passwordToggle.innerHTML = '<i class="fa-solid fa-eye"></i>';
  }
});
