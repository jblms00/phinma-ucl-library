$(document).ready(function () {
	loadDashboard();
});

function loadDashboard() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/student/get-dashboard.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				updateStats(response.data.stats);
				renderActivity(response.data.recent);
			} else {
				console.log(response.message);
			}
		},
		error: function () {
			console.log("Dashboard load error");
		},
	});
}

/* ================= UPDATE STATS ================= */
function updateStats(stats) {
	const cards = $(".secStudentDashboard__cardValue");

	cards.eq(0).text(stats.borrowed);
	cards.eq(1).text(stats.reservations);
	cards.eq(2).text(stats.overdue);
}

/* ================= RECENT ACTIVITY ================= */
function renderActivity(items) {
	const container = $(".secStudentDashboard__panelBody");
	container.empty();

	if (items.length === 0) {
		container.html(`
			<div class="secStudentDashboard__row">
				<p class="secStudentDashboard__rowMain">
					No recent activity.
				</p>
			</div>
		`);
		return;
	}

	$.each(items, function (index, item) {
		container.append(`
			<div class="secStudentDashboard__row">
				<p class="secStudentDashboard__rowMain">
					${item.message}
				</p>
				<p class="secStudentDashboard__rowSub">
					${formatDateTime(item.date)}
				</p>
			</div>
		`);
	});
}
