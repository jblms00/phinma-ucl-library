<?php
session_start();

include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$get_users_query = "SELECT * FROM users WHERE email = '$email'";
	$get_users_result = mysqli_query($con, $get_users_query);
	$fetch_users = mysqli_fetch_assoc($get_users_result);

	if ($get_users_result && mysqli_num_rows($get_users_result) <= 0) {
		$data['status'] = "error";
		$data['message'] = "No user found";
	} else if (empty($email) && empty($password)) {
		$data['status'] = "error";
		$data['message'] = "Please enter your email and password";
	} else if (empty($password)) {
		$data['status'] = "error";
		$data['message'] = "Please enter your password";
	} else if ($email != $fetch_users['email']) {
		$data['status'] = "error";
		$data['message'] = "Incorrect email";
	} else if (base64_encode($password) != $fetch_users['password']) {
		$data['status'] = "error";
		$data['message'] = "Incorrect password";
	} else {
		$_SESSION['email'] = $email;
		$data['user_type'] = $fetch_users['user_type'];
		$data['status'] = "success";
		$data['message'] = "Login Successfully!";
	}
}

echo json_encode($data);