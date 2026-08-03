<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once "../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: ../pages/issue-return.php");
    exit;
}

$issueId = (int) $_GET["id"];

try {

    $conn->begin_transaction();

    // Get issue record
    $stmt = $conn->prepare(
        "SELECT book_id, status
         FROM issued_books
         WHERE id = ?"
    );

    $stmt->bind_param("i", $issueId);
    $stmt->execute();

    $result = $stmt->get_result();
    $issue = $result->fetch_assoc();


    if (!$issue) {
        throw new Exception("Issue record not found.");
    }


    // Prevent returning the same book twice
    if ($issue["status"] === "Returned") {
        throw new Exception("Book has already been returned.");
    }


    $bookId = (int) $issue["book_id"];


    // Mark as returned
    $stmt = $conn->prepare(
        "UPDATE issued_books
         SET status = 'Returned',
             return_date = CURDATE()
         WHERE id = ?"
    );

    $stmt->bind_param("i", $issueId);
    $stmt->execute();


    // Increase available copies
    $stmt = $conn->prepare(
        "UPDATE books
         SET available = available + 1
         WHERE id = ?"
    );

    $stmt->bind_param("i", $bookId);
    $stmt->execute();


    $conn->commit();

    header("Location: ../pages/issue-return.php?success=returned");
    exit;


} catch (Exception $e) {

    $conn->rollback();

    die("Database Error: " . $e->getMessage());
}