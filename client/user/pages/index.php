<!DOCTYPE html>
<html lang="en">
<?php

include '../../../server/admin/get_events.php';

session_start();

if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
} else {
    header("Location: login.php");
    exit;
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../common/styles/events.css">
    <link rel="stylesheet" href="../../common/styles/navbar.css">
    <link rel="stylesheet" href="../../common/styles/card.css">
    <link rel="icon" type="image/jpeg" href="../../common/assets/logo.jpeg">
    <title>Home</title>

</head>

<body>
    <?php include '../../common/components/navbar.php'; ?>

    <div class='top-container'>
        <div class="title">Benvenuto, <?php echo $first_name . ' ' . $last_name; ?></div>
        <div class="title" id="user-events-title">I tuoi eventi</div>
        <div class="card-container" id="user-events-container">
        </div>
        <div class="title">Nuovi eventi</div>
        <div class="card-container" id="new-events-container">
        </div>
    </div>

    <div class="spinner">
        <img src="path/to/spinner.gif" alt="Caricamento...">
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function showSpinner() {
                $('.spinner').show();
            }

            function hideSpinner() {
                $('.spinner').hide();
            }

            function fetchUserEvents() {
                showSpinner();

                $.ajax({
                    url: '../../../server/user/user_events.php',
                    type: 'GET',
                    data: {
                        user_id: <?php echo $_SESSION['user_id']; ?>
                    },
                    dataType: 'json',
                    success: function(response) {
                        hideSpinner();

                        if (response && response.user_events.length > 0) {
                            $('#user-events-title').show();

                            response.user_events.forEach(function(event) {
                                var cardHtml = '<div class="card">';
                                cardHtml += '<h2 class="title1">' + event.nome_evento + '</h2>';
                                cardHtml += '<p class="date">' + event.data_evento + '</p>';
                                cardHtml += '<form class="unsubscribe-form" method="post" action="../../../server/user/remove_event.php">';
                                cardHtml += '<input type="hidden" name="event_id" value="' + event.id + '">';
                                cardHtml += '<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">';
                                cardHtml += '<button type="submit" class="join-button edit-button">Annulla iscrizione</button>';
                                cardHtml += '</form></div>';

                                $('#user-events-container').append(cardHtml);
                            });
                        } else {
                            $('#user-events-title').hide();
                        }

                        if (response && response.new_events.length > 0) {
                            response.new_events.forEach(function(event) {
                                var cardHtml = '<div class="card">';
                                cardHtml += '<h2 class="title1">' + event.nome_evento + '</h2>';
                                cardHtml += '<p class="date">' + event.data_evento + '</p>';
                                cardHtml += '<form method="post" action="../../../server/user/register_event.php">';
                                cardHtml += '<input type="hidden" name="event_id" value="' + event.id + '">';
                                cardHtml += '<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">';
                                cardHtml += '<button type="submit" class="join-button edit-button">Partecipa</button>';
                                cardHtml += '</form></div>';

                                $('#new-events-container').append(cardHtml);
                            });
                        } else {
                            $('#new-events-container').html('<p></p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        hideSpinner();
                        console.error('Errore nel recupero degli eventi dell\'utente:', error);
                        $('#user-events-container').html('<p>Errore nel recupero degli eventi dell\'utente.</p>');
                        $('#new-events-container').html('<p>Errore nel recupero dei nuovi eventi.</p>');
                    }
                });
            }

            fetchUserEvents();

            $(document).on('submit', '.unsubscribe-form', function(e) {
                e.preventDefault();

                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.message) {
                            var card = form.closest('.card');
                            $('#new-events-container').append(card);
                            form.find('.join-button').text('Partecipa').removeClass('unsubscribe-button').addClass('join-button');
                        } else if (response && response.error) {
                            alert(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Errore nella rimozione dell\'utente dall\'evento:', error);
                        alert('Errore nella rimozione dell\'utente dall\'evento.');
                    }
                });
            });
        });
    </script>
</body>

</html>