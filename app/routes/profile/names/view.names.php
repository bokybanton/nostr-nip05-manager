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
        $name = new namesNip();
        $id_name = $_GET['action3'];
        $_SESSION['id_name'] = $id_name;
        $getName = $name->dameName($id_name);
        $pubkey = $getName['pubkey'];
        $display = $getName['display'];
        $hexkey = $getName['hexkey'];
        $serverName = $_SERVER['SERVER_NAME'];
        $_SESSION['name_display'] = $display;
        echo "<h1>Name configuration:</h1><hr>";
        echo "<div>Pubkey: $pubkey</div>";
        echo "<div>Hexkey: $hexkey</div>";
        echo "<div>Name: <code>$display@$serverName</code></div>";
        echo "<br><br><a href='/profile/names/edit/$id_name/'>Edit</a>";
        echo "<hr>";
        $id_user = new LoginSession();
        $id_user = $id_user->get_user_id();
        $relay = new Relay();
        $relays = $relay->getRelays($id_user,$id_name);

        echo "<h3>Relays attached</h3>";
        echo "
            <table class='table table-striped table-responsive'>
                <thead>
                    <tr>
                        <td>URL:</td>
                        <td>Name:</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                
                ";

        foreach ($relays as $relay) {
            $relay_name = $relay['relay_name'];
            $relay_url = $relay['relay_url'];
            $relay_id = $relay['id'];
            echo "
            <tr>
                 <td>$relay_url</td>
                <td>$relay_name</td>
          
            ";
            echo '
            <td>
                            <a href="/profile/relays/edit/'.$relay_id.'/" class="btn btn-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                            </a>

                    <button class="btn btn-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal'.$relay_id.'">
                    <i class="bi bi-trash"></i>
                    </button>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal'.$relay_id.'" tabindex="-1" aria-labelledby="deleteModalLabel'.$relay_id.'" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel'.$relay_id.'">Confirm deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this item?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="/profile/relays/del/'.$relay_id.'/" class="btn btn-danger">Delete</a>
                        </div>
                        </div>
                    </div>
                    </div>

            </td>


            </tr>
            ';
        }



echo "
                        </tbody>
                    </table>";
        echo "
            <hr>
            <a href=\"/profile/relays/add/\">Attach a new relay</a> 
            <hr>
        ";
        echo "<br/>";
        echo "<hr>";
        echo "<h5>Raw data:</h5>";
    

        $nip05 = new namesNip();
        $nip05 = $nip05->buscaDisplay($display);

        if (isset($nip05) && $nip05 != null) {
            $output['names'][$display] = $nip05['hexkey'];

            if(isset($nip05['id_user'])) {
                # asociated to a user maybe have relays
                $relays = new Relay();
                $relays = $relays->getRelays($nip05['id_user'],$nip05['id']);
     
                if(isset($relays) && count($relays) >= 1) {
                    $cero = "0";
                    $output['relays'][$nip05['hexkey']] = array();
                        while ($cero < count($relays)) {
                            $output['relays'][$nip05['hexkey']][] = $relays[$cero]['relay_url'];
                            $cero++;
                        }
                    
             
                }
            }
            
            printf(json_encode($output,JSON_UNESCAPED_SLASHES));
        }
    }


?>