<?php
    if(isset($_SESSION['logged_in'])) {
        Header("Location: /profile/ ");
        exit();
    }
?>
        <div class="jumbotron text-center">
            <h1 class="display-4">Welcome to $mysite!</h1>
            <p class="lead">
                Our website will offer a range of exciting features that are sure to enhance your 
                online experience. For now, you can manage multiple NIP-05 addresses for your pubkey,
                 which is a unique identifier used to represent individuals in the Nostr ecosystem.</p>
                 <p class="lead">
                Go to the <a hreF="/signup/">sign up form</a> and register for free without email and start
                using the manager!
                </p>
       </div>