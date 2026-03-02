<?php
session_start();
include("../phpscripts/database-connection.php");
header("Content-Type: application/json");

function respond($status, $message = "")
{
  echo json_encode([
    "status" => $status,
    "message" => $message
  ]);
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  respond("error", "Invalid request method.");
}

$role = $_POST["role"] ?? "student";
$role = ($role === "librarian") ? "librarian" : (($role === "admin") ? "admin" : "student");

$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

// accept either field name from your form
$email = trim($_POST["phinma_email"] ?? "");
if ($email === "")
  $email = trim($_POST["student_id"] ?? ""); // fallback
if ($email === "")
  $email = trim($_POST["email"] ?? "");      // extra fallback

if ($username === "" || $password === "" || $email === "") {
  respond("error", "Please complete all fields.");
}

// Basic validations
if (strlen($username) < 3) {
  respond("error", "Username must be at least 3 characters.");
}
if (strlen($password) < 4) {
  respond("error", "Password must be at least 4 characters.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  respond("error", "Please enter a valid email.");
}

// Optional: librarian email must be PHINMA email (adjust if needed)
if ($role === "librarian") {
  $lower = strtolower($email);
  if (strpos($lower, "phinma") === false) {
    respond("error", "Please use your PHINMA email for librarian account.");
  }
}

// Check duplicates: username OR email
$checkSql = "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1";
$checkStmt = mysqli_prepare($con, $checkSql);
mysqli_stmt_bind_param($checkStmt, "ss", $username, $email);
mysqli_stmt_execute($checkStmt);
$checkRes = mysqli_stmt_get_result($checkStmt);

if ($checkRes && mysqli_num_rows($checkRes) > 0) {
  respond("error", "Username or Email already exists.");
}

// Hash password (recommended)
$hashed = password_hash($password, PASSWORD_DEFAULT);

// status default active = 1
$status = 1;

$insertSql = "INSERT INTO users (username, email, password, status, user_type)
              VALUES (?, ?, ?, ?, ?)";
$insertStmt = mysqli_prepare($con, $insertSql);
if (!$insertStmt) {
  respond("error", "Database error (prepare insert).");
}

mysqli_stmt_bind_param($insertStmt, "sssis", $username, $email, $hashed, $status, $role);

if (!mysqli_stmt_execute($insertStmt)) {
  respond("error", "Failed to create account. Try again.");
}

respond("success", "Account created! You can now login.");