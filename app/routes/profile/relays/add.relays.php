<?php

if(!isset($_SESSION['logged_in'])) { 

    header("Location: /");

}

?>
<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $relay_name = $_POST['relay_name'];
  $relay_url = $_POST['relay_url'];
  $id_name = $_POST['id_name'];

  // Validate the input data
  #var_dump($relay_url);
  if (!filter_var($relay_url, FILTER_VALIDATE_URL) || !preg_match('/^wss:\/\/.*$/', $relay_url)) {
    die('Invalid relay URL');
  }
  $id_user = new LoginSession();
  $id_user = $id_user->get_user_id();
  $relay = new Relay();
  $addRelay = $relay->create($id_user,$id_name,$relay_name,$relay_url);
  
  echo '<meta http-equiv="refresh" content="3; url=/profile/names/view/'.$id_name.'/">';
   die("Congrats! You attached a relay to your name.");
  

}
    


?>
 <h1 class="mb-2">Attach relay to <?php echo $_SESSION['name_display']; ?></h1>
 <hr>

<div class="row">
         <div class="col-md-6">


            <form class="p-4 border rounded-3" method="post" action="/profile/relays/add/">
                  <div class="form-floating mb-3">
                    <input id="relay_name" type="text" class="form-control" name="relay_name" placeholder="Relay Name" required>
                    <label for="relay_name">Relay name</label>
                    <input hidden id="id_name" type="text" name="id_name" value="<?php echo $_SESSION['id_name']; ?>">
                  </div>
                  <div class="form-floating mb-3">
                    <input id="relay_url" type="url" pattern="^wss://.*"  class="form-control" name="relay_url" placeholder="wss://relay.url.com" required>
                    <label for="relay_url">wss://relay.url.com</label>
                  </div>

         

               
                  
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Attach relay</button>

                </form>



            </div>




            <div class="col-md-6">
                    <h2>Attached relays to <?php echo $_SESSION['name_display']; ?></h2>
                    <hr>
           </div>


</div>