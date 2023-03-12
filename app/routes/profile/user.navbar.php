<?php

    if(!isset($_SESSION['logged_in'])) { 

        header("Location: /");

    }

?>

<div class="collapse navbar-collapse" id="navbarNav" data-toggle="collapse">
    <ul class="navbar-nav ms-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/profile/" id="navbarDropdown" role="button" 
          data-bs-toggle="dropdown" aria-expanded="false">
            My Profile
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/profile/edit/">Edit profile</a></li>
            <!--<li><a class="dropdown-item" href="#">Another action</a></li>-->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout/">Logout</a></li>
          </ul>
        </li>

          <li class="nav-item">
               <a class="nav-link disablewd" href="/profile/names/">My names</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout/">Logout</a>
          </li>
    </ul>
  </div>