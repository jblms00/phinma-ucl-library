<?php
session_start();
include("../../phpscripts/database-connection.php");
include("../../phpscripts/check-login.php");
include("../../includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Borrowings - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="librarian">
  <!-- Header -->
  <?php include("../../components/librarian/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secBorrowings">
      <div class="secBorrowings__inner">
        <div class="secBorrowings__top">
          <div>
            <p class="secBorrowings__kicker animation-pulse">Library Management</p>
            <h1 class="secBorrowings__title animation-pulse">Borrowed Books</h1>
            <p class="secBorrowings__sub animation-upwards">
              Monitor all borrowed books and track overdue items.
            </p>
          </div>
        </div>
        <div class="secBorrowings__panel">
          <div class="secBorrowings__panelHead">
            <h2 class="secBorrowings__panelTitle animation-pulse">All Borrowings</h2>
          </div>
          <div class="table-responsive animation-fadeInUp">
            <table id="borrowingsTable" class="table table-striped align-middle secBorrowings__table">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Book</th>
                  <th>Borrowed</th>
                  <th>Due Date</th>
                  <th>Returned</th>
                  <th>Status</th>
                  <th width="120">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/footer.php"); ?>
  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="<?= BASE_URL ?>assets/js/librarian/borrowings.js"></script>

</body>

</html>