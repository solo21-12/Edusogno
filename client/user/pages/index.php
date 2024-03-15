<!DOCTYPE html>
<html lang="en">
<?php

include '../../../server/admin/get_events.php';
if (!isset($_COOKIE['user'])) {
    header("Location: login.php");
    exit;
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../common/styles/events.css">
    <link rel="stylesheet" href="../../common/styles/navbar.css">
    <link rel="stylesheet" href="../../common/styles/card.css"> <!-- Assuming you have a card component stylesheet -->
    <link rel="icon" type="image/jpeg" href="../../common/assets/logo.jpeg">
    <title>Home</title>
</head>

<body>
    <?php include '../../common/components/navbar.php'; ?>

    <div class='top-container'>
        <div class="title" id="user-events-title">Your Events</div>
        <div class="card-container" id="user-events-container">
            <!-- User events will be dynamically added here -->
        </div>
        <div class="title">New Events</div>
        <div class="card-container" id="new-events-container">
            <!-- New events will be dynamically added here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch user events via AJAX
            function fetchUserEvents() {
                $.ajax({
                    url: '../../../server/user/user_events.php', // Path to user_events.php file
                    type: 'GET',
                    data: {
                        user_id: <?php echo $_COOKIE['user']; ?> // Pass the user ID from the cookie
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.user_events.length > 0) {
                            // Show the "Your Events" title
                            $('#user-events-title').show();

                            // Iterate over each user event in the response and create card components
                            response.user_events.forEach(function(event) {
                                var cardHtml = '<div class="card">';
                                cardHtml += '<h2 class="title1">' + event.nome_evento + '</h2>';
                                cardHtml += '<p class="date">' + event.data_evento + '</p>';
                                cardHtml += '<form class="unsubscribe-form" method="post" action="../../../server/user/remove_event.php">';
                                cardHtml += '<input type="hidden" name="event_id" value="' + event.id + '">';
                                cardHtml += '<input type="hidden" name="user_id" value="<?php echo $_COOKIE['user']; ?>">';
                                cardHtml += '<button type="submit" class="join-button edit-button">Unsubscribe</button>';
                                cardHtml += '</form></div>';

                                // Append the card HTML to the container for user events
                                $('#user-events-container').append(cardHtml);
                            });
                        } else {
                            // Hide the "Your Events" title
                            $('#user-events-title').hide();
                        }

                        if (response && response.new_events.length > 0) {
                            // Iterate over each new event in the response and create card components
                            response.new_events.forEach(function(event) {
                                var cardHtml = '<div class="card">';
                                cardHtml += '<h2 class="title1">' + event.nome_evento + '</h2>';
                                cardHtml += '<p class="date">' + event.data_evento + '</p>';
                                cardHtml += '<form method="post" action="../../../server/user/register_event.php">';
                                cardHtml += '<input type="hidden" name="event_id" value="' + event.id + '">';
                                cardHtml += '<input type="hidden" name="user_id" value="<?php echo $_COOKIE['user']; ?>">';
                                cardHtml += '<button type="submit" class="join-button edit-button">Join</button>';
                                cardHtml += '</form></div>';

                                // Append the card HTML to the container for new events
                                $('#new-events-container').append(cardHtml);
                            });
                        } else {
                            // Handle case where no new events are returned
                            $('#new-events-container').html('<p>No new events found.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching user events:', error);
                        $('#user-events-container').html('<p>Error fetching user events.</p>');
                        $('#new-events-container').html('<p>Error fetching new events.</p>');
                    }
                });
            }

            // Call the fetchUserEvents function when the page loads
            fetchUserEvents();

            // Event delegation to handle form submission dynamically
            $(document).on('submit', '.unsubscribe-form', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Store the form reference
                var form = $(this);

                // Perform AJAX request to remove the user from the event
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.message) {
                            // Display success message

                            // Move the event card to the "New Events" section
                            var card = form.closest('.card');
                            $('#new-events-container').append(card);

                            // Update the button to join the event
                            form.find('.join-button').text('Join').removeClass('unsubscribe-button').addClass('join-button');
                        } else if (response && response.error) {
                            // Display error message
                            alert(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error removing user from event:', error);
                        alert('Error removing user from event.');
                    }
                });
            });
        });
    </script>
</body>

</html>