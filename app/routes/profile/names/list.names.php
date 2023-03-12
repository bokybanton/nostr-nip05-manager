<?php

    if(!isset($_SESSION['logged_in'])) { 

        header("Location: /");

    }

?>
<h1>Names list</h1>
<hr>
<div>
    <a href="/profile/names/add/">Add name</a>
</div>
<hr>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Pubkey</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
    <?php

              $names = new namesNip();
              $getNames = $names->dameNames();
              $cero = 0;
              while ($cero < count($getNames)) {
                $pubkey = $getNames[$cero]['pubkey'];
                $display = $getNames[$cero]['display'];
                $created_at = $getNames[$cero]['created_at'];
                $id = $getNames[$cero]['id'];

                echo "
            <tr>
                <td>$display</td>
                    <td>$pubkey</td>
                    <td style=\"display: inline;\">
                      <div class=\"btn-group\" role=\"group\" aria-label=\"User Actions\">
                      
                      
                      
                      <a href=\"/profile/names/view/$id/\" class=\"btn btn-primary\">
                          <i class=\"bi bi-eye\"></i>
                        </a>
                        <a href=\"/profile/names/edit/$id/\" class=\"btn btn-secondary\">
                          <i class=\"bi bi-pencil\"></i>
                        </a>
                        
                        <a type=\"button\" class=\"btn btn-danger\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteModal$id\">
                             <i class=\"bi bi-trash\"></i>
                        </a>
                        <!-- Modal -->
                       

                        <div class=\"modal bg-light\"  id=\"deleteModal$id\" tabindex=\"-1$id\" aria-labelledby=\"deleteModalLabel$id\" aria-hidden=\"true\">



                        <div class=\"modal-dialog\">

                          <div class=\"modal-content\">
                                  <div class=\"modal-header\">
                                          <h5 class=\"modal-title\" id=\"deleteModalLabel$id\">
                                                Delete name?
                                          </h5>
                                          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                </div>

                                <div class=\"modal-body\">
                                  Are you sure you want to delete this name? 
                                  This action will remove it and there is not come back.
                                </div>

                                <div class=\"modal-footer\">
                                  <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Cancel</button>
                                  <a href=\"/profile/names/del/$id/\" class=\"btn btn-danger\">Delete</a>
                                </div>
                                
   
                          </div>
                        </div>
                      






                      </div>
                    </td>
                  </tr>
                ";
                $cero++;
              }

?>

    </tbody>
  </table>
</div>
<hr>
<div class="mt-4">
  <h3>Info</h3>
  <p>If you're new to the NIP-05 standard, you might be wondering how it works. Essentially, NIP-05 is a implementation of the NOSTR protocol that allows you to associate names with public keys on a server. This makes it easy to manage a list of trusted names and public keys that you can use to authenticate yourself or others. The NIP-05 protocol uses key pairs, which consist of a private key and a corresponding public key. The private key is kept secret and used to sign messages, while the public key is shared with others and used to verify signatures.</p>
</div>
<div>


