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


$students = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM users WHERE user_type='student'"))["total"];


$librarians = mysqli_fetch_assoc(mysqli_query($con, "
SELECT COUNT(*) as total
FROM users
WHERE user_type='librarian'
"))["total"];


$books = mysqli_fetch_assoc(mysqli_query($con, "
SELECT COUNT(*) as total
FROM books
"))["total"];


$borrowings = mysqli_fetch_assoc(mysqli_query($con, "
SELECT COUNT(*) as total
FROM borrowings
WHERE status='borrowed'
"))["total"];



$borrowChartLabels = [];
$borrowChartValues = [];

$query = mysqli_query($con, "
SELECT MONTHNAME(borrowed_at) as month,
COUNT(*) as total
FROM borrowings
GROUP BY MONTH(borrowed_at)
");

while ($row = mysqli_fetch_assoc($query)) {

  $borrowChartLabels[] = $row["month"];
  $borrowChartValues[] = $row["total"];

}



$resChartLabels = [];
$resChartValues = [];

$query = mysqli_query($con, "
SELECT MONTHNAME(reserved_at) as month,
COUNT(*) as total
FROM reservations
GROUP BY MONTH(reserved_at)
");

while ($row = mysqli_fetch_assoc($query)) {

  $resChartLabels[] = $row["month"];
  $resChartValues[] = $row["total"];

}



$data["status"] = "success";

$data["data"] = [

  "students" => $students,
  "librarians" => $librarians,
  "books" => $books,
  "borrowings" => $borrowings,

  "borrowChart" => [
    "labels" => $borrowChartLabels,
    "values" => $borrowChartValues
  ],

  "reservationChart" => [
    "labels" => $resChartLabels,
    "values" => $resChartValues
  ]

];

echo json_encode($data);