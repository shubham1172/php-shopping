<?php
  $server="localhost";$dbuser="root";$dbpass="";$dbname="shopping";
  $conn = mysqli_connect($server, $dbuser, $dbpass) or die(mysqli_error());
  mysqli_select_db($conn, $dbname) or die("Database not found!");
  error_reporting(E_ERROR);
 ?>
