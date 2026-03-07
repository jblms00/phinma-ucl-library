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
  $result = mysqli_query($con, "
		SELECT username, email
		FROM users
		WHERE id = '$user_id'
		LIMIT 1
	");

  if ($result && mysqli_num_rows($result) > 0) {
    $data["status"] = "success";
    $data["data"] = mysqli_fetch_assoc($result);
  } else {
    $data["status"] = "error";
    $data["message"] = "User not found.";
  }
}

echo json_encode($data);