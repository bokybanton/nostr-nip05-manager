<?php
// LogginSession()
/*

  logiun
  register
  validatePassword
  generate_password
  editPassword
  deleteProfile
  logout
  is_logged_in
  get_user_id
  get_username

*/
class LoginSession {
  private $db_host;
  private $db_username;
  private $db_password;
  private $db_name;
  private $conn;
  private $user_table;

  public function __construct() {
    $this->db_host = DB_HOST;
    $this->db_username = DB_USERNAME;
    $this->db_password = DB_PASSWORD;
    $this->db_name = DB_TABLENAME;
    $this->user_table = DB_USERS;
}

  public function start() {
    session_start();
  }

// A method named "login" that accepts two parameters, username and password
  public function login($username, $password) {
     // Connect to the MySQL database using the credentials stored in this object
    $this->conn = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);
    // Prepare a SELECT statement that retrieves all columns from the user_table where the username equals the parameter $username
    $stmt = $this->conn->prepare("SELECT * FROM $this->user_table WHERE username = ?");
    // Bind the parameter $username to the first placeholder (?) in the SELECT statement
    $stmt->bind_param("s", $username);
    // Execute the SELECT statement
    $stmt->execute();
    // Get the result of the executed statement
    $result = $stmt->get_result();
    // Get the first row of the result set as an associative array
    $user = $result->fetch_assoc();
    // If no user is found, the provided password is incorrect, or the user's status is not active, return false
    if (!$user || !password_verify($password, $user['password']) || $user['status'] != 'active') {
      return false;
    }
    // Set session variables for the user's ID and username
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['logged_in'] = true;
    // Return true to indicate that the login was successful
    return true;
  }

  public function register($username, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s');
    $status = "active";

    $this->conn = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);

    // Check if username already exists in the database
    $stmt = $this->conn->prepare("SELECT id FROM $this->user_table WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;
    $stmt->close();

    if ($num_rows > 0) {
        // Username already exists, return false
        return "Error. User exist in database!";
    } else {
        // Username does not exist, insert new user
        $stmt = $this->conn->prepare("INSERT INTO $this->user_table (username, password, created_at, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashed_password, $created_at, $status);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
public function validatePassword ($password) {
    
  //check if the password is greater than 8 characters
  if (strlen($password) < 8) {
      return false;
  }
  
  //check if the password contains at least one uppercase letter
  if (!preg_match("#[A-Z]+#", $password)) {
      return false;
  }
  
  //check if the password contains at least one lowercase letter
  if (!preg_match("#[a-z]+#", $password)) {
      return false;
  }
  
  //check if the password contains at least one number
  if (!preg_match("#[0-9]+#", $password)) {
      return false;
  }

  //check if the password contains at least one special character
  //if (!preg_match("#[^\w]+#", $password)) {
  //    return false;
  //}

  //if all checks have passed, the password is valid
  return true;
}
public function generate_password($length = 8) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

public function editPassword($newPassword) {
  //validate the new password 
  $error = $this->validatePassword($newPassword); 
  //if there were errors, return the error 
  if ($error) {
      return $error; 
  }

  //otherwise, update the password in the database
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); 
  $query = "UPDATE $this->db_username SET password = '$hashedPassword' WHERE id = {$_SESSION['user_id']}"; 
  $result = mysqli_query($this->conn, $query); 
  if ($result) {
      return true; 
  } else {
      return false; 
  }
}

public function deleteProfile($id_user) {
    $this->conn = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);

    $delete = $this->conn->query("DELETE FROM $this->user_table WHERE id = '$id_user'");
    
    return $delete;
}
public function setPwd($id_user,$password) {
  $this->conn = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);
  $setQuery = $this->conn->query("UPDATE $this->user_table SET password = '$password'  WHERE id = '$id_user'");
  if ( !mysqli_errno($this->conn) ) { return true; }
  else { return false; }
}
  public function logout() {
    session_unset();
    session_destroy();
  }

  public function is_logged_in() {
    return isset($_SESSION['user_id']);
  }

  public function get_user_id() {
    return $_SESSION['user_id'];
  }

  public function get_username() {
    return $_SESSION['username'];
  }
}

?>