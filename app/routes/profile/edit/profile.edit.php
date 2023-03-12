<?php

    if(!isset($_SESSION['logged_in'])) { 

        header("Location: /");

    }



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST['password'])) {
          if($_POST['password'] !== $_POST['password_confirm']) {
            die("Password retype doesn't match.");
          }
          
          $querycon = new LoginSession();
          $id_user = $querycon->get_user_id();
          $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
          $querySet = $querycon->setPWd($id_user,$password);
          if($querySet) {
            print("Set ok!");
            header("Location: /profile/");
          }
        }

    }
?>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/profile/">Profile</a></li>
    <li class="breadcrumb-item"><a href="/profile/edit/">Edit</a></li>
    </ol>
    </nav>



<div class="container">
  <h1>Edit Profile</h1>
  <br>
  <form action="/profile/edit/" method="post">

    <div class="mb-3">
      <label for="password" class="form-label">New Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
      <label for="password_confirm" class="form-label">Re-type Password</label>
      <input type="password" class="form-control" id="password_confirm" name="password_confirm">
    </div>
    <button type="submit" class="btn btn-primary mb-4">Save</button>
  </form>


  <!-- delete profile -->
  <a type="button" class="mt-4" data-bs-toggle="modal" data-bs-target="#deleteModal">
    Delete profile?
  </a>

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Removing profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete your profile? 
          This action will remove all your data and there is not come back.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a  type="button"  href="/profile/delete/" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>

</div>