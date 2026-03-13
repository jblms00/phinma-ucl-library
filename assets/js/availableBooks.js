$(document).ready(function () {
	initBooks();
	initBook();
});

function initBooks() {
	if ($("#bookContainer").length) {
		initViewToggle();
		initSearch();
		loadBooks();
	}
}

/* ================= VIEW TOGGLE ================= */
function initViewToggle() {
	$(".secBooks__toggle").on("click", function () {
		$(".secBooks__toggle").removeClass("is-active");
		$(this).addClass("is-active");

		var view = $(this).data("view");

		if (view === "grid") {
			$("#bookContainer").removeClass("is-list").addClass("is-grid");
		} else {
			$("#bookContainer").removeClass("is-grid").addClass("is-list");
		}
	});
}

/* ================= SEARCH ================= */
function initSearch() {
	$("#bookSearch").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		var visibleCount = 0;

		$(".bookItem").each(function () {
			var title = $(this).data("title").toLowerCase();
			var match = title.indexOf(value) > -1;

			$(this).toggle(match);

			if (match) visibleCount++;
		});

		if (visibleCount === 0) {
			$("#bookEmpty").show();
		} else {
			$("#bookEmpty").hide();
		}
	});
}

/* ================= LOAD BOOKS (AJAX READY) ================= */
function loadBooks() {
	$.ajax({
		type: "GET",
		url: "phpscripts/get-books.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				renderBooks(response.data);
			}
		},
		error: function (xhr, status, error) {
			console.log("Book Load Error:", error);
		},
	});
}

/* ================= RENDER BOOKS ================= */
function renderBooks(books) {
	var container = $("#bookContainer");
	container.empty();

	$.each(books, function (index, book) {
		var slug = book.title
			.toLowerCase()
			.replace(/[^a-z0-9\s-]/g, "")
			.replace(/\s+/g, "-");

		var html = `
			<a href="book?id=${book.id}&title=${slug}">
				<div class="bookItem animation-fadeIn" data-title="${book.title}">
					<div class="bookItem__cover">
						<img src="${book.cover_image}" alt="">
					</div>
					<div class="bookItem__info">
						<h3 class="bookItem__title">${book.title}</h3>
						<p class="bookItem__author">${book.author}</p>
						<p class="bookItem__category">${book.category}</p>
					</div>
				</div>
			</a>
		`;
		container.append(html);
	});
}

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
		url: "phpscripts/get-book.php",
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
	let html = `
	<div class="secBook__layout">
		<div class="secBook__cover">
			<img src="${book.cover_image}" alt="">
		</div>
		<div class="secBook__info">
			<div class="d-flex justify-content-between mb-3">
				<h1 class="secBook__title">${book.title}</h1>
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
