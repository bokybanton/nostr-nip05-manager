<?php

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get the form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validate the form data
  if (empty($username) || empty($password)) {
    echo '<meta http-equiv="refresh" content="3; url=/login/">';
    die('Please enter your username and password');
  }

  // Create a new LoginSession instance
  $login_session = new LoginSession();

  // Authenticate the user
  $result = $login_session->login($username, $password);

  if ($result === true) {
    header('Location: /profile/');
    exit;
  } else {
    echo $result;
  }

}
?>

