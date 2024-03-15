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

        $result = $pdo->query('SELECT COUNT(*) FROM eventi');
        $count = $result->fetchColumn();

        if ($count === 0) {
            $pdo->exec("
                INSERT INTO `eventi`(`attendees`, `nome_evento`, `data_evento`) VALUES 
                ('ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 1', '2022-10-13 14:00'), 
                ('dgipolga@edume.me,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 2', '2022-10-15 19:00'), 
                ('dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net','Test Edusogno 2', '2022-10-15 19:00')
            ");
        }

        return $pdo;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
