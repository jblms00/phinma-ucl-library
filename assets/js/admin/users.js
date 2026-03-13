$(document).ready(function () {
	loadUsers();
});

let adminTable = null;
let librarianTable = null;
let studentTable = null;

function loadUsers() {
	$.ajax({
		type: "GET",
		url: "../phpscripts/admin/get-users.php",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				renderAdmins(response.data.admins);
				renderLibrarians(response.data.librarians);
				renderStudents(response.data.students);
			}
		},
	});
}

function renderAdmins(users) {
	const tableBody = $("#adminTable tbody");
	tableBody.empty();

	$.each(users, function (i, user) {
		let status = user.status == 1 ? "Active" : "Inactive";
		tableBody.append(`
      <tr>
        <td>${user.username}</td>
        <td>${user.email}</td>
        <td>${status}</td>
        <td>${formatDate(user.datetime_created)}</td>
      </tr>
    `);
	});

	if (adminTable) adminTable.destroy();
	adminTable = new DataTable("#adminTable", {
		paging: false,
		searching: false,
		info: false,
	});
}

function renderLibrarians(users) {
	const tableBody = $("#librarianTable tbody");
	tableBody.empty();

	$.each(users, function (i, user) {
		let status = user.status == 1 ? "Active" : "Inactive";
		tableBody.append(`
      <tr>
        <td>${user.username}</td>
        <td>${user.email}</td>
        <td>${status}</td>
        <td>${formatDate(user.datetime_created)}</td>
      </tr>
    `);
	});

	if (librarianTable) librarianTable.destroy();
	librarianTable = new DataTable("#librarianTable", {
		paging: false,
		searching: false,
		info: false,
	});
}

function renderStudents(users) {
	const tableBody = $("#studentTable tbody");
	tableBody.empty();

	$.each(users, function (i, user) {
		let status = user.status == 1 ? "Active" : "Inactive";
		tableBody.append(`
      <tr>
        <td>${user.username}</td>
        <td>${user.email}</td>
        <td>${status}</td>
        <td>${formatDate(user.datetime_created)}</td>
      </tr>
    `);
	});

	if (studentTable) studentTable.destroy();
	studentTable = new DataTable("#studentTable", {
		paging: false,
		searching: false,
		info: false,
	});
}
