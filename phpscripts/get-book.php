<?php
session_start();
include("database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  $book_id = intval($_GET["id"] ?? 0);

  if ($book_id <= 0) {

    $data["status"] = "error";
    $data["message"] = "Invalid book ID.";

  } else {

    $book_id_safe = mysqli_real_escape_string($con, $book_id);

    $get_book_query = "
      SELECT *
      FROM books
      WHERE id = '$book_id_safe'
      LIMIT 1
    ";

    $get_book_result = mysqli_query($con, $get_book_query);

    if (!$get_book_result) {

      $data["status"] = "error";
      $data["message"] = "Database error.";

    } else if (mysqli_num_rows($get_book_result) <= 0) {

      $data["status"] = "error";
      $data["message"] = "Book not found.";

    } else {

      $row = mysqli_fetch_assoc($get_book_result);

      $cover = $row["cover_image"];

      if (isset($_SESSION["user_id"])) {
        if (strpos($cover, "../") !== 0) {
          $cover = "../" . $cover;
        }
      } else {
        if (strpos($cover, "../") === 0) {
          $cover = substr($cover, 3);
        }
      }

      $row["cover_image"] = $cover;

      $data["status"] = "success";
      $data["data"] = $row;
    }
  }

} else {

  $data["status"] = "error";
  $data["message"] = "Invalid request method.";
}

echo json_encode($data);