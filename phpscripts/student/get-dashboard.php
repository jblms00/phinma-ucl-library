<?php
session_start();
include("../database-connection.php");
header("Content-Type: application/json");

$data = [];

if (!isset($_SESSION["user_id"])) {

  $data["status"] = "error";
  $data["message"] = "Unauthorized.";

} else {

  $user_id = intval($_SESSION["user_id"]);
  $user_id_safe = mysqli_real_escape_string($con, $user_id);

  /* ================= BORROWED COUNT ================= */

  $borrowed_query = "
		SELECT COUNT(id) AS total
		FROM borrowings
		WHERE user_id = '$user_id_safe'
		AND status = 'borrowed'
	";

  $borrowed_result = mysqli_query($con, $borrowed_query);
  $borrowed_data = mysqli_fetch_assoc($borrowed_result);
  $borrowed_total = (int) $borrowed_data["total"];

  /* ================= RESERVATION COUNT ================= */

  $res_query = "
		SELECT COUNT(id) AS total
		FROM reservations
		WHERE user_id = '$user_id_safe'
		AND status = 'pending'
	";

  $res_result = mysqli_query($con, $res_query);
  $res_data = mysqli_fetch_assoc($res_result);
  $res_total = (int) $res_data["total"];

  /* ================= OVERDUE COUNT ================= */

  $overdue_query = "
		SELECT COUNT(id) AS total
		FROM borrowings
		WHERE user_id = '$user_id_safe'
		AND status = 'borrowed'
		AND due_date < CURDATE()
	";

  $overdue_result = mysqli_query($con, $overdue_query);
  $overdue_data = mysqli_fetch_assoc($overdue_result);
  $overdue_total = (int) $overdue_data["total"];

  /* ================= RECENT ACTIVITY ================= */

  $activity_query = "
		(
			SELECT b.title, 'borrowed' AS type, br.borrowed_at AS activity_date
			FROM borrowings br
			JOIN books b ON br.book_id = b.id
			WHERE br.user_id = '$user_id_safe'
		)
		UNION
		(
			SELECT b.title, 'reserved' AS type, r.reserved_at AS activity_date
			FROM reservations r
			JOIN books b ON r.book_id = b.id
			WHERE r.user_id = '$user_id_safe'
		)
		ORDER BY activity_date DESC
		LIMIT 5
	";

  $activity_result = mysqli_query($con, $activity_query);

  $recent = [];

  while ($row = mysqli_fetch_assoc($activity_result)) {

    $message = "";

    if ($row["type"] == "borrowed") {
      $message = "You borrowed \"" . $row["title"] . "\".";
    } else {
      $message = "You reserved \"" . $row["title"] . "\".";
    }

    $recent[] = [
      "message" => $message,
      "date" => $row["activity_date"]
    ];
  }

  $data["status"] = "success";
  $data["data"] = [
    "stats" => [
      "borrowed" => $borrowed_total,
      "reservations" => $res_total,
      "overdue" => $overdue_total
    ],
    "recent" => $recent
  ];
}

echo json_encode($data);