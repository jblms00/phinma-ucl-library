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
  <title>Reservations - Phinma UCL Library</title>
  <?php include("../../components/head.php"); ?>
</head>

<body data-role="librarian">
  <!-- Header -->
  <?php include("../../components/librarian/header.php"); ?>
  <!-- Main -->
  <main class="stMain">
    <section class="secReservations">
      <div class="secReservations__inner">
        <div class="secReservations__top">
          <div>
            <p class="secReservations__kicker animation-pulse">Library Management</p>
            <h1 class="secReservations__title animation-pulse">Book Reservations</h1>
            <p class="secReservations__sub animation-upwards">
              Manage student book reservations and approve requests.
            </p>
          </div>
        </div>
        <div class="secReservations__panel">
          <div class="secReservations__panelHead">
            <h2 class="secReservations__panelTitle animation-pulse">All Reservations</h2>
          </div>
          <div class="table-responsive animation-fadeInUp">
            <table id="reservationsTable" class="table table-striped align-middle secReservations__table">
              <thead>
                <tr>
                  <th>Student</th>
                  <th>Book</th>
                  <th>Reserved At</th>
                  <th>Status</th>
                  <th width="160">Action</th>
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
  <script src="<?= BASE_URL ?>assets/js/librarian/reservations.js"></script>

</body>

</html>