$(document).ready(function () {
	loadBooks();
	addBook();

	$("input[name='cover_image']").on("change", function () {
		const file = this.files[0];

		if (file) {
			const reader = new FileReader();

			reader.onload = function (e) {
				if ($("#addCoverPreview").length === 0) {
					$("input[name='cover_image']").before(`
						<div class="text-center mb-3">
							<img id="addCoverPreview" style="width:120px;border-radius:6px;">
						</div>
					`);
				}

				$("#addCoverPreview").attr("src", e.target.result);
			};

			reader.readAsDataURL(file);
		}
	});
});

let booksTable = null;

function loadBooks() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/librarian/get-books.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				renderBooks(response.data);
			}
		},
	});
}

function renderBooks(books) {
	booksData = books;

	const tableElement = document.getElementById("booksTable");
	const tableBody = $("#booksTable tbody");

	if (booksTable) {
		booksTable.destroy();
		booksTable = null;
	}

	tableBody.empty();

	$.each(books, function (index, book) {
		let status = "Available";
		let badge = "bg-success";

		if (book.available_copies == 0) {
			status = "Out";
			badge = "bg-danger";
		} else if (book.available_copies <= 2) {
			status = "Low";
			badge = "bg-warning text-dark";
		}

		tableBody.append(`
			<tr>
				<td>${book.title}</td>
				<td>${book.author}</td>
				<td>${book.category}</td>
				<td>${book.total_copies}</td>
				<td>${book.available_copies}</td>
				<td>
					<span class="badge ${badge}">
						${status}
					</span>
				</td>
				<td class="text-center">
					<div class="dropdown">
						<button class="btn btn-lg" data-bs-toggle="dropdown">
							<i class="bi bi-three-dots"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<button class="dropdown-item"
									onclick="openEditModal(${index})">
									<i class="bi bi-pencil me-2"></i>
									Edit Book
								</button>
							</li>
							<li>
								<button class="dropdown-item text-danger"
									onclick="openDeleteModal(${index})">
									<i class="bi bi-trash me-2"></i>
									Delete Book
								</button>
							</li>
						</ul>
					</div>
				</td>
			</tr>
		`);
	});

	booksTable = new DataTable(tableElement, {
		pageLength: 5,
		lengthChange: true,
		order: [[1, "asc"]],
	});
}

function openEditModal(index) {
	const book = booksData[index];

	$("#reusableModal .modal-title").text("Edit Book");
	let coverPreview = book.cover_image;

	$("#reusableModal .modal-body").html(`
		<form id="editBookForm" enctype="multipart/form-data">
			<input type="hidden" name="id" value="${book.id}">
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">Title</span>
					<input class="form-control" name="title" value="${book.title}">
				</div>
			</div>
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">Author</span>
					<input class="form-control" name="author" value="${book.author}">
				</div>
			</div>
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">Category</span>
					<input class="form-control" name="category" value="${book.category}">
				</div>
			</div>
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">Total Copies</span>
					<input type="number" class="form-control" name="total_copies" value="${book.total_copies}">
				</div>
			</div>
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">Description</span>
					<textarea class="form-control" name="description">${book.description ?? ""}</textarea>
				</div>
			</div>
			<div class="mb-3">
				<label class="form-label">Book Cover</label>
				<div class="text-center mb-3">
					<img id="coverPreview" src="${coverPreview}" style="width:120px;border-radius:6px;">
				</div>
				<div class="input-group">
					<span class="input-group-text">
						<i class="bi bi-image"></i>
					</span>
					<input type="file" class="form-control" name="cover_image" id="coverInput" accept="image/*">
				</div>
			</div>
			<div class="d-flex justify-content-end mt-4">
				<button class="btn" style="background:var(--primary-900);color:white">
					Update Book
				</button>
			</div>
		</form>
	`);

	const modal = new bootstrap.Modal(document.getElementById("reusableModal"));
	modal.show();

	$("#coverInput").on("change", function () {
		const file = this.files[0];

		if (file) {
			const reader = new FileReader();

			reader.onload = function (e) {
				$("#coverPreview").attr("src", e.target.result);
			};

			reader.readAsDataURL(file);
		}
	});
}

function openDeleteModal(index) {
	const book = booksData[index];

	$("#reusableModal .modal-title").text("Delete Book");

	$("#reusableModal .modal-body").html(`
		<p>
			Are you sure you want to delete
			<strong>${book.title}</strong>?
		</p>
		<div class="d-flex justify-content-end gap-2 mt-4">
			<button class="btn btn-secondary" data-bs-dismiss="modal">
				Cancel
			</button>
			<button class="btn btn-danger" onclick="deleteBook(${book.id})">
				Delete
			</button>
		</div>

	`);

	const modal = new bootstrap.Modal(document.getElementById("reusableModal"));
	modal.show();
}

function addBook() {
	$(document).on("submit", "#bookForm", function (e) {
		e.preventDefault();

		let formData = new FormData(this);

		$.ajax({
			type: "POST",
			url: "../phpscripts/librarian/add-book.php",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				showAlert(
					response.status === "success" ? "success" : "error",
					"Add Book",
					response.message,
				);

				if (response.status === "success") {
					$("#bookModal").modal("hide");
					$("#bookForm")[0].reset();

					loadBooks();
				}
			},
		});
	});
}

function deleteBook(id) {
	$.ajax({
		type: "POST",
		url: "../phpscripts/librarian/delete-book.php",
		dataType: "json",
		data: { id: id },
		success: function (response) {
			showAlert(
				response.status === "success" ? "success" : "error",
				"Delete Book",
				response.message,
			);

			if (response.status === "success") {
				const modalElement = document.getElementById("reusableModal");
				const modal = bootstrap.Modal.getInstance(modalElement);
				modal.hide();

				loadBooks();
			}
		},
	});
}
