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

<body data-role="admin">
  <!-- Header -->
  <?php include("../../components/admin/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secAdminDashboard">
      <div class="secAdminDashboard__inner">
        <div class="secAdminDashboard__top">
          <h1 class="secAdminDashboard__title animation-downwards">Admin Dashboard</h1>
          <p class="secAdminDashboard__sub animation-downwards">System overview and statistics</p>
        </div>
        <div class="row g-4 secAdminDashboard__cards">
          <div class="col-md-3">
            <div class="secAdminDashboard__card animation-left">
              <p>Total Students</p>
              <h2 id="totalStudents">0</h2>
            </div>
          </div>
          <div class="col-md-3">
            <div class="secAdminDashboard__card animation-left">
              <p>Total Librarians</p>
              <h2 id="totalLibrarians">0</h2>
            </div>
          </div>
          <div class="col-md-3">
            <div class="secAdminDashboard__card animation-right">
              <p>Total Books</p>
              <h2 id="totalBooks">0</h2>
            </div>
          </div>
          <div class="col-md-3">
            <div class="secAdminDashboard__card animation-right">
              <p>Active Borrowings</p>
              <h2 id="totalBorrowings">0</h2>
            </div>
          </div>
        </div>
        <div class="row g-4 mt-3">
          <div class="col-lg-6">
            <div class="secAdminDashboard__panel animation-fadeInUp">
              <h3>Borrowings per Month</h3>
              <canvas id="borrowChart"></canvas>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="secAdminDashboard__panel animation-fadeInUp">
              <h3>Reservations per Month</h3>
              <canvas id="reservationChart"></canvas>
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
  <script src="<?= BASE_URL ?>assets/js/admin/dashboard.js"></script>

</body>

</html>