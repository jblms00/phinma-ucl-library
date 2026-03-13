<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if (!isset($_SESSION["user_id"])) {
  $data["status"] = "error";
  $data["message"] = "Unauthorized.";

  echo json_encode($data);
  exit;

}
$currentAdmin = $_SESSION["user_id"];


/* ================= ADMINS ================= */
$admins = [];
$query = mysqli_query($con, "SELECT id,username,email,status,datetime_created FROM users WHERE user_type='admin' AND id != '$currentAdmin' ");

while ($row = mysqli_fetch_assoc($query)) {
  $admins[] = $row;
}


/* ================= LIBRARIANS ================= */
$librarians = [];
$query = mysqli_query($con, "SELECT id, username, email, status, datetime_created FROM users WHERE user_type ='librarian'");

while ($row = mysqli_fetch_assoc($query)) {
  $librarians[] = $row;
}


/* ================= STUDENTS ================= */
$students = [];
$query = mysqli_query($con, "SELECT id,username,email,status,datetime_created FROM users WHERE user_type='student'");
while ($row = mysqli_fetch_assoc($query)) {
  $students[] = $row;
}

$data["status"] = "success";
$data["data"] = [
  "admins" => $admins,
  "librarians" => $librarians,
  "students" => $students

];

echo json_encode($data);