$(document).ready(function () {
	loadBorrowings();
});

let borrowingsTable = null;
let borrowingsData = [];

function loadBorrowings() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/librarian/get-borrowings.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				renderBorrowings(response.data);
			}
		},
	});
}

function renderBorrowings(borrowings) {
	borrowingsData = borrowings;

	const tableElement = document.getElementById("borrowingsTable");
	const tableBody = $("#borrowingsTable tbody");

	if (borrowingsTable) {
		borrowingsTable.destroy();
	}

	tableBody.empty();

	$.each(borrowings, function (index, row) {
		let statusClass = "secBorrowings__status--borrowed";
		let statusText = "Borrowed";

		if (row.is_overdue == 1) {
			statusClass = "secBorrowings__status--overdue";
			statusText = "Overdue";
		}

		if (row.status === "returned") {
			statusClass = "secBorrowings__status--returned";
			statusText = "Returned";
		}

		let returnedDate = `<span class="text-muted">—</span>`;

		if (row.returned_at) {
			returnedDate = formatDate(row.returned_at);
		}

		let actionButton = "";

		if (row.status !== "returned") {
			actionButton = `
				<button class="btn btn-md fs-5"
					style="background:var(--primary-900);color:white"
					onclick="markReturned(${row.id})">
					Return
				</button>
			`;
		}

		tableBody.append(`
			<tr>
				<td>${row.username}</td>
				<td>${row.book_title}</td>
				<td>${formatDate(row.borrowed_at)}</td>
				<td>${formatDate(row.due_date)}</td>
				<td>${returnedDate}</td>
				<td>
					<span class="secBorrowings__status ${statusClass}">
						${statusText}
					</span>
				</td>
				<td>${actionButton}</td>
			</tr>
		`);
	});

	borrowingsTable = new DataTable(tableElement, {
		pageLength: 5,
		lengthChange: true,
		order: [[2, "desc"]],
	});
}

function markReturned(id) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/librarian/return-book.php",
		dataType: "json",
		data: { id: id },

		success: function (response) {
			showAlert(
				response.status === "success" ? "success" : "error",
				"Return Book",
				response.message,
			);

			if (response.status === "success") {
				loadBorrowings();
			}
		},
	});
}
