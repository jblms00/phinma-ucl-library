$(document).ready(function () {
	loadReservations();
});

let reservationsTable = null;
let reservationsData = [];

function loadReservations() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/librarian/get-reservations.php",
		dataType: "json",

		success: function (response) {
			if (response.status === "success") {
				renderReservations(response.data);
			}
		},
	});
}

function renderReservations(reservations) {
	reservationsData = reservations;

	const tableElement = document.getElementById("reservationsTable");
	const tableBody = $("#reservationsTable tbody");

	if (reservationsTable) {
		reservationsTable.destroy();
	}

	tableBody.empty();

	$.each(reservations, function (index, row) {
		let statusClass = "secReservations__status--pending";

		if (row.status === "approved") {
			statusClass = "secReservations__status--approved";
		}

		if (row.status === "cancelled") {
			statusClass = "secReservations__status--cancelled";
		}

		let actionButtons = "";

		if (row.status === "pending") {
			actionButtons = `
        <button class="btn btn-md fs-5 me-1"
          style="background:var(--primary-900);color:white"
          onclick="updateReservation(${row.id},'approved')">
          Approve
        </button>
        <button class="btn btn-md fs-5 btn-danger" onclick="updateReservation(${row.id},'cancelled')">
          Cancel
        </button>
			`;
		}

		tableBody.append(`
      <tr>
        <td>${row.username}</td>
        <td>${row.book_title}</td>
        <td>${formatDate(row.reserved_at)}</td>
        <td>
          <span class="secReservations__status ${statusClass}">
            ${row.status}
          </span>
        </td>
        <td>${actionButtons}</td>
      </tr>
		`);
	});

	reservationsTable = new DataTable(tableElement, {
		pageLength: 5,
		lengthChange: true,
		order: [[2, "desc"]],
	});
}

function updateReservation(id, status) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/librarian/update-reservation.php",
		dataType: "json",
		data: {
			id: id,
			status: status,
		},

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
