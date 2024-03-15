<!DOCTYPE html>
<html lang="en">
<?php

include '../../../server/admin/get_events.php';
if (!isset($_COOKIE['admin'])) {
    header("Location: login.php");
    exit;
}

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../common/styles/events.css">
    <link rel="stylesheet" href="../../common/styles/navbar.css">
    <link rel="stylesheet" href="../../common/styles/style.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="icon" type="image/jpeg" href="../../common/assets/logo.jpeg">

    <title>Admin Home</title>

</head>

<body>
    <?php include '../../common/components/navbarAdmin.php'; ?>

    <div class='top-container'>
        <div class="title">Ciao NOME ecco i tuoi eventi amministratore</div>
        <div class='form-container'>
            <button id="toggle-form-button" class="join-button add-event-button">Add Event</button>
            <div id="event-form-container" style="display: none;">
                <form action="../../../server/admin/add_event.php" method="POST">
                    <div class="form-group">
                        <label for="nome_evento">Nome Evento:</label>
                        <input type="text" id="nome_evento" name="nome_evento" required>
                    </div>
                    <div class="form-group">
                        <label for="attendees">Attendees:</label>
                        <input type="text" name="attendees" id="attendees" name="attendees" required>
                    </div>

                    <div class="form-group">
                        <label for="data_evento" id="data_evento_label">Data Evento:</label>
                        <input type="date" name="data_evento" id="data_evento">
                    </div>
                    <input type="submit" value="Submit" class="join-button add-event-button">

                </form>
                <p id="form-text" style="display: none;">Form is opened</p>
            </div>

        </div>
        <div class="card-container">
            <?php foreach ($events as $event) : ?>
                <div class="card">
                    <h2 class="title1"><?php echo $event['nome_evento']; ?></h2>
                    <p class="date"><?php echo $event['data_evento']; ?></p>
                    <button class="join-button edit-button" data-event-id="<?php echo $event['id']; ?>">Edit</button>
                    <div class="edit-form" style="display: none;">
                        <form id="eventForm">
                            <div class="form-group">
                                <label for="nome_evento">Nome Evento:</label>
                                <input type="text" id="nome_evento" name="nome_evento" value="<?php echo $event['nome_evento']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="attendees">Attendees:</label>
                                <input type="text" name="attendees" id="attendees" name="attendees" value="<?php echo $event['attendees']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="data_evento" id="data_evento_label">Data Evento:</label>
                                <input type="date" name="data_evento" id="data_evento" value="<?php echo $event['data_evento']; ?>">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                            <div class='btn-container'>
                                <button type="submit" onclick="submitForm('PUT')" class="join-button add-event-button">Update</button>
                                <button type="submit" onclick="submitForm('DELETE')" class="join-button add-event-button delete-btn">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="../../common/js/event_handler.js"></script>
    <script src="../../common/js/edit_event.js"></script>
    <script>
        document.querySelectorAll('.edit-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var card = this.closest('.card');
                card.classList.toggle('expanded');
            });
        });
    </script>

</body>

</html>