$(document).ready(function () {
	loadDashboard();
});

function loadDashboard() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/librarian/get-dashboard.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				updateStats(response.data.stats);
				renderMostBorrowed(response.data.mostBorrowed);
				renderFines(response.data.fines);
			}
		},
	});
}

function updateStats(stats) {
	$("#statBooks").text(stats.books);
	$("#statStudents").text(stats.students);
	$("#statBorrowings").text(stats.borrowings);
	$("#statOverdue").text(stats.overdue);
}

let mostChart = null;

function renderMostBorrowed(data) {
	const ctx = document.getElementById("mostBorrowedChart");

	if (!ctx) return;

	if (mostChart) {
		mostChart.destroy();
	}

	mostChart = new Chart(ctx, {
		type: "pie",
		data: {
			labels: data.labels,
			datasets: [
				{
					data: data.counts,
					backgroundColor: ["#3f6179", "#7fa2bb", "#9fbcd1", "#c4d7e6"],
					borderWidth: 0,
				},
			],
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					position: "bottom",
					labels: {
						boxWidth: 12,
						font: {
							size: 12,
						},
					},
				},
			},
		},
	});
}

function renderFines(fines) {
	let container = $("#finesTable");
	container.empty();

	let total = 0;

	if (!fines || fines.length === 0) {
		container.html(`
			<tr>
				<td colspan="5" style="text-align:center; padding:2rem; color:#64748b;">
					No outstanding fines currently.
				</td>
			</tr>
		`);

		$("#fineSummary").text("0 in total");
		return;
	}

	$.each(fines, function (i, fine) {
		total += parseFloat(fine.amount);

		container.append(`
			<tr>
				<td>${fine.title}</td>
				<td>${fine.borrower}</td>
				<td>${formatDate(fine.due_date)}</td>
				<td>${fine.days_late} days</td>
				<td>₱${parseFloat(fine.amount).toFixed(2)}</td>
			</tr>
		`);
	});

	$("#fineSummary").text(`${fines.length} in total`);
}
