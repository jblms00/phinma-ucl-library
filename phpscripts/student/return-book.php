<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!isset($_SESSION["user_id"])) {

    $data["status"] = "error";
    $data["message"] = "Unauthorized.";

  } else {

    $borrow_id = intval($_POST["id"] ?? 0);
    $user_id = intval($_SESSION["user_id"]);

    $borrow_id_safe = mysqli_real_escape_string($con, $borrow_id);
    $user_id_safe = mysqli_real_escape_string($con, $user_id);

    $update_query = "
			UPDATE borrowings
			SET status = 'returned'
			WHERE id = '$borrow_id_safe'
			AND user_id = '$user_id_safe'
		";

    if (!mysqli_query($con, $update_query)) {

      $data["status"] = "error";
      $data["message"] = "Database error.";

    } else {

      // restore book copy
      mysqli_query($con, "
				UPDATE books
				SET available_copies = available_copies + 1
				WHERE id = (
					SELECT book_id FROM borrowings
					WHERE id = '$borrow_id_safe'
				)
			");

      $data["status"] = "success";
      $data["message"] = "Book returned successfully.";
    }
  }
}

echo json_encode($data);