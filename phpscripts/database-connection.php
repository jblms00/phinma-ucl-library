<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "library_db";

// $dbhost = "localhost";
// $dbuser = "think2025_user";
// $dbpass = "&BUiocsWJBGLjt)2";
// $dbname = "think2025_thinktech_library";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
  die("failed to connect!");
}