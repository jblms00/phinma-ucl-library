<?php
session_start();
include("database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  $search = trim($_GET["search"] ?? "");
  $category = trim($_GET["category"] ?? "");

  $search_safe = mysqli_real_escape_string($con, $search);
  $category_safe = mysqli_real_escape_string($con, $category);

  $where = "WHERE 1=1";

  if ($search_safe !== "") {
    $where .= " AND (
			title LIKE '%$search_safe%' OR
			author LIKE '%$search_safe%' OR
			category LIKE '%$search_safe%'
		)";
  }

  if ($category_safe !== "" && $category_safe !== "All") {
    $where .= " AND category = '$category_safe'";
  }

  $get_books_query = "
		SELECT id, title, author, category, cover_image, available_copies
		FROM books
		$where
		ORDER BY created_at DESC
	";

  $get_books_result = mysqli_query($con, $get_books_query);

  if (!$get_books_result) {
    $data["status"] = "error";
    $data["message"] = "Database error.";
  } else {

    $books = [];

    while ($row = mysqli_fetch_assoc($get_books_result)) {

      $cover = $row["cover_image"];
      if (isset($_SESSION["user_id"])) {
        if (strpos($cover, "../") !== 0) {
          $cover = "../" . $cover;
        }

      } else {

        if (strpos($cover, "../") === 0) {
          $cover = substr($cover, 3);
        }
      }

      $row["cover_image"] = $cover;

      $books[] = $row;
    }

    $data["status"] = "success";
    $data["data"] = $books;
  }
} else {
  $data["status"] = "error";
  $data["message"] = "Invalid request method.";
}

echo json_encode($data);