document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-button');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = this.parentElement;
            const editForm = card.querySelector('.edit-form');
            button.style.display = 'none';
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        });
    });
});

function submitForm(method) {
    var form = document.getElementById('eventForm');
    var formData = new FormData(form);
    var id = formData.get('id');
    console.log(id);

    var url;
    if (method === 'POST') {
        url = '../../../server/admin/add_event.php';
    } else if (method === 'DELETE') {
        url = '../../../server/admin/delete_event.php?id=' + id;
    } else { // Assuming method is PUT
        url = '../../../server/admin/edit_event.php';
    }

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
        } else {
            console.error(xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Error connecting to the server.');
    };

    if (method === 'DELETE') {
        xhr.send(); // No need to send data for DELETE request
    } else {
        var requestBody = 'id=' + id +
            '&attendees=' + encodeURIComponent(formData.get('attendees')) +
            '&nome_evento=' + encodeURIComponent(formData.get('nome_evento')) +
            '&data_evento=' + encodeURIComponent(formData.get('data_evento'));
        console.log("sent request body: " + requestBody);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(requestBody);
    }
}
