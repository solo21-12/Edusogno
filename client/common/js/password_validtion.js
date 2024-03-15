function validateForm() {
  var password = document.getElementById("password").value;
  var password_confirm = document.getElementById("password_confirm").value;

  var passwordError = document.getElementById("password-error");
  var passwordConfirmError = document.getElementById("password-confirm-error");

  var isValid = true;

  // Reset previous error messages
  passwordError.textContent = "";
  passwordConfirmError.textContent = "";

  // Validate password
  if (password.length < 8) {
    passwordError.textContent = "La password deve essere di almeno 8 caratteri";
    isValid = false;
  }

  // Validate password confirmation
  if (password_confirm !== password) {
    passwordConfirmError.textContent = "Le password non corrispondono";
    isValid = false;
  }

  return isValid;
}
