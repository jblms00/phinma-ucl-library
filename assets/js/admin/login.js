$(document).ready(function () {
	initAuth();
});

function initAuth() {
	if ($("#adminLoginForm").length) {
		$("#adminLoginForm").on("submit", function (e) {
			e.preventDefault();
			handleLogin($(this));
		});
	}
}

function validateBootstrap($form) {
	if ($form[0].checkValidity() === false) {
		$form.addClass("was-validated");
		return false;
	}

	$form.addClass("was-validated");
	return true;
}

function handleLogin($form) {
	if (!validateBootstrap($form)) return;

	var role = $("body").data("role") || "admin";
	var btn = $("#btnLogin");

	btn.prop("disabled", true);

	$.ajax({
		type: "POST",
		url: "../phpscripts/admin/login.php",
		dataType: "json",
		data: $form.serialize() + "&role=" + encodeURIComponent(role),

		success: function (response) {
			if (response.status === "success") {
				if (window.Swal) {
					Swal.fire({
						icon: "success",
						title: "Login successfully",
						showConfirmButton: false,
						timer: 1200,
						timerProgressBar: true,
					}).then(function () {
						window.location.href = "dashboard";
					});
				} else {
					window.location.href = "dashboard";
				}
			} else {
				showAlert(
					"error",
					"Login failed",
					response.message || "Invalid login credentials.",
				);
			}
		},

		error: function (xhr, status, error) {
			console.log("AJAX Error:", error);
			console.log(xhr.responseText);

			showAlert("error", "Server error", "Please try again.");
		},

		complete: function () {
			btn.prop("disabled", false);
		},
	});
}
