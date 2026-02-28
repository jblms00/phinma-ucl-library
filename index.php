<?php
session_start();
include("phpscripts/database-connection.php");
include("phpscripts/check-login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include("components/head.php"); ?>
</head>

<body>
  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur aut dolor, qui repellat architecto in ipsa
    fuga illo ullam odit pariatur enim eius hic commodi magnam similique, nulla labore necessitatibus.</p>

  <?php include("components/scripts.php"); ?>
</body>

</html>