<?php

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = (int) $_POST["id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $category = $_POST["category"];
    $isbn = $_POST["isbn"];
    $quantity = (int) $_POST["quantity"];

    $stmt = $conn->prepare(
        "SELECT quantity, available FROM books WHERE id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if ($book) {

        $issued = $book["quantity"] - $book["available"];
        $available = max($quantity - $issued, 0);

        $stmt = $conn->prepare(
            "UPDATE books
             SET title = ?, author = ?, category = ?, isbn = ?,
                 quantity = ?, available = ?
             WHERE id = ?"
        );

        $stmt->bind_param(
            "ssssiii",
            $title,
            $author,
            $category,
            $isbn,
            $quantity,
            $available,
            $id
        );

        $stmt->execute();
    }

    header("Location: ../pages/books.php?success=updated");
    exit;
}