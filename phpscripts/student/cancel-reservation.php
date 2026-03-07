<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {

  $id = intval($_POST["id"]);
  $user_id = intval($_SESSION["user_id"]);

  $query = "
		UPDATE reservations
		SET status = 'cancelled'
		WHERE id = '$id'
		AND user_id = '$user_id'
		AND status = 'pending'
	";

  if (mysqli_query($con, $query)) {
    $data["status"] = "success";
    $data["message"] = "Reservation cancelled.";
  } else {
    $data["status"] = "error";
    $data["message"] = "Failed to cancel reservation.";
  }
}

echo json_encode($data);