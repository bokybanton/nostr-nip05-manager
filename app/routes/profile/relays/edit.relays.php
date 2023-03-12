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
            $relay_id = $_GET['action3'];
                    // Check if the form was submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get the input values
                $relay_name = $_POST['relay_name'];
                $relay_url = $_POST['relay_url'];
                $relay_id = $_GET['action3'];
                $id_name = $_SESSION['id_name'];
                $id_user = new LoginSession();
                $id_user = $id_user->get_user_id();
                
                // Connect to the database and create a namesNip instance
                $nn = new Relay();
                    // Call the editName function and redirect to the main page
                $result = $nn->update($relay_id, $relay_name, $relay_url);
                if($result) {
                    header('Location: /profile/names/view/'.$id_name.'/');

                }
                else {
                    echo '<meta http-equiv="refresh" content="1; url=/profile/names/view/'.$id_name.'/">';
                    die("There is an error-");
                }
            }
            else {
                $relaycon = new Relay();
                $data = $relaycon->getRelay($relay_id);
                $relay_name = $data['relay_name'];
                $relay_url = $data['relay_url'];
            echo '
            
            
            <form action="/profile/relays/edit/'.$relay_id.'/" method="POST">
            <div class="mb-3">
              <label for="relay_name" class="form-label">Relay Name</label>
              <input type="text" value="'.$relay_name.'" class="form-control" id="relay_name" name="relay_name" required>
            </div>
            <div class="mb-3">
              <label for="relay_url" class="form-label">Relay URL</label>
              <input type="text" value="'.$relay_url.'" class="form-control" id="relay_url" name="relay_url" pattern="^wss:\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}$" required>
              <div class="invalid-feedback">
                Please provide a valid URL in the format wss://relay.com
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="clearInputs()">Clear</button>
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
                    Are you sure you want to delete this relay?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="/profile/relays/del/'.$relay_id.'/" class="btn btn-danger">Delete</a>
                  </div>
                </div>
              </div>
            </div>
          
            <script>
              function clearInputs() {
                document.getElementById("relay_name").value = "";
                document.getElementById("relay_url").value = "";
              }
            </script>
          </form>
            
            
            ';

    }
 }
?>