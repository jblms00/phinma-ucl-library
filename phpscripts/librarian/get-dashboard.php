<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] !== "librarian") {
  $data["status"] = "error";
  $data["message"] = "Unauthorized.";
} else {

  /* =========================
     BASIC STATS
  ========================== */
  $books = mysqli_fetch_assoc(mysqli_query(
    $con,
    "SELECT COUNT(id) as total FROM books"
  ))["total"];

  $students = mysqli_fetch_assoc(mysqli_query(
    $con,
    "SELECT COUNT(id) as total FROM users WHERE user_type='student'"
  ))["total"];

  $borrowings = mysqli_fetch_assoc(mysqli_query(
    $con,
    "SELECT COUNT(id) as total FROM borrowings WHERE status='borrowed'"
  ))["total"];

  $overdue = mysqli_fetch_assoc(mysqli_query(
    $con,
    "SELECT COUNT(id) as total 
     FROM borrowings
     WHERE status='borrowed'
     AND due_date < CURDATE()"
  ))["total"];


  /* =========================
     RECENT ACTIVITY
  ========================== */
  $recent_result = mysqli_query(
    $con,
    "SELECT u.username, b.title, br.borrowed_at
     FROM borrowings br
     JOIN users u ON br.user_id = u.id
     JOIN books b ON br.book_id = b.id
     ORDER BY br.borrowed_at DESC
     LIMIT 5"
  );

  $recent = [];

  while ($row = mysqli_fetch_assoc($recent_result)) {

    $recent[] = [
      "message" => $row["username"] . " borrowed \"" . $row["title"] . "\".",
      "date" => $row["borrowed_at"]
    ];
  }

  /* =========================
     MOST BORROWED (GRAPH)
  ========================== */
  $most_query = "
    SELECT b.title, COUNT(br.id) AS total
    FROM borrowings br
    JOIN books b ON br.book_id = b.id
    GROUP BY br.book_id
    ORDER BY total DESC
    LIMIT 5
  ";

  $most_result = mysqli_query($con, $most_query);

  $labels = [];
  $counts = [];

  while ($row = mysqli_fetch_assoc($most_result)) {
    $labels[] = $row["title"];
    $counts[] = (int) $row["total"];
  }


  /* =========================
     FINES (₱5 per day)
  ========================== */
  $fine_query = "
    SELECT 
      b.title,
      u.username,
      br.due_date,
      DATEDIFF(CURDATE(), br.due_date) AS days_late,
      (DATEDIFF(CURDATE(), br.due_date) * 5) AS fine_amount
    FROM borrowings br
    JOIN books b ON br.book_id = b.id
    JOIN users u ON br.user_id = u.id
    WHERE br.status = 'borrowed'
    AND br.due_date < CURDATE()
  ";

  $fine_result = mysqli_query($con, $fine_query);
  $fines = [];

  while ($row = mysqli_fetch_assoc($fine_result)) {

    $fines[] = [
      "title" => $row["title"],
      "borrower" => $row["username"],
      "due_date" => $row["due_date"],
      "days_late" => (int) $row["days_late"],
      "amount" => number_format($row["fine_amount"], 2)
    ];
  }


  /* =========================
     FINAL RESPONSE
  ========================== */
  $data["status"] = "success";
  $data["data"] = [

    "stats" => [
      "books" => (int) $books,
      "students" => (int) $students,
      "borrowings" => (int) $borrowings,
      "overdue" => (int) $overdue
    ],
    "recent" => $recent,
    "mostBorrowed" => [
      "labels" => $labels,
      "counts" => $counts
    ],
    "fines" => $fines

  ];
}

echo json_encode($data);