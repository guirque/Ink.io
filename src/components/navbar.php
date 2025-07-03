<nav class="navbar navbar-expand navbar-dark bg-dark mb-3">
    <div class="container">

        <!-- Icon -->
        <img class="navbar-brand" src="./img/icon.png" style="width: 40px;"></img>

        <!-- Links -->
        <ul class="navbar-nav align-items-center">
            <li class="nav-item"><a href="" class="nav-link">Public Gallery</a></li>
            <li class="nav-item"><a href="" class="nav-link">Your Gallery</a></li>
            
            <?php

                use Firebase\JWT\JWT;
                use Firebase\JWT\Key;

                require_once getenv("WEB_APP_PATH")."/vendor/autoload.php";

                if(isset($_COOKIE['session_token']))
                {
                    $session_token = $_COOKIE['session_token'];
                    $token_content = (array) JWT::decode($session_token, new Key(getenv("SERVER_SECRET"), "HS256"));
                    
                    $profile_picture = $token_content['profile_picture'];
                    
                    echo '<div class="container nav-item nav-link">
                        <span>'.$token_content['username'].'</span>
                        <img src="/photos/user_profile/'.$profile_picture.'" rel="your profile picture" style="height: 3vh;">
                    </div>';
                }
                else echo "<li class=\"nav-item\"><a href=\"login.php\" class=\"nav-link\">Login</a></li>"
            ?>
            
        </ul>
    </div>
</nav>