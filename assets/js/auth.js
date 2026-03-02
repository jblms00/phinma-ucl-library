$(document).ready(function () {
	initAuth();
});

function initAuth() {
	if ($("#formLogin").length) {
		$("#formLogin").on("submit", function (e) {
			e.preventDefault();
			handleLogin($(this));
		});
	}

	if ($("#formCreateAccount").length) {
		$("#formCreateAccount").on("submit", function (e) {
			e.preventDefault();
			handleCreateAccount($(this));
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

function showAlert(type, title, text) {
	// fallback para di mag crash pag di loaded si Swal
	if (window.Swal) {
		Swal.fire({
			icon: type,
			title: title,
			text: text,
			confirmButtonText: "OK",
		});
	} else {
		alert(title + "\n" + text);
	}
}

function handleLogin($form) {
	if (!validateBootstrap($form)) return;

	var role = $("body").data("role") || "student";
	var btn = $("#btnLogin");
	btn.prop("disabled", true);

	$.ajax({
		type: "POST",
		url: "./phpscripts/login.php",
		dataType: "json",
		data: $form.serialize() + "&role=" + encodeURIComponent(role),
		success: function (response) {
			if (response.status === "success") {
				if (window.Swal) {
					Swal.fire({
						icon: "success",
						title: "Login successful",
						text: response.message || "Welcome!",
						confirmButtonText: "Continue",
					}).then(function () {
						window.location.href =
							response.redirect ||
							(role === "librarian"
								? "librarianDashboard"
								: "studentDashboard");
					});
				} else {
					window.location.href =
						response.redirect ||
						(role === "librarian"
							? "librarianDashboard"
							: "studentDashboard");
				}
			} else {
				showAlert(
					"error",
					"Login failed",
					response.message || "Invalid username or password.",
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

function handleCreateAccount($form) {
	if (!validateBootstrap($form)) return;

	var role = $("body").data("role") || "student";
	var btn = $("#btnCreateAccount");
	btn.prop("disabled", true);

	$.ajax({
		type: "POST",
		url: "./phpscripts/create-account.php",
		dataType: "json",
		data: $form.serialize() + "&role=" + encodeURIComponent(role),
		success: function (response) {
			if (response.status === "success") {
				if (window.Swal) {
					Swal.fire({
						icon: "success",
						title: "Account created!",
						text: response.message || "You can now login.",
						confirmButtonText: "Go to Login",
					}).then(function () {
						window.location.href = "login?role=" + role;
					});
				} else {
					window.location.href = "login?role=" + role;
				}
			} else {
				showAlert(
					"error",
					"Create failed",
					response.message || "Please check your details.",
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
