<?php session_start(); ?>
<html>
  <head>
    <title>Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <?php
      $isLogged = 0;
      if(isset($_SESSION["username"])){
        $isLogged = 1;
      }
      if(isset($_GET["code"])){
        echo "<script>";
        if($_GET["code"]==1){
          echo "alert('username/password too short!');";
        }else if($_GET["code"]==2){
          echo "alert('Registration successful! Login to continue');";
        }else if($_GET["code"]==3){
          echo "alert('User already exists!');";
        }else if($_GET["code"]==4){
          echo "alert('Invalid username/password!');";
        }
        echo "window.location.href='/1172/IWP/Shopping/index.php'</script>";
      }
      if($isLogged){
       include "dash.php";
      }else{
       include "login.html";
     }
     ?>
  </body>
</html>
