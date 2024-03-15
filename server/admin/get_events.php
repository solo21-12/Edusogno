<?php
require_once '../../../db/connection.php'; // Adjusted path to connection.php

try {
    // Create a PDO instance for the SQLite database
    $pdo = new PDO("sqlite:../../../db/database.sqlite");
    
    // Set PDO error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch all records from the 'eventi' table
    $statement = $pdo->query("SELECT * FROM eventi");
    
    // Fetch all records as associative array
    $events = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any PDO exceptions (database errors)
    echo "Error: " . $e->getMessage();
    // You might want to log the error for further investigation
    // Log::error("PDO Error: " . $e->getMessage());
    // Alternatively, you can redirect the user to an error page
    // header("Location: error.php");
    exit(); // Exit the script to prevent further execution
}
?>
