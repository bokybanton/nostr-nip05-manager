<?php 
    include_once("app/config.php");
    include_once("app/router.php");
?>
<html> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
    <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/bs-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/public/css/master.css" rel="stylesheet">
        <title>
            My NIP-05 address manager
        </title>
    </head>

    <body class="container">
        <div class="container text-center mynostr-logo">
            <!-- logo site
            <a hreF="/">
                <img src="/public/img/logo.png" width="250px" 
                class="rounded-circle p-4 m-4" alt="$mysite>
            </a>
            -->
        </div>
        <!-- main app -->
        <div class="container route_custom">
            <?php  include_once($route); ?>
        </div>
        <hr>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                <a class="navbar-brand" href="/">$mysite</a>
                <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                                if(!isset($_SESSION['logged_in'])) {
                                include_once("app/routes/home/noregistered.php");
                                }
                                else {
                                    include_once("app/routes/profile/user.navbar.php");
                                }
                ?>
            </div>
        </nav>
            <?php
                // load the scripts dynamically.
                $scriptManager = new ScriptManager();
                $scriptManager->outputScripts();
    ?>        
    </body>
</html>