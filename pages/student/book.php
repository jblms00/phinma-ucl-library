<?php
session_start();
include("../../phpscripts/database-connection.php");
include("../../phpscripts/check-login.php");
include("../../includes/config.php");
$book_id = intval($_GET["id"] ?? 0);
$page_title = htmlspecialchars($_GET["title"] ?? "Book Details");
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
    <section class="secBook">
      <div class="secBook__inner" id="bookDetails">
        <!-- Loaded via AJAX -->
      </div>
    </section>
  </main>
  <!-- Footer -->
  <?php include("../../components/student/footer.php"); ?>

  <!-- JS Scripts -->
  <?php include("../../components/scripts.php"); ?>
  <script>
    const BOOK_ID = <?= $book_id ?>;
  </script>
  <script src="<?= BASE_URL ?>assets/js/student/book.js"></script>
</body>

</html>