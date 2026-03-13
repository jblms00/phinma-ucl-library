<?php
session_start();
require_once __DIR__ . "/includes/config.php";
include __DIR__ . "/phpscripts/database-connection.php";
include __DIR__ . "/phpscripts/check-login.php";

$book_id = intval($_GET["id"] ?? 0);
$page_title = htmlspecialchars($_GET["title"] ?? "Book Details");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Phinma UCL Library</title>
  <?php include("components/head.php"); ?>
</head>

<body data-role="student">
  <!-- Main -->
  <main>
    <section class="secBook">
      <div class="secBook__breascrumb mb-5">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="availableBooks">Available Books</a></li>
            <li class="breadcrumb-item active" id="breadBookTitle" aria-current="page"></li>
          </ol>
        </nav>
      </div>
      <div class="secBook__inner" id="bookDetails">
        <!-- Loaded via AJAX -->
      </div>
    </section>
  </main>
  <!-- JS Scripts -->
  <?php include("components/scripts.php"); ?>
  <script>
    const BOOK_ID = <?= $book_id ?>;
  </script>
  <script src="<?= BASE_URL ?>assets/js/availableBooks.js"></script>
</body>

</html>