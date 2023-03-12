<?php

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['code'] != strtolower($_POST['captcha'])){
      echo '<meta http-equiv="refresh" content="1; url=/signup/">';
       die("Error captcha");
    }
  // Get the form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate the form data
  if (empty($username) || empty($password) || empty($confirm_password)) {
    echo '<meta http-equiv="refresh" content="1; url=/signup/">';
    die('Please fill out all fields');
  }

  if ($password !== $confirm_password) {
    echo '<meta http-equiv="refresh" content="1; url=/signup/">';
    die('Passwords do not match');
  }

  // Create a new LoginSession instance
  $login_session = new LoginSession();

  // Register the user
  $result = $login_session->register($username, $password);

  if ($result === true) {
    echo '<meta http-equiv="refresh" content="1; url=/login/">';
    echo 'User registered successfully. Please proceed to <a href="/login/">login</a> with your user & pwd.';
  } else {
    echo $result;
  }

}

?>