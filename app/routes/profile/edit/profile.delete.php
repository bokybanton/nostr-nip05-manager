<?php

    if(!isset($_SESSION['logged_in'])) { 

        header("Location: /");

    }



    $deleteQuery = new LoginSession();
    $id_user = $deleteQuery->get_user_id();
    $deleteUser = $deleteQuery->deleteProfile($id_user);
    if($deleteUser) {
        session_unset();
        session_destroy();
        print("Bye!");
        header("Location: /");
    }
?>


