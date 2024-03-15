document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-button');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = this.parentElement;
            const editForm = card.querySelector('.edit-form');
            // Hide the edit button
            button.style.display = 'none';
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        });
    });
});


function submitForm(method) {
    var form = document.getElementById('eventForm');
    var formData = new FormData(form);

    var id = formData.get('id');
    console.log(id)

    var url = '../../../server/admin/add_event.php';
    if (method === 'PUT') {
        url += '?id=' + id;
    }

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Handle success response
            console.log(xhr.responseText);
        } else {
            // Handle error response
            console.error(xhr.statusText);
        }
    };
    xhr.onerror = function() {
        // Handle connection error
        console.error('Error connecting to the server.');
    };

    if (method === 'DELETE') {
        xhr.send('id=' + id);
    } else {
        var requestBody = 'id=' + id +
            '&attendees=' + encodeURIComponent(formData.get('attendees')) +
            '&nome_evento=' + encodeURIComponent(formData.get('nome_evento')) +
            '&data_evento=' + encodeURIComponent(formData.get('data_evento'));
        xhr.send(requestBody);
    }
}