<?php
session_start();
include("database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {

  $user_id = intval($_SESSION["user_id"]);
  $username = mysqli_real_escape_string($con, $_POST["username"]);
  $email = mysqli_real_escape_string($con, $_POST["email"]);

  if (empty($username) || empty($email)) {
    $data["status"] = "error";
    $data["message"] = "All fields are required.";
  } else {

    mysqli_query($con, "
			UPDATE users
			SET username = '$username',
			    email = '$email'
			WHERE id = '$user_id'
		");

    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;

    $data["status"] = "success";
    $data["message"] = "Profile updated successfully.";
  }
}

echo json_encode($data);