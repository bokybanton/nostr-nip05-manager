<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("signup.handler.php");
} 
else {
    if (!isset($_SESSION['logged_in'])) {
        include_once("signup.form.php");
    }
    else {
        Header("Location: /");
    }}
?>