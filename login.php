<?php
  session_start();
  include "db.php";
  $username = $_POST["username"];
  $password = $_POST["password"];
  if(strlen($username)<4||strlen($password)<4){
    //error
    header('Location: /1172/IWP/Shopping/index.php?code=1');
  }
  else if(isset($_POST["register"])){
    //register the user
    $query = "INSERT INTO users(username, password) VALUES('%s', '%s')";
    $query = sprintf($query, $username, password_hash($password, PASSWORD_DEFAULT));
    if(mysqli_query($conn, $query)){
      //redirect to index
      header('Location: /1172/IWP/Shopping/index.php?code=2');
    }else{
      $error = mysqli_error($conn);
      if(strpos($error, 'Duplicate')!==false){
        //already exists
        header('Location: /1172/IWP/Shopping/index.php?code=3');
      }else
        echo $error;
    }
  }else{
    //login
    $query = "SELECT password FROM users WHERE username='%s'";
    $query = sprintf($query, $username);
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res)==1){
      $row = mysqli_fetch_assoc($res);
      if(password_verify($password, $row["password"])){
        $_SESSION["username"] = $username;
        header('Location: /1172/IWP/Shopping/index.php');
      }else{
        //invalid password
        header('Location: /1172/IWP/Shopping/index.php?code=4');
      }
    }else{
      //invalid username
      header('Location: /1172/IWP/Shopping/index.php?code=4');
    }
  }
 ?>
