<?php

$logged = new loginSession();
$isLogged = $logged->is_logged_in();
if($isLogged != true) {
    header("Location: /");
}




if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case "delete": include("edit/profile.delete.php"); break;
        case "edit": include("edit/profile.edit.php"); break;
        case "names": include("names/names.route.php"); break;
        case "images": include("images/images.route.php"); break;
        case "relays": include("relays/relay.route.php"); break;
        default: include("profile.default.php"); break;
    }
}
else {
    include("profile.default.php");
}
?>