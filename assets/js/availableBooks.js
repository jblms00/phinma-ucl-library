$(document).ready(function () {
	initBooks();
});

function initBooks() {
	if ($("#bookContainer").length) {
		initViewToggle();
		initSearch();
		loadBooks();
	}
}
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

		// Show empty message if none visible
		if (visibleCount === 0) {
			$("#bookEmpty").show();
		} else {
			$("#bookEmpty").hide();
		}
	});
}

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

function renderBooks(books) {
	var container = $("#bookContainer");
	container.empty();

	$.each(books, function (index, book) {
		var html = `
			<div class="bookItem" data-title="${book.title}">
				<div class="bookItem__cover">
					<img src="${book.cover_image}" alt="">
				</div>
				<div class="bookItem__info">
					<h3 class="bookItem__title">${book.title}</h3>
					<p class="bookItem__author">${book.author}</p>
					<p class="bookItem__category">${book.category}</p>
				</div>
			</div>
		`;

		container.append(html);
	});
}
