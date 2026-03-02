<?php

function check_login($con)
{
	if (isset($_SESSION['username']) || isset($_SESSION['id']) || isset($_SESSION['user_type'])) {
		$id = $_SESSION['id'];
		$email = $_SESSION['email'];
		$user_type = $_SESSION['user_type'];

		$query = "SELECT * FROM users WHERE id = '$id' OR email = '$email' AND user_type = '$user_type' LIMIT 1";
		$result = mysqli_query($con, $query);

		if ($result && mysqli_num_rows($result) > 0) {
			$users = mysqli_fetch_assoc($result);
			return $users;
		}
	}
	header("Location: ./");
	die;
}
