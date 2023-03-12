<?php

if(!isset($_SESSION['logged_in'])) { 

    header("Location: /");

}

?>
<?php

    if(isset($_POST['pubkey'])) { 
        
        if ($_POST['hexkey'] == NULL ) {
            echo '<meta http-equiv="refresh" content="1; url=/profile/names/add/">';
            die("Error, your npub key is not valid.");
        }
        ## ©aptcha catch 
       #if ($_SESSION['code'] != strtolower($_POST['captcha'])){ die("Captcha error!); }
            
            $display = $_POST['display'];
            $hexkey = $_POST['hexkey'];
            $pubkey = $_POST['pubkey'];



            $addnip = new namesNip();
            $id = $addnip->addUserNip($pubkey,$hexkey,$display);
            
            
            if (is_numeric($id)) {
                # nuevo nip añadido con exito.
                echo '<meta http-equiv="refresh" content="1; url=/profile/names/">';
                die("Contratulations! Your new name added is: 
                <code>$display@nmynostr.fun</code> to your 
                <i>$pubkey</i>
                pubkey.");

            }
            else {
                # hubo errores
                #echo var_dump($addnip);
                echo '<meta http-equiv="refresh" content="1; url=/profile/names/add/">';

                die("Something wrong happened. Maybe your pubkey is not valid.");
            }

        
    }
    else {
        #echo var_dump($_POST);
    }

    


?>
 <h1>Add name</h1>

<div class="row">
         <div class="col-md-6">


            <form class="p-4 border rounded-3" method="post" action="/profile/names/add/">
                  <div class="form-floating mb-3">
                    <input id="pubkey" type="text" class="form-control" name="pubkey" placeholder="pubkey" required>
                    <label id="pubkeyLabel" for="pubkey">pubkey</label>
                    <input style="display:none;" id="hexkey" class="form-control"  type="text" name="hexkey"  placeholder="hexkey" required>
                    <label style="display:none;" id="hexkeyLabel" for="hexkey">hexkey</label>

                  </div>
                  <div class="form-check mb-4">
                      <label>
                             <input type="checkbox" id="switch" name="switch">
                              <span id="switch-text">Use Hex Key Instead</span>
                    </label>
                  </div>

    
    <script>
      // Get the elements
      const pubkeyInput = document.getElementById('pubkey');
      const pubkeyLabel = document.getElementById('pubkeyLabel');
      const hexkeyLabel = document.getElementById('hexkeyLabel');
      const hexkeyInput = document.getElementById('hexkey');
      const switchCheckbox = document.getElementById('switch');
      const switchText = document.getElementById('switch-text');

      // Set up the event listener for the checkbox
      switchCheckbox.addEventListener('change', function() {
        if (this.checked) {
          // Switch to hexkey
          pubkeyInput.style.display = 'none';
          pubkeyLabel.style.display = 'none';
          hexkeyInput.style.display = '';
          hexkeyLabel.style.display = '';
          switchText.innerText = 'Uncheck tu use pubkey';
        } else {
          // Switch to pubkey
          pubkeyInput.style.display = '';
          pubkeyLabel.style.display = '';
          hexkeyInput.style.display = 'none';
          hexkeyLabel.style.display = 'none';
          switchText.innerText = 'Use Hexkey Instead';
        }
      });
    </script>



                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="display" placeholder="display name"
                      pattern="([a-zA-Z0-9]+)"
                      required>
                    <label for="disname">display name</label>
                  </div>
               
                  
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Register it!</button>
                  <hr class="my-4">
                  <small class="text-muted"><a hreF="/terms-of-use/">Terms of use</a></small>
                  ·
                  <!--<small class="text-muted"><a hreF="/keygen/">Generate a keypair</a></small>-->

                </form>



            </div>




            <div class="col-md-6">
                    <h2>Info</h2>
                    <hr>
                    <p>Please note that our website automatically converts npub keys to hex keys (and vice versa) for your convenience. This means that you can enter either type of key into the appropriate input field, and the website will automatically convert it to the other format. You do not need to manually convert your keys before entering them on our website. If you have any questions or concerns, please don't hesitate to contact us.</p>

            </div>


</div>