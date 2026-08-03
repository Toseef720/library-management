<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once "../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: ../pages/books.php?error=invalid");
    exit;
}

$id = (int) $_GET["id"];

try {

    // Check whether this book has issue history
    $stmt = $conn->prepare(
        "SELECT COUNT(*) AS total
         FROM issued_books
         WHERE book_id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    if ($row["total"] > 0) {

        header(
            "Location: ../pages/books.php?error=has_history"
        );

        exit;
    }


    // Delete book
    $stmt = $conn->prepare(
        "DELETE FROM books WHERE id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();


    header(
        "Location: ../pages/books.php?success=deleted"
    );

    exit;


} catch (Exception $e) {

    die("Database Error: " . $e->getMessage());
}