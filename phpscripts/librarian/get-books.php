<?php
session_start();
include("../database-connection.php");

header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  if (!isset($_SESSION["user_id"])) {

    $data["status"] = "error";
    $data["message"] = "Unauthorized.";

  } else {
    $query = "SELECT * FROM books ORDER BY created_at DESC";
    $result = mysqli_query($con, $query);

    if (!$result) {
      $data["status"] = "error";
      $data["message"] = "Database error.";

    } else {
      $books = [];

      while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
      }

      $data["status"] = "success";
      $data["data"] = $books;
    }
  }
}

echo json_encode($data);