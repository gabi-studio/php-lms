<?php
  include('reusable/conn.php');
  include('functions.php');

  // the post method posts to the same page
  // we will convert the password to a hash
  // we will compare the hash with the hash in the database
  if(isset($_POST['login'])){
    $query = 'SELECT * 
              FROM users
              WHERE email = "' . $_POST['email'] . '"
              AND password = "' . md5($_POST['password']) . '"
              LIMIT 1';
              // we want it to stop after the first record that matches
              // there should only be one record that matches
    $result = mysqli_query($connect, $query);

    // here we are checking if the query returned any records
    // if it did, we will store the user's information in the session
    // then we will create a session variable for the user's id, name, and email
    // local storage used into the session
    // a session exists as long as the browser is open
    // if the user closes the browser, the session is destroyed
    // cookies are actual files that are stored on the user's computer
    // but cookies are domain specific
    // for setting cookies: need to specify how long the cookie will last
    // then we will redirect the user to the index page
    if(mysqli_num_rows($result)){
      $record = mysqli_fetch_assoc($result);
      $_SESSION['id'] = $record['id'];
      $_SESSION['name'] = $record['name'];
      $_SESSION['email'] = $record['email'];
      header('Location: index.php');
      die();

      // if not successful, we will display a message
      // and redirect the user to the login page
    } else{
      set_message('No records found!', 'danger');
      header('Location: login.php');
      die();
    }
  }

?>



<!-- password is hashed
 -- whenever you login, the get request will convert in the hash 
 -- and then compare that with the hash that you have in your database
 -- the hash is connected to the user -->

 <!-- no one uses this authentication system in the industry anymore
  -- but this is important as a basic foundation to understand the more modern approaches
  -- for example laravel will offer its own -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ontario Public Schools</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container fluid">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h3 class="mt-5 mb-5">Login</h3>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <?php get_message(); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 offset-md-4 mt-5">
          <form method="POST" action="login.php">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>