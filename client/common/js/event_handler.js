const toggleFormButton = document.getElementById("toggle-form-button");
const eventFormContainer = document.getElementById("event-form-container");
const formText = document.getElementById("form-text");
const datetimePicker = document.getElementById("datetime_picker");
const dataEventoInput = document.getElementById("data_evento");
const dataEventoLabel = document.getElementById("data_evento_label");

toggleFormButton.addEventListener("click", () => {
  if (eventFormContainer.style.display === "none") {
    eventFormContainer.style.display = "block";
    formText.style.display = "none";
    toggleFormButton.textContent = "Hide Form";
  } else {
    eventFormContainer.style.display = "none";
    formText.style.display = "block";
    toggleFormButton.textContent = "Add Event";
  }
});

dataEventoLabel.addEventListener("click", () => {
  if (datetimePicker.style.display === "none") {
    datetimePicker.style.display = "block";
    dataEventoInput.style.display = "none";
  } else {
    datetimePicker.style.display = "none";
    dataEventoInput.style.display = "block";
  }
});
document.addEventListener("DOMContentLoaded", function () {
  datetimePicker.addEventListener("change", () => {
    dataEventoInput.value = datetimePicker.value;
  });

  const submitButton = document.querySelector('input[type="submit"]');
  submitButton.addEventListener("click", () => {
    eventFormContainer.style.display = "none";
    formText.style.display = "none";
    toggleFormButton.style.display = "block";
    toggleFormButton.textContent = "Add Event";
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".edit-button");
  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const card = this.parentElement;
      const editForm = card.querySelector(".edit-form");
      button.style.display = "none";
      editForm.style.display =
        editForm.style.display === "none" ? "block" : "none";
    });
  });

  const updateButtons = document.querySelectorAll(".update-btn");

  const deleteButtons = document.querySelectorAll(".delete-btn");
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const form = this.closest("form");
      const id = form.querySelector('[name="id"]').value;
      const url = `../../../server/admin/DeleteEvent.php?id=${id}`;

      fetch(url, {
        method: "GET",
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text();
        })
        .then((data) => {
          console.log(data);
          // Refresh the page
          location.reload();
        })
        .catch((error) => {
          console.error(
            "There was a problem with your fetch operation:",
            error
          );
        });
    });
  });
});
