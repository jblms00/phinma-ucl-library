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
    <section class="secBooks">
      <div class="secBooks__inner">
        <div class="secBooks__breascrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Books</li>
            </ol>
          </nav>
        </div>
        <div class="secBooks__top">
          <div class="secBooks__search">
            <input type="text" id="bookSearch" placeholder="Search books..." />
          </div>
          <div class="secBooks__viewToggle">
            <button class="secBooks__toggle is-active" data-view="grid">Grid</button>
            <button class="secBooks__toggle" data-view="list">List</button>
          </div>
        </div>
        <div class="secBooks__container is-grid" id="bookContainer"></div>
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/student/footer.php"); ?>

  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/student/books.js"></script>
</body>

</html>