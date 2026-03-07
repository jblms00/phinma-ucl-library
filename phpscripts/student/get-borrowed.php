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

    $user_id = intval($_SESSION["user_id"]);
    $user_id_safe = mysqli_real_escape_string($con, $user_id);

    $query = "
			SELECT b.id,
			       bk.title,
			       b.borrowed_at,
			       b.due_date,
			       (CURDATE() > b.due_date) AS is_overdue
			FROM borrowings b
			JOIN books bk ON bk.id = b.book_id
			WHERE b.user_id = '$user_id_safe'
			AND b.status = 'borrowed'
			ORDER BY b.borrowed_at DESC
		";

    $result = mysqli_query($con, $query);

    if (!$result) {

      $data["status"] = "error";
      $data["message"] = "Database error.";

    } else {

      $books = [];

      while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
      }

      $data["status"] = "success";
      $data["data"] = $books;
    }
  }
}

echo json_encode($data);