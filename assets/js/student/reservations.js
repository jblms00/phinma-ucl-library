$(document).ready(function () {
	loadReservations();
});

let reservationTable = null;

function loadReservations() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/student/get-reservations.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				renderReservations(response.data);
			}
		},
	});
}

function renderReservations(data) {
	const tableElement = document.getElementById("reservationTable");
	const tableBody = $("#reservationTable tbody");

	if (reservationTable) {
		reservationTable.destroy();
		reservationTable = null;
	}

	tableBody.empty();

	if (data.length === 0) {
		$("#reservationEmpty").show();
		return;
	}

	$("#reservationEmpty").hide();

	$.each(data, function (index, item) {
		let statusClass =
			item.status === "approved"
				? "secReservation__status--approved"
				: item.status === "cancelled"
					? "secReservation__status--cancelled"
					: "secReservation__status--pending";

		let actionBtn = "";

		if (item.status === "pending") {
			actionBtn = `
				<button class="secReservation__btn"
					onclick="cancelReservation(${item.id})">
					Cancel
				</button>
			`;
		}

		tableBody.append(`
			<tr>
				<td>${item.title}</td>
				<td>${formatDate(item.reserved_at)}</td>
				<td>
					<span class="secReservation__status ${statusClass}">
						${item.status}
					</span>
				</td>
				<td>${actionBtn}</td>
			</tr>
		`);
	});

	reservationTable = new DataTable(tableElement, {
		pageLength: 5,
		lengthChange: true,
		order: [[1, "desc"]],
	});
}

function cancelReservation(id) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/student/cancel-reservation.php",
		dataType: "json",
		data: { id: id },
		success: function (response) {
			showAlert(
				response.status === "success" ? "success" : "error",
				"Reservation",
				response.message,
			);

			if (response.status === "success") {
				loadReservations();
			}
		},
	});
}
