<?php
session_start();
include("database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"] ?? "");
  $password = $_POST["password"] ?? "";

  $role = $_POST["role"] ?? "student";
  $role = ($role === "admin") ? "admin" : (($role === "librarian") ? "librarian" : "student");

  $extra = trim($_POST["phinma_email"] ?? "");
  if ($extra === "")
    $extra = trim($_POST["student_id"] ?? "");
  if ($extra === "")
    $extra = trim($_POST["email"] ?? "");

  if (empty($username) || empty($password) || empty($extra)) {
    $data["status"] = "error";
    $data["message"] = "Please complete all fields.";
  } else if (strlen($username) < 3) {
    $data["status"] = "error";
    $data["message"] = "Username must be at least 3 characters.";
  } else if (strlen($password) < 4) {
    $data["status"] = "error";
    $data["message"] = "Password must be at least 4 characters.";
  } else if (($role === "librarian" || $role === "admin") && !filter_var($extra, FILTER_VALIDATE_EMAIL)) {
    $data["status"] = "error";
    $data["message"] = "Please enter a valid email.";
  } else {
    $username_safe = mysqli_real_escape_string($con, $username);
    $extra_safe = mysqli_real_escape_string($con, $extra);
    $role_safe = mysqli_real_escape_string($con, $role);

    $check_query = "SELECT id FROM users WHERE username = '$username_safe' OR email = '$extra_safe' LIMIT 1";
    $check_result = mysqli_query($con, $check_query);

    if (!$check_result) {
      $data["status"] = "error";
      $data["message"] = "Database error.";
    } else if ($check_result && mysqli_num_rows($check_result) > 0) {
      $data["status"] = "error";
      $data["message"] = "Username or Email/ID already exists.";
    } else {
      $pass_store = mysqli_real_escape_string($con, base64_encode($password));
      $status = 1;

      $insert_query = "
				INSERT INTO users (username, email, password, status, user_type)
				VALUES ('$username_safe', '$extra_safe', '$pass_store', '$status', '$role_safe')
			";
      $insert_result = mysqli_query($con, $insert_query);

      if ($insert_result) {
        $data["status"] = "success";
        $data["message"] = "Account created! You can now login.";
      } else {
        $data["status"] = "error";
        $data["message"] = "Failed to create account. Please try again.";
      }
    }
  }
} else {
  $data["status"] = "error";
  $data["message"] = "Invalid request method.";
}

echo json_encode($data);