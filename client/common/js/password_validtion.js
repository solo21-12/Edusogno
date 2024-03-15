function validateForm() {
  var password = document.getElementById("password").value;
  var password_confirm = document.getElementById("password_confirm").value;

  var passwordError = document.getElementById("password-error");
  var passwordConfirmError = document.getElementById("password-confirm-error");

  var isValid = true;

  passwordError.textContent = "";
  passwordConfirmError.textContent = "";

  if (password.length < 8) {
    passwordError.textContent = "La password deve essere di almeno 8 caratteri";
    isValid = false;
  }

  if (password_confirm !== password) {
    passwordConfirmError.textContent = "Le password non corrispondono";
    isValid = false;
  }

  return isValid;
}
