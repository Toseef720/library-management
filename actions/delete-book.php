<?php

require_once "../config/database.php";

if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $stmt = $conn->prepare(
        "SELECT COUNT(*) AS total
         FROM issued_books
         WHERE book_id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row["total"] == 0) {

        $stmt = $conn->prepare(
            "DELETE FROM books WHERE id = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

}

header("Location: ../pages/books.php");
exit;