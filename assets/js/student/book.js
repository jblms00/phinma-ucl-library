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

	if (book.available_copies > 0) {
		actionButton = `
      <button class="secBook__btn secBook__btn--borrow"
        onclick="borrowBook(${book.id})">
        Borrow
      </button>
    `;
	} else {
		actionButton = `
      <button class="secBook__btn secBook__btn--disabled" disabled>
        Out of Stock
      </button>
    `;
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
            <p class="secBook__description">${book.description || "No description available."}</p>
          </div>
        </div>
      </div>
    </div>
	`;

	$("#bookDetails").html(html);
}

function borrowBook(id) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/student/borrow-book.php",
		dataType: "json",
		data: { id: id },
		success: function (response) {
			if (response.status === "success") {
				showAlert("success", "Borrowed", response.message);
				setTimeout(function () {
					location.reload();
				}, 1200);
			} else {
				showAlert("error", "Borrow Failed", response.message);
			}
		},
		error: function () {
			showAlert("error", "Server Error", "Please try again.");
		},
	});
}
