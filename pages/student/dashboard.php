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
  <title>Student Dashboard - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="student">
  <!-- Header -->
  <?php include("../../components/student/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secStudentDashboard">
      <div class="secStudentDashboard__inner">
        <div class="secStudentDashboard__top animation-fadeIn">
          <div class="secStudentDashboard__welcome">
            <p class="secStudentDashboard__kicker animation-pulse">Welcome back</p>
            <h1 class="secStudentDashboard__title animation-pulse">Student Dashboard</h1>
            <p class="secStudentDashboard__sub animation-upwards">
              Quick access to your books, borrowed items and reservations.
            </p>
          </div>
          <div class="secStudentDashboard__quick">
            <a class="secStudentDashboard__btn" href="<?= BASE_URL ?>student/books">
              Browse Books
            </a>
            <a class="secStudentDashboard__btn secStudentDashboard__btn--ghost" href="<?= BASE_URL ?>student/borrowed">
              View Borrowed
            </a>
          </div>
        </div>
        <div class="secStudentDashboard__stats">
          <div class="secStudentDashboard__card animation-left">
            <p class="secStudentDashboard__cardLabel">Borrowed</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Currently borrowed books</p>
          </div>
          <div class="secStudentDashboard__card animation-downwards">
            <p class="secStudentDashboard__cardLabel">Reservations</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Pending reservations</p>
          </div>
          <div class="secStudentDashboard__card animation-right">
            <p class="secStudentDashboard__cardLabel">Overdue</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Return as soon as possible</p>
          </div>
        </div>
        <div class="secStudentDashboard__panels animation-upwards">
          <div class="secStudentDashboard__panel">
            <div class="secStudentDashboard__panelHead">
              <h2 class="secStudentDashboard__panelTitle">Recent Activity</h2>
              <a class="secStudentDashboard__panelLink" href="<?= BASE_URL ?>student/history">View All</a>
            </div>
            <div class="secStudentDashboard__panelBody">
              <div class="secStudentDashboard__row">
                <div>
                  <p class="secStudentDashboard__rowMain">No activity yet. Your borrow and reservation activity will
                    appear here.</p>
                </div>
              </div>
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
  <script src="<?= BASE_URL ?>assets/js/student/dashboard.js"></script>
</body>

</html>