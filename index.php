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
</head>

<body>
  <main>
    <section class="secLanding">
      <div class="secLanding__inner">
        <div class="secLanding__title">
          <svg class="secLanding__title-svg" viewBox="0 0 1000 260" aria-label="Phinma UCL Library" role="img">
            <path id="secLanding-arc" d="M 80 220 C 250 40, 750 40, 920 220" fill="none"></path>
            <text class="secLanding__title-text animation-fadeIn">
              <textPath href="#secLanding-arc" startOffset="50%" text-anchor="middle">
                Phinma UCL Library
              </textPath>
            </text>
          </svg>
        </div>
        <div class="secLanding__actions">
          <a class="secLanding__btn secLanding__btn--big animation-downwards" href="availableBooks">Available Books</a>
          <div class="secLanding__row">
            <a class="secLanding__btn secLanding__btn--small animation-left" href="login?role=student">Students</a>
            <a class="secLanding__btn secLanding__btn--small animation-right" href="login?role=librarian">Librarian</a>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php include("components/scripts.php"); ?>
</body>

</html>