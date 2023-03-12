<?php

    if(!isset($_SESSION['logged_in'])) { 

        header("Location: /");

    }

?>
<?php
    
    if(!isset($_GET['action3']) && !is_numeric($_GET['action3'])) {
        header("Location: /profile/names/ ");
    }
    else {

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values
    $hexkey = $_POST['hexkey'];
    $pubkey = $_POST['pubkey'];
    $display = $_POST['display'];
    $id_name = $_GET['action3'];
    $id_user = new LoginSession();
    $id_user = $id_user->get_user_id();
    
    // Connect to the database and create a namesNip instance
    $nn = new namesNip();
        // Call the editName function and redirect to the main page
    $result = $nn->editName($id_user, $id_name, $pubkey, $hexkey, $display);
    if($result) {
        header('Location: /profile/names/');

    }
    else {
        echo '<meta http-equiv="refresh" content="1; url=/profile/names/edit/'.$id_name.'/">';
        die("There is an error, maybe your username already exist.");
    }
  }
else {
    $name = new namesNip();
    $id_name = $_GET['action3'];
    $getName = $name->dameName($id_name);
    $display = $getName['display'];
    $pubkey = $getName['pubkey'];
    $hexkey = $getName['hexkey'];
    

    echo '
    
    
    <form action="/profile/names/edit/'.$id_name.'/" method="POST">
    <div class="mb-3">
      <label for="hexkey" class="form-label">Hexkey</label>
      <input type="text" class="form-control" id="hexkey" name="hexkey" 
      value="'.$hexkey.'"
      required>
    </div>
    <div class="mb-3">
      <label for="pubkey" class="form-label">Pubkey</label>
      <input type="text" class="form-control" id="pubkey" name="pubkey" 
      value="'.$pubkey.'"
      required>
    </div>
    <div class="mb-3">
      <label for="display" class="form-label">Display</label>
      <input type="text" class="form-control" id="display" name="display" pattern="^[A-Za-z0-9]+([-][A-Za-z0-9]+)*$" 
      value="'.$display.'"
      required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-secondary" onclick="clearInputs()">Erase</button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
    
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this name?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <a type="button" class="btn btn-danger" href="/profile/names/del/'.$id_name.'/">Delete</a>
          </div>
        </div>
      </div>
    </div>
    </form>


    <script>
    function clearInputs() {
      document.getElementById("hexkey").value = "";
      document.getElementById("pubkey").value = "";
      document.getElementById("display").value = "";
    }
  </script>


  
    
    
    
    ';
}
   


        #echo var_dump($getName);
    }

    ?>