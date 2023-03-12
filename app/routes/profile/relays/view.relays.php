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
  
    }


?>