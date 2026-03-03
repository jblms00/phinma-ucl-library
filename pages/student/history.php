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

  </main>
  <!-- Footer -->
  <?php include("../../components/student/footer.php"); ?>

  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/student/books.js"></script>
</body>

</html>