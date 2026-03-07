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
    <section class="secReservation">
      <div class="secReservation__inner">
        <div class="secReservation__breascrumb mb-5">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Reservations</li>
            </ol>
          </nav>
        </div>
        <h1 class="secReservation__title">My Reservations</h1>
        <div class="secReservation__tableWrap">
          <table id="reservationTable" class="secReservation__table">
            <thead>
              <tr>
                <th>Book</th>
                <th>Reserved Date</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div id="reservationEmpty" class="secReservation__empty fst-italic text-danger" style="display:none;">
          No reservations found.
        </div>
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/student/footer.php"); ?>

  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/student/reservations.js"></script>
</body>

</html>