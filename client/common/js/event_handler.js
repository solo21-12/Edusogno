const toggleFormButton = document.getElementById('toggle-form-button');
const eventFormContainer = document.getElementById('event-form-container');
const formText = document.getElementById('form-text');
const datetimePicker = document.getElementById('datetime_picker');
const dataEventoInput = document.getElementById('data_evento');
const dataEventoLabel = document.getElementById('data_evento_label');

toggleFormButton.addEventListener('click', () => {
    if (eventFormContainer.style.display === 'none') {
        eventFormContainer.style.display = 'block';
        formText.style.display = 'none';
        toggleFormButton.textContent = 'Hide Form';
    } else {
        eventFormContainer.style.display = 'none';
        formText.style.display = 'block';
        toggleFormButton.textContent = 'Add Event';
    }
});

dataEventoLabel.addEventListener('click', () => {
    if (datetimePicker.style.display === 'none') {
        datetimePicker.style.display = 'block';
        dataEventoInput.style.display = 'none';
    } else {
        datetimePicker.style.display = 'none';
        dataEventoInput.style.display = 'block';
    }
});

datetimePicker.addEventListener('change', () => {
    dataEventoInput.value = datetimePicker.value; // Update text field value with selected datetime
});

const submitButton = document.querySelector('input[type="submit"]');
submitButton.addEventListener('click', () => {
    eventFormContainer.style.display = 'none';
    formText.style.display = 'none';
    toggleFormButton.style.display = 'block';
    toggleFormButton.textContent = 'Add Event';
});

