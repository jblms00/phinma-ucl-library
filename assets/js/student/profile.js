$(document).ready(function () {
	loadProfile();
	initProfileForms();
});

function loadProfile() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/student/get-profile.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				$("input[name='username']").val(response.data.username);
				$("input[name='email']").val(response.data.email);
			}
		},
	});
}

function initProfileForms() {
	$("#formUpdateProfile").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "../phpscripts/student/update-profile.php",
			dataType: "json",
			data: $(this).serialize(),
			success: function (response) {
				showAlert(
					response.status === "success" ? "success" : "error",
					"Update Profile",
					response.message,
				);
			},
		});
	});

	$("#formChangePassword").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "../phpscripts/student/change-password.php",
			dataType: "json",
			data: $(this).serialize(),
			success: function (response) {
				showAlert(
					response.status === "success" ? "success" : "error",
					"Change Password",
					response.message,
				);

				if (response.status === "success") {
					$("#formChangePassword")[0].reset();
				}
			},
		});
	});
}
