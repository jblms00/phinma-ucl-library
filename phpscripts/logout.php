<?php
session_start();
include("database-connection.php");

if (isset($_SESSION['username']) || isset($_SESSION['id']) || isset($_SESSION['user_type'])) {
  unset($_SESSION['email']);
  unset($_SESSION['id']);
  unset($_SESSION['user_type']);
  session_destroy();
  header("Location: ../");
  exit;
} else {
  header("Location: ../");
  exit;
}
