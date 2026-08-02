<?php

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST["title"];
    $author = $_POST["author"];
    $category = $_POST["category"];
    $isbn = $_POST["isbn"];
    $quantity = (int) $_POST["quantity"];

    $available = $quantity;

    $stmt = $conn->prepare(
        "INSERT INTO books
        (title, author, category, isbn, quantity, available)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssii",
        $title,
        $author,
        $category,
        $isbn,
        $quantity,
        $available
    );

    $stmt->execute();

    header("Location: ../pages/books.php");
    exit;
}