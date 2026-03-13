$(document).ready(function () {
	initBook();
});

function initBook() {
	if (BOOK_ID > 0) {
		loadBookDetails();
	} else {
		$("#bookDetails").html("<p>Invalid book.</p>");
	}
}

function loadBookDetails() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/get-book.php",
		dataType: "json",
		data: { id: BOOK_ID },
		success: function (response) {
			if (response.status === "success") {
				$("#breadBookTitle").text(response.data.title);

				renderBook(response.data);
			} else {
				$("#bookDetails").html("<p>Book not found.</p>");
			}
		},
		error: function () {
			$("#bookDetails").html("<p>Server error.</p>");
		},
	});
}

function renderBook(book) {
	let actionButton = "";

	/* ================= BUTTON LOGIC ================= */
	if (book.is_borrowed == 1) {
		actionButton = `
			<button class="secBook__btn secBook__btn--disabled" disabled>
				Already Borrowed
			</button>
		`;
	} else if (parseInt(book.available_copies) > 0) {
		// If stock exists → ONLY Borrow
		actionButton = `
			<button class="secBook__btn secBook__btn--borrow"
				onclick="borrowBook(${book.id})">
				Borrow
			</button>
		`;
	} else {
		// No stock → ONLY Reserve
		if (book.is_reserved == 1) {
			actionButton = `
				<button class="secBook__btn secBook__btn--disabled" disabled>
					Reserved
				</button>
			`;
		} else {
			actionButton = `
				<button class="secBook__btn secBook__btn--reserve"
					onclick="reserveBook(${book.id})">
					Reserve
				</button>
			`;
		}
	}

	let html = `
	<div class="secBook__layout">
		<div class="secBook__cover">
			<img src="${book.cover_image}" alt="">
		</div>
		<div class="secBook__info">
			<div class="d-flex justify-content-between mb-3">
				<h1 class="secBook__title">${book.title}</h1>
				<div class="secBook__actions">
					${actionButton}
				</div>
			</div>

			<div class="secBook__body">
				<div class="secBook__metaWrap">
					<div class="secBook__metas">
						<p class="secBook__meta"><strong>Author:</strong> ${book.author}</p>
						<p class="secBook__meta"><strong>Category:</strong> ${book.category}</p>
						<p class="secBook__meta"><strong>Available:</strong> ${book.available_copies}</p>
					</div>
				</div>

				<div class="secBook__descriptionWrap">
					<p class="secBook__description">
						${book.description || "No description available."}
					</p>
				</div>
			</div>
		</div>
	</div>
	`;

	$("#bookDetails").html(html);
}

/* ================= BORROW ================= */

function borrowBook(id) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/student/borrow-book.php",
		dataType: "json",
		data: { id: id },
		success: function (response) {
			showAlert(
				response.status === "success" ? "success" : "error",
				"Borrow Book",
				response.message,
			);

			if (response.status === "success") {
				setTimeout(function () {
					loadBookDetails();
				}, 1200);
			}
		},
		error: function () {
			showAlert("error", "Server Error", "Please try again.");
		},
	});
}
/* ================= RESERVE ================= */
function reserveBook(id) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/student/reserve-book.php",
		dataType: "json",
		data: { id: id },
		success: function (response) {
			showAlert(
				response.status === "success" ? "success" : "error",
				"Reserve Book",
				response.message,
			);

			if (response.status === "success") {
				setTimeout(function () {
					loadBookDetails();
				}, 1200);
			}
		},
		error: function () {
			showAlert("error", "Server Error", "Please try again.");
		},
	});
}
