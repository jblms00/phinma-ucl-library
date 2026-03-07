$(document).ready(function () {
	loadBorrowed();
});

let borrowedTable = null;

function loadBorrowed() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/student/get-borrowed.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				renderBorrowed(response.data);
			}
		},
	});
}

function renderBorrowed(books) {
	const tableElement = document.getElementById("borrowedTable");
	const tableBody = $("#borrowedTable tbody");

	if (borrowedTable) {
		borrowedTable.destroy();
		borrowedTable = null;
	}

	tableBody.empty();

	if (books.length === 0) {
		$("#borrowedEmpty").show();
		return;
	}

	$("#borrowedEmpty").hide();

	$.each(books, function (index, book) {
		let statusClass =
			book.is_overdue == 1
				? "secBorrowed__status--overdue"
				: "secBorrowed__status--borrowed";

		let statusText = book.is_overdue == 1 ? "Overdue" : "Borrowed";

		tableBody.append(`
			<tr>
				<td>${book.title}</td>
				<td>${formatDate(book.borrowed_at)}</td>
				<td>${formatDate(book.due_date)}</td>
				<td>
					<span class="secBorrowed__status ${statusClass}">
						${statusText}
					</span>
				</td>
				<td>
					<button class="secBorrowed__btn"
						onclick="returnBook(${book.id})">
						Return
					</button>
				</td>
			</tr>
		`);
	});

	borrowedTable = new DataTable(tableElement, {
		pageLength: 5,
		lengthChange: true,
		order: [[1, "desc"]],
	});
}

function returnBook(id) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/student/return-book.php",
		dataType: "json",
		data: { id: id },
		success: function (response) {
			showAlert(
				response.status === "success" ? "success" : "error",
				"Return Book",
				response.message,
			);

			if (response.status === "success") {
				if (borrowedTable) {
					borrowedTable.destroy();
					borrowedTable = null;
				}
				loadBorrowed();
			}
		},
	});
}
