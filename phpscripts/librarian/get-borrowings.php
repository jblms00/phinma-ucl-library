<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!isset($_SESSION["user_id"])) {
    $data["status"] = "error";
    $data["message"] = "Unauthorized.";
  } else {

    $query = "
      SELECT
        b.id,
        u.username,
        bk.title AS book_title,
        b.borrowed_at,
        b.due_date,
        b.returned_at,
        b.status,
        (CURDATE() > b.due_date AND b.status='borrowed') AS is_overdue
      FROM borrowings b
      JOIN users u ON u.id = b.user_id
      JOIN books bk ON bk.id = b.book_id
      ORDER BY b.borrowed_at DESC
		";

    $result = mysqli_query($con, $query);

    if (!$result) {
      $data["status"] = "error";
      $data["message"] = "Database error.";
    } else {
      $rows = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
      }
      $data["status"] = "success";
      $data["data"] = $rows;
    }
  }
}

echo json_encode($data);