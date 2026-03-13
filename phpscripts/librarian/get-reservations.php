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
        r.id,
        u.username,
        b.title AS book_title,
        r.reserved_at,
        r.status
      FROM reservations r
      JOIN users u ON u.id = r.user_id
      JOIN books b ON b.id = r.book_id
      ORDER BY r.reserved_at DESC
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