<?php
session_start();
include("database-connection.php");
header("Content-Type: application/json");

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$identifier = trim($_POST["username"] ?? "");
	if ($identifier === "")
		$identifier = trim($_POST["email"] ?? "");

	$password = $_POST["password"] ?? "";

	$role = $_POST["role"] ?? "student";
	$role = ($role === "admin") ? "admin" : (($role === "librarian") ? "librarian" : "student");

	if (empty($identifier) && empty($password)) {
		$data["status"] = "error";
		$data["message"] = "Please enter your username/email and password.";
	} else if (empty($identifier)) {
		$data["status"] = "error";
		$data["message"] = "Please enter your username/email.";
	} else if (empty($password)) {
		$data["status"] = "error";
		$data["message"] = "Please enter your password.";
	} else {
		$identifier_safe = mysqli_real_escape_string($con, $identifier);
		$role_safe = mysqli_real_escape_string($con, $role);

		$get_users_query = "
			SELECT * FROM users
			WHERE (email = '$identifier_safe' OR username = '$identifier_safe')
			AND user_type = '$role_safe'
			LIMIT 1
		";
		$get_users_result = mysqli_query($con, $get_users_query);

		if ($get_users_result && mysqli_num_rows($get_users_result) <= 0) {
			$data["status"] = "error";
			$data["message"] = ucfirst($role) . " account not found.";
		} else if (!$get_users_result) {
			$data["status"] = "error";
			$data["message"] = "Database error.";
		} else {
			$fetch_users = mysqli_fetch_assoc($get_users_result);

			if ((int) $fetch_users["status"] !== 1) {
				$data["status"] = "error";
				$data["message"] = "Account is inactive. Please contact admin.";
			} else if (base64_encode($password) != $fetch_users["password"]) {
				$data["status"] = "error";
				$data["message"] = "Incorrect password.";
			} else {
				$_SESSION["user_id"] = $fetch_users["id"];
				$_SESSION["user_type"] = $fetch_users["user_type"];
				$_SESSION["username"] = $fetch_users["username"];
				$_SESSION["email"] = $fetch_users["email"];

				$data["status"] = "success";
				$data["message"] = "Login Successfully!";
				$data["redirect"] =
					($role === "admin") ? "pages/admin/adminDashboard" :
					(($role === "librarian") ? "pages/librarian/librarianDashboard" : "pages/student/studentDashboard");
			}
		}
	}
} else {
	$data["status"] = "error";
	$data["message"] = "Invalid request method.";
}

echo json_encode($data);