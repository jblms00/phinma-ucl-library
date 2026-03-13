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
    $id = intval($_POST["id"]);
    $id_safe = mysqli_real_escape_string($con, $id);

    $query = "SELECT cover_image FROM books WHERE id = '$id_safe'";
    $result = mysqli_query($con, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
      $data["status"] = "error";
      $data["message"] = "Book not found.";
    } else {
      $book = mysqli_fetch_assoc($result);

      if (!empty($book["cover_image"])) {
        $image_path = "../../" . str_replace("../", "", $book["cover_image"]);

        if (file_exists($image_path)) {
          unlink($image_path);
        }
      }

      $delete = "DELETE FROM books WHERE id = '$id_safe'";

      if (mysqli_query($con, $delete)) {
        $data["status"] = "success";
        $data["message"] = "Book deleted successfully.";
      } else {
        $data["status"] = "error";
        $data["message"] = "Failed to delete book.";
      }
    }
  }

}

echo json_encode($data);