<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"] ?? "");
  $password = $_POST["password"] ?? "";
  $role = $_POST["role"] ?? "admin";

  if ($email === "" && $password === "") {
    $data["status"] = "error";
    $data["message"] = "Please enter your email and password.";
  } else if ($email === "") {
    $data["status"] = "error";
    $data["message"] = "Please enter your email.";
  } else if ($password === "") {
    $data["status"] = "error";
    $data["message"] = "Please enter your password.";
  } else {
    $email_safe = mysqli_real_escape_string($con, $email);
    $role_safe = mysqli_real_escape_string($con, $role);

    $query = "SELECT * FROM users WHERE email = '$email_safe' AND user_type = '$role_safe' LIMIT 1 ";

    $result = mysqli_query($con, $query);

    if (!$result) {
      $data["status"] = "error";
      $data["message"] = "Database error.";
    } else if (mysqli_num_rows($result) <= 0) {
      $data["status"] = "error";
      $data["message"] = "Admin account not found.";
    } else {
      $user = mysqli_fetch_assoc($result);

      if ((int) $user["status"] !== 1) {
        $data["status"] = "error";
        $data["message"] = "Account is inactive. Contact admin.";
      } else if (base64_encode($password) != $user["password"]) {
        $data["status"] = "error";
        $data["message"] = "Incorrect password.";
      } else {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_type"] = $user["user_type"];
        $_SESSION["email"] = $user["email"];

        $data["status"] = "success";
        $data["message"] = "Admin login successful.";
      }
    }
  }
} else {
  $data["status"] = "error";
  $data["message"] = "Invalid request method.";

}

echo json_encode($data);