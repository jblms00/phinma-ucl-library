<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = intval($_POST["id"]);
  $status = mysqli_real_escape_string($con, $_POST["status"]);

  $query = "UPDATE reservations SET status = '$status' WHERE id = '$id'";

  if (mysqli_query($con, $query)) {
    $data["status"] = "success";
    $data["message"] = "Reservation updated.";
  } else {
    $data["status"] = "error";
    $data["message"] = "Failed to update.";
  }
}

echo json_encode($data);