function validateForm() {
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("password_confirm").value;
  var email = document.getElementById("email").value;
  var emailError = document.getElementById("email-error");
  var passwordError = document.getElementById("password-error");
  var passwordConfirmError = document.getElementById("password-confirm-error");

  if (password !== confirmPassword) {
    document.getElementById("password_confirm").classList.add("error");
    passwordConfirmError.textContent = "Passwords do not match";
    return false;
  } else {
    document.getElementById("password_confirm").classList.remove("error");
    passwordConfirmError.textContent = "";
  }

  if (password.length < 8) {
    document.getElementById("password").classList.add("error");
    passwordError.textContent = "Password must be at least 8 characters";
    return false;
  } else {
    document.getElementById("password").classList.remove("error");
    passwordError.textContent = "";
  }

  // Email validation
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    emailError.textContent = "Invalid email format";
    return false;
  } else {
    emailError.textContent = "";
  }

  return true;
}
