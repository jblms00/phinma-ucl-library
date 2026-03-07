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
    <section class="secBorrowed">
      <div class="secBorrowed__inner">
        <div class="secBooks__breascrumb mb-5">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Borrowed Books</li>
            </ol>
          </nav>
        </div>
        <h1 class="secBorrowed__title">My Borrowed Books</h1>
        <div class="secBorrowed__tableWrap ">
          <table class="secBorrowed__table" id="borrowedTable">
            <thead>
              <tr>
                <th>Book</th>
                <th>Borrowed Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="secBorrowed__empty text-center text-danger fst-italic" id="borrowedEmpty" style="display:none;">
          You have no borrowed books.
        </div>
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/student/footer.php"); ?>

  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/student/borrowed.js"></script>
</body>

</html>