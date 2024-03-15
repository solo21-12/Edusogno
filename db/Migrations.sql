CREATE TABLE IF NOT EXISTS utenti (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    cognome TEXT,
    email TEXT,
    password TEXT
);

CREATE TABLE IF NOT EXISTS eventi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    attendees TEXT,
    nome_evento TEXT,
    data_evento DATETIME
);




INSERT INTO `evento`(`attendees`, `nome_evento`, `data_evento`) VALUES ('ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 1', '2022-10-13 14:00'), ('dgipolga@edume.me,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 2', '2022-10-15 19:00'), ('dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net','Test Edusogno 2', '2022-10-15 19:00')