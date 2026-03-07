<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {

  $user_id = intval($_SESSION["user_id"]);

  $current = $_POST["current_password"] ?? "";
  $new = $_POST["new_password"] ?? "";
  $confirm = $_POST["confirm_password"] ?? "";

  if (empty($current) || empty($new) || empty($confirm)) {
    $data["status"] = "error";
    $data["message"] = "All fields are required.";
  } else if ($new !== $confirm) {
    $data["status"] = "error";
    $data["message"] = "Passwords do not match.";
  } else {

    $result = mysqli_query($con, "
			SELECT password FROM users WHERE id = '$user_id'
		");

    $user = mysqli_fetch_assoc($result);

    if (base64_encode($current) !== $user["password"]) {
      $data["status"] = "error";
      $data["message"] = "Current password is incorrect.";
    } else {

      $new_encoded = base64_encode($new);

      mysqli_query($con, "
				UPDATE users
				SET password = '$new_encoded'
				WHERE id = '$user_id'
			");

      $data["status"] = "success";
      $data["message"] = "Password changed successfully.";
    }
  }
}

echo json_encode($data);