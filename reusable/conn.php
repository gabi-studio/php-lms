<?php
  $connect = mysqli_connect('localhost', 'root', 'root', 'php_school', '3308');
  
  if(!$connect){
    die("Connection Failed: " . mysqli_connect_error());
  }
