<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pages/issue-return.php");
    exit;
}

$studentName = trim($_POST["student_name"]);
$rollNo = trim($_POST["roll_no"]);
$bookId = (int) $_POST["book_id"];
$issueDate = $_POST["issue_date"];
$dueDate = $_POST["due_date"];


if ($dueDate < $issueDate) {
    die("Due date cannot be before issue date.");
}


try {

    $conn->begin_transaction();


    // Check book availability
    $stmt = $conn->prepare(
        "SELECT available
         FROM books
         WHERE id = ?"
    );

    $stmt->bind_param("i", $bookId);
    $stmt->execute();

    $result = $stmt->get_result();
    $book = $result->fetch_assoc();


    if (!$book) {
        throw new Exception("Book not found.");
    }

    if ((int)$book["available"] <= 0) {
        throw new Exception("Book is not available.");
    }


    // Insert issue record
    $stmt = $conn->prepare(
        "INSERT INTO issued_books
        (
            student_name,
            roll_no,
            book_id,
            issue_date,
            due_date,
            status
        )
        VALUES (?, ?, ?, ?, ?, 'Issued')"
    );

    $stmt->bind_param(
        "ssiss",
        $studentName,
        $rollNo,
        $bookId,
        $issueDate,
        $dueDate
    );

    $stmt->execute();


    // Reduce available quantity
    $stmt = $conn->prepare(
        "UPDATE books
         SET available = available - 1
         WHERE id = ?"
    );

    $stmt->bind_param("i", $bookId);
    $stmt->execute();


    $conn->commit();


    header("Location: ../pages/issue-return.php?success=issued");
    exit;


} catch (Exception $e) {

    $conn->rollback();

    die("Database Error: " . $e->getMessage());
}