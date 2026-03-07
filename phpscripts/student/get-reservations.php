<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if (!isset($_SESSION["user_id"])) {
  $data["status"] = "error";
  $data["message"] = "Unauthorized.";
} else {

  $user_id = intval($_SESSION["user_id"]);

  $query = "
		SELECT r.id, r.status, r.reserved_at, b.title
		FROM reservations r
		JOIN books b ON r.book_id = b.id
		WHERE r.user_id = '$user_id'
		ORDER BY r.reserved_at DESC
	";

  $result = mysqli_query($con, $query);

  $reservations = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
  }

  $data["status"] = "success";
  $data["data"] = $reservations;
}

echo json_encode($data);