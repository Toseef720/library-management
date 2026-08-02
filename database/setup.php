<?php

$envFile = __DIR__ . '/../.env';

if (!file_exists($envFile)) {
    die("Missing .env file. Copy .env.example to .env first.");
}

$env = parse_ini_file($envFile);

$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$password = $env['DB_PASS'];
$database = $env['DB_NAME'];

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("MySQL connection failed: " . $conn->connect_error);
}

$conn->query(
    "CREATE DATABASE IF NOT EXISTS `$database`
     CHARACTER SET utf8mb4
     COLLATE utf8mb4_general_ci"
);

$conn->select_db($database);


$conn->query("
    CREATE TABLE IF NOT EXISTS books (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        author VARCHAR(100) NOT NULL,
        category VARCHAR(100) NOT NULL,
        isbn VARCHAR(20) NOT NULL,
        quantity INT NOT NULL,
        available INT NOT NULL
    )
");


$conn->query("
    CREATE TABLE IF NOT EXISTS issued_books (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_name VARCHAR(100) NOT NULL,
        roll_no VARCHAR(50) NOT NULL,
        book_id INT NOT NULL,
        issue_date DATE NOT NULL,
        due_date DATE NOT NULL,
        return_date DATE DEFAULT NULL,
        status VARCHAR(20) DEFAULT 'Issued',

        FOREIGN KEY (book_id)
        REFERENCES books(id)
    )
");


$result = $conn->query("SELECT COUNT(*) AS total FROM books");
$row = $result->fetch_assoc();

if ($row['total'] == 0) {

    $conn->query("
        INSERT INTO books
        (title, author, category, isbn, quantity, available)
        VALUES

        ('Clean Code',
        'Robert C. Martin',
        'Programming',
        '9780132350884',
        5,
        5),

        ('Database System Concepts',
        'Abraham Silberschatz',
        'Database',
        '9780073523323',
        4,
        4),

        ('Computer Networks',
        'Andrew S. Tanenbaum',
        'Networking',
        '9780132126953',
        6,
        6),

        ('Operating System Concepts',
        'Abraham Silberschatz',
        'Operating System',
        '9781119800361',
        3,
        3)
    ");
}

echo "Database setup completed successfully.";

$conn->close();