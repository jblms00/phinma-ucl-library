$(document).ready(function () {
	loadDashboard();
});

function loadDashboard() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/admin/get-dashboard.php",
		dataType: "json",

		success: function (response) {
			if (response.status === "success") {
				$("#totalStudents").text(response.data.students);
				$("#totalLibrarians").text(response.data.librarians);
				$("#totalBooks").text(response.data.books);
				$("#totalBorrowings").text(response.data.borrowings);

				renderBorrowChart(response.data.borrowChart);
				renderReservationChart(response.data.reservationChart);
			}
		},
	});
}

function renderBorrowChart(data) {
	new Chart(document.getElementById("borrowChart"), {
		type: "bar",
		data: {
			labels: data.labels,
			datasets: [
				{
					label: "Borrowings",
					data: data.values,
				},
			],
		},
	});
}

function renderReservationChart(data) {
	new Chart(document.getElementById("reservationChart"), {
		type: "line",
		data: {
			labels: data.labels,
			datasets: [
				{
					label: "Reservations",
					data: data.values,
				},
			],
		},
	});
}
