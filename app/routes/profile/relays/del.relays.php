<?php

    if(!isset($_SESSION['logged_in'])) { 

        header("Location: /");

    }

?>
<?php
    if(!isset($_GET['action3']) && !is_numeric($_GET['action3'])) {
        header("Location: /profile/relays/ ");
    }
    else {
        # delete relay
        echo "deleting relay...";
        $relay_id = $_GET['action3'];

        $newDel = new Relay();
        $resDel = $newDel->delete($relay_id);
        if($resDel) {
            echo "Dettached and deleted correctly.";
            $id_name = $_SESSION['id_name'];
            header("Location: /profile/names/view/".$id_name."/");

        }
    }


?>