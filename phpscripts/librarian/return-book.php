<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = intval($_POST["id"]);
  $query = "UPDATE borrowings SET status = 'returned', returned_at = NOW() WHERE id = '$id'";

  if (mysqli_query($con, $query)) {
    $data["status"] = "success";
    $data["message"] = "Book returned successfully.";
  } else {
    $data["status"] = "error";
    $data["message"] = "Failed to update.";

  }

}

echo json_encode($data);