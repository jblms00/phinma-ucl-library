<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!isset($_SESSION["user_id"])) {

    $data["status"] = "error";
    $data["message"] = "You must be logged in.";

  } else {

    $user_id = intval($_SESSION["user_id"]);
    $book_id = intval($_POST["id"] ?? 0);

    if ($book_id <= 0) {

      $data["status"] = "error";
      $data["message"] = "Invalid book ID.";

    } else {

      $user_id_safe = mysqli_real_escape_string($con, $user_id);
      $book_id_safe = mysqli_real_escape_string($con, $book_id);

      // Check book availability
      $book_query = "
        SELECT available_copies
        FROM books
        WHERE id = '$book_id_safe'
        LIMIT 1
      ";

      $book_result = mysqli_query($con, $book_query);

      if (!$book_result || mysqli_num_rows($book_result) <= 0) {

        $data["status"] = "error";
        $data["message"] = "Book not found.";

      } else {

        $book = mysqli_fetch_assoc($book_result);

        if ((int) $book["available_copies"] <= 0) {

          $data["status"] = "error";
          $data["message"] = "No available copies. You may reserve it.";

        } else {

          // Check already borrowed
          $borrow_check = mysqli_query($con, "
            SELECT id FROM borrowings
            WHERE user_id = '$user_id_safe'
            AND book_id = '$book_id_safe'
            AND status = 'borrowed'
            LIMIT 1
          ");

          if ($borrow_check && mysqli_num_rows($borrow_check) > 0) {

            $data["status"] = "error";
            $data["message"] = "You already borrowed this book.";

          } else {

            // Check borrow limit (max 3 active)
            $limit_check = mysqli_query($con, "
              SELECT COUNT(id) as total
              FROM borrowings
              WHERE user_id = '$user_id_safe'
              AND status = 'borrowed'
            ");

            $limit_data = mysqli_fetch_assoc($limit_check);

            if ((int) $limit_data["total"] >= 3) {

              $data["status"] = "error";
              $data["message"] = "Borrow limit reached (max 3 books).";

            } else {

              // Insert borrowing
              $insert_query = "
                INSERT INTO borrowings (user_id, book_id, due_date)
                VALUES (
                  '$user_id_safe',
                  '$book_id_safe',
                  DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                )
              ";

              if (!mysqli_query($con, $insert_query)) {

                $data["status"] = "error";
                $data["message"] = "Database error.";

              } else {

                // Reduce available copies
                mysqli_query($con, "
                  UPDATE books
                  SET available_copies = available_copies - 1
                  WHERE id = '$book_id_safe'
                ");

                $data["status"] = "success";
                $data["message"] = "Book borrowed successfully.";
              }
            }
          }
        }
      }
    }
  }

} else {

  $data["status"] = "error";
  $data["message"] = "Invalid request method.";
}

echo json_encode($data);