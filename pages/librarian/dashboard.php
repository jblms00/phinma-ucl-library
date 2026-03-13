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
  <title>Dashboard - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="librarian">
  <!-- Header -->
  <?php include("../../components/librarian/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secLibrarianDashboard">
      <div class="secLibrarianDashboard__inner">
        <div class="secLibrarianDashboard__top">
          <div class="secLibrarianDashboard__welcome">
            <p class="secLibrarianDashboard__kicker animation-pulse">Admin Panel</p>
            <h1 class="secLibrarianDashboard__title animation-pulse">Librarian Dashboard</h1>
            <p class="secLibrarianDashboard__sub animation-upwards">
              Manage books, borrowings and monitor fines.
            </p>
          </div>
        </div>
        <div class="secLibrarianDashboard__stats">
          <div class="secLibrarianDashboard__card animation-left">
            <p class="secLibrarianDashboard__cardLabel">Total Books</p>
            <p class="secLibrarianDashboard__cardValue" id="statBooks">0</p>
            <p class="secLibrarianDashboard__cardHint">All books in library</p>
          </div>
          <div class="secLibrarianDashboard__card animation-left">
            <p class="secLibrarianDashboard__cardLabel">Students</p>
            <p class="secLibrarianDashboard__cardValue" id="statStudents">0</p>
            <p class="secLibrarianDashboard__cardHint">Registered students</p>
          </div>
          <div class="secLibrarianDashboard__card animation-right">
            <p class="secLibrarianDashboard__cardLabel">Active Borrowings</p>
            <p class="secLibrarianDashboard__cardValue" id="statBorrowings">0</p>
            <p class="secLibrarianDashboard__cardHint">Currently borrowed books</p>
          </div>
          <div class="secLibrarianDashboard__card animation-right">
            <p class="secLibrarianDashboard__cardLabel">Overdue</p>
            <p class="secLibrarianDashboard__cardValue" id="statOverdue">0</p>
            <p class="secLibrarianDashboard__cardHint">Needs attention</p>
          </div>
        </div>
        <div class="secLibrarianDashboard__analytics">
          <div class="secLibrarianDashboard__panel animation-left">
            <div class="secLibrarianDashboard__panelHead">
              <h2 class="secLibrarianDashboard__panelTitle">Most Borrowed Books</h2>
            </div>
            <div class="secLibrarianDashboard__chart">
              <canvas id="mostBorrowedChart"></canvas>
            </div>
          </div>
          <div class="secLibrarianDashboard__panel animation-right">
            <div class="secLibrarianDashboard__panelHead">
              <h2 class="secLibrarianDashboard__panelTitle text-danger">Fines</h2>
              <span id="fineSummary"></span>
            </div>
            <div class="secLibrarianDashboard__tableWrap">
              <table class="secLibrarianDashboard__table">
                <thead>
                  <tr>
                    <th>Book Title</th>
                    <th>Borrower</th>
                    <th>Due Date</th>
                    <th>Days Late</th>
                    <th>Fine Amount</th>
                  </tr>
                </thead>
                <tbody id="finesTable"></tbody>
              </table>
            </div>
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
  <script src="<?= BASE_URL ?>assets/js/librarian/dashboard.js"></script>

</body>

</html>