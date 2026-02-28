<?php
require_once __DIR__ . './includes/config.php';

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$con) {
  die("failed to connect: " . mysqli_connect_error());
}