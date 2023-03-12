<?php

    if(isset($_GET['route'])) {
        $_SESSION['whereIam'] = $_GET['route'];
        switch($_GET['route']) {
            case "signup": $route = "app/routes/login/signup.route.php"; break;
            # routing the login
            case "login": $route = "app/routes/login/login.route.php"; break;
            case "logout": 
                session_unset();
                session_destroy();
                $route = "app/routes/home/home.php";
                header("Location: /");
                break;
            # routing profile
            case "profile": $route = "app/routes/profile/profile.route.php"; break;
            # routing terms of service, should be dynamic.
            case "terms-of-use": $route = "app/routes/home/terms-of-use.php"; break;
            default: 
            # ponemos en default el home
            $_SESSION['whereIam'] = "home";
            $route = "app/routes/home/home.php";
            break;
        }
    }
    else {
        $_SESSION['whereIam'] = "home";
        $route = "app/routes/home/home.php";
    }

?>