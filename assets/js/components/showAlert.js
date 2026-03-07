function showAlert(type, title, text) {
	if (!window.Swal) {
		alert(title + "\n" + text);
		return;
	}

	Swal.fire({
		icon: type,
		title: title,
		text: text,
		showConfirmButton: false,
		timer: 1200,
		timerProgressBar: true,
	});
}
