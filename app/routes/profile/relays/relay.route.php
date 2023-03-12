<?php
$logged = new loginSession();
$isLogged = $logged->is_logged_in();
if($isLogged != true) {
    header("Location: /");
}

$name_display = $_SESSION['name_display'];
$id_name = $_SESSION['id_name'];
echo '

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/profile/">Profile</a></li>
    <li class="breadcrumb-item"><a href="/profile/names/">Names</a></li>
    <li class="breadcrumb-item">Name: <a href="/profile/names/view/'.$id_name.'/">'.$name_display.'</a></li>
    </ol>
    </nav>

';

if(isset($_GET['action2'])) {

    switch($_GET['action2']) {
        case "add":  include("add.relays.php"); break;
        case "del": include("del.relays.php"); break;
        case "edit": include("edit.relays.php"); break;
        case "view": include("view.relays.php"); break;
    }
}
else {

}
?>