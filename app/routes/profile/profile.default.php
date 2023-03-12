<?php

    if(!isset($_SESSION['logged_in'])) { 

        header("Location: /");

    }

?>
  <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <h1>Welcome to your profile page!</h1>
        <p class="lead">This is your personal space where you can manage your account information, view your activity history, and customize your profile settings.</p>
        <p>Keep your information up-to-date to ensure the best experience on our platform. If you have any questions or concerns, our support team is here to help.</p>
        <p>Thank you for being a part of our community and enjoy your time on our platform!</p>
        <hr>
        <p>
          <a href="/profile/edit/">Edit your profile</a>
          ·
          <a href="/profile/names/">List my names</a>
          ·
          <a href="/logout/">Logout</a>
      </div>
      <br>
      <div class="col-lg-8 col-md-10 mt-4">
                
          <h3>How to?</h3>
          <p>To manage, go to <a href="/profile/names/">names</a> and start adding your npub and a name.</p>

      </div>
    </div>