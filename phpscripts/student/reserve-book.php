<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {

  $user_id = intval($_SESSION["user_id"]);
  $book_id = intval($_POST["id"] ?? 0);

  if ($book_id <= 0) {
    $data["status"] = "error";
    $data["message"] = "Invalid book ID.";
    echo json_encode($data);
    exit;
  }

  $book = mysqli_fetch_assoc(mysqli_query($con, "
		SELECT available_copies
		FROM books
		WHERE id = '$book_id'
		LIMIT 1
	"));

  if (!$book) {
    $data["status"] = "error";
    $data["message"] = "Book not found.";
    echo json_encode($data);
    exit;
  }

  // Only allow reserve if NO copies
  if ((int) $book["available_copies"] > 0) {
    $data["status"] = "error";
    $data["message"] = "Book is available. Please borrow instead.";
    echo json_encode($data);
    exit;
  }

  // Prevent duplicate reservation
  $check = mysqli_query($con, "
		SELECT id FROM reservations
		WHERE user_id = '$user_id'
		AND book_id = '$book_id'
		AND status = 'pending'
		LIMIT 1
	");

  if ($check && mysqli_num_rows($check) > 0) {
    $data["status"] = "error";
    $data["message"] = "You already reserved this book.";
    echo json_encode($data);
    exit;
  }

  mysqli_query($con, "
		INSERT INTO reservations (user_id, book_id, status)
		VALUES ('$user_id', '$book_id', 'pending')
	");

  $data["status"] = "success";
  $data["message"] = "Book reserved successfully.";

} else {

  $data["status"] = "error";
  $data["message"] = "Invalid request.";

}

echo json_encode($data);