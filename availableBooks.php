<?php
session_start();
require_once __DIR__ . "/includes/config.php";
include __DIR__ . "/phpscripts/database-connection.php";
include __DIR__ . "/phpscripts/check-login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phinma UCL Library</title>
  <?php include("components/head.php"); ?>
  <style>
    .secBooks::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(110, 150, 210, 0.65), rgba(210, 225, 245, 0.65));
      z-index: 0;
    }
  </style>
</head>

<body>
  <main>
    <section class="secBooks">
      <div class="secBooks__inner">
        <div class="secBooks__top position-relative">
          <div class="secBooks__search">
            <input type="text" id="bookSearch" placeholder="Search books..." />
          </div>
          <div class="secBooks__viewToggle">
            <button class="secBooks__back" onclick="window.history.back();">
              ← Back
            </button>
            <button class="secBooks__toggle is-active" data-view="grid">Grid</button>
            <button class="secBooks__toggle" data-view="list">List</button>
          </div>
        </div>
        <div class="secBooks__container is-grid position-relative w-100" id="bookContainer"></div>
      </div>
    </section>
  </main>
  <?php include("components/scripts.php"); ?>
  <script src="<?= BASE_URL ?>assets/js/availableBooks.js"></script>
</body>

</html>