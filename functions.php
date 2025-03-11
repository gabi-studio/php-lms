<?php

  session_start();

  function secure(){
    if(!isset($_SESSION['id'])){
      header('Location: login.php');
    }
  }

  function set_message($message, $className){
    $_SESSION['message'] = $message;
    $_SESSION['className'] = $className;
  }

  function get_message(){
    if(isset($_SESSION['message'])){
      echo 
        '<div class="alert alert-' . $_SESSION['className'] . '" role="alert">' . 
          $_SESSION['message'] 
        .'</div>';
        unset($_SESSION['message']);
        unset($_SESSION['className']);
    }
  }

  // function to upload an image
  // 0777 is file access permission
  function uploadImage($file) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // by default, the file is stored in a temporary location
    // we need to move it to the target location
    // then we will return the target location
    // that path will be stored in the database
    $targetFile = $targetDir . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $targetFile);
    return $targetFile;
  }

?>