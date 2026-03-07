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
        <div class="secStudentDashboard__top">
          <div class="secStudentDashboard__welcome">
            <p class="secStudentDashboard__kicker">Welcome back</p>
            <h1 class="secStudentDashboard__title">Student Dashboard</h1>
            <p class="secStudentDashboard__sub">
              Quick access to your books, borrowed items, reservations, and history.
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
          <div class="secStudentDashboard__card">
            <p class="secStudentDashboard__cardLabel">Borrowed</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Currently borrowed books</p>
          </div>

          <div class="secStudentDashboard__card">
            <p class="secStudentDashboard__cardLabel">Overdue</p>
            <p class="secStudentDashboard__cardValue">0</p>
            <p class="secStudentDashboard__cardHint">Return as soon as possible</p>
          </div>
        </div>
        <!-- <div class="secStudentDashboard__panels">
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
        </div> -->
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/student/footer.php"); ?>

  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/student/dashboard.js"></script>
</body>

</html>