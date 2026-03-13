<?php
session_start();
include("../database-connection.php");

header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = mysqli_real_escape_string($con, $_POST["title"]);
  $author = mysqli_real_escape_string($con, $_POST["author"]);
  $category = mysqli_real_escape_string($con, $_POST["category"]);
  $description = mysqli_real_escape_string($con, $_POST["description"]);
  $total = intval($_POST["total_copies"]);

  $cover = "";

  $cover = "";

  if (!empty($_FILES["cover_image"]["name"])) {

    $upload_dir = "../../assets/img/bookCovers/";

    // make sure folder exists
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0777, true);
    }

    $original = basename($_FILES["cover_image"]["name"]);

    // clean filename
    $clean_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $original);
    $filename = time() . "_" . $clean_name;
    $target = $upload_dir . $filename;

    if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target)) {
      $cover = "../assets/img/bookCovers/" . $filename;

    }
  }

  $query = "
    INSERT INTO books
    (title, author, category, description, total_copies, available_copies, cover_image)
    VALUES
    ('$title','$author','$category','$description','$total','$total','$cover')
	";

  if (mysqli_query($con, $query)) {

    $data["status"] = "success";
    $data["message"] = "Book added successfully.";

  } else {

    $data["status"] = "error";
    $data["message"] = "Failed to add book.";
  }
}

echo json_encode($data);