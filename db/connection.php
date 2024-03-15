<?php

function getConnection()
{
    $databaseFile = '../../db/database.sqlite';

    try {
        $pdo = new PDO('sqlite:' . $databaseFile);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec('CREATE TABLE IF NOT EXISTS utenti (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome VARCHAR(45),
            cognome VARCHAR(45),
            email VARCHAR(255),
            password VARCHAR(255)
        )');

        // Insert people if they are not already in the utenti table
        $people = [
            ['Marco', 'Rossi', 'ulysses200915@varen8.com', 'Edusogno123'],
            ['Filippo', 'D’Amelio', 'qmonkey14@falixiao.com', 'Edusogno?123'],
            ['Gian Luca', 'Carta', 'mavbafpcmq@hitbase.net', 'EdusognoCiao'],
            ['Stella', 'De Grandis', 'dgipolga@edume.me', 'EdusognoGia']
        ];

        foreach ($people as $person) {
            $email = $person[2];
            $count = $pdo->prepare('SELECT COUNT(*) FROM utenti WHERE email = :email');
            $count->bindParam(':email', $email);
            $count->execute();

            if ($count->fetchColumn() === 0) {
                $insert = $pdo->prepare('INSERT INTO utenti (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)');
                $insert->bindParam(':nome', $person[0]);
                $insert->bindParam(':cognome', $person[1]);
                $insert->bindParam(':email', $person[2]);
                $insert->bindParam(':password', $person[3]);
                $insert->execute();
            }
        }

        $pdo->exec('CREATE TABLE IF NOT EXISTS eventi (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            attendees TEXT,
            nome_evento VARCHAR(255),
            data_evento DATETIME
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS amministratrice (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome VARCHAR(45),
            cognome VARCHAR(45),
            email VARCHAR(255),
            password VARCHAR(255)
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS user_events (
            user_id INTEGER,
            event_id INTEGER,
            FOREIGN KEY (user_id) REFERENCES utenti(id),
            FOREIGN KEY (event_id) REFERENCES eventi(id)
        )');



        return $pdo;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
