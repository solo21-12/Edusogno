function togglePasswordVisibility(inputId, toggleId) {
  const input = document.getElementById(inputId);
  const toggle = document.getElementsByClassName(toggleId)[0];
  if (input.type === "password") {
    input.type = "text";
    toggle.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
  } else {
    input.type = "password";
    toggle.innerHTML = "<i class='fa-solid fa-eye'></i>";
  }
}
