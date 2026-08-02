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

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");