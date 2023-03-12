<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("login.handler.php");
} 
else {
    if (!isset($_SESSION['logged_in'])) {
        include_once("login.form.php");
    }
    else {
        Header("Location: /");
    }
    
}
?>