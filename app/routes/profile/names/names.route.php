<?php
$logged = new loginSession();
$isLogged = $logged->is_logged_in();
if($isLogged != true) {
    header("Location: /");
}

echo '

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/profile/">Profile</a></li>
    <li class="breadcrumb-item"><a href="/profile/names/">Names</a></li>
    </ol>
    </nav>

';

if(isset($_GET['action2'])) {

    switch($_GET['action2']) {
        case "add":  include("add.names.php"); break;
        case "edit":   include("edit.names.php"); break;
        case "del": include("del.names.php"); break;
        case "view": include("view.names.php"); break;
        default: include("list.names.php"); break;
    }
}
else {
    include("list.names.php");
}
?>