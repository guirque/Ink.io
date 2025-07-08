<nav class="navbar navbar-expand navbar-dark bg-dark mb-3">
    <div class="container">

        <!-- Icon -->
        <a href="/" class="navbar-brand">
            <img src="/img/icon.png" style="width: 40px;"/>
            <span>Ink.io</span>
        </a>

        <!-- Links -->
        <ul class="navbar-nav align-items-center">
            <li class="nav-item"><a href="/" class="nav-link">Public Gallery</a></li>
            
            <?php
                require_once getenv("SRC_PATH")."/utils/cookie-checker.php";

                $session_token = checkCookie();

                if(isset($session_token) && isset($session_token['username']))
                {
                    
                    $profile_picture = $session_token['profile_picture'];
                    
                    $profile_link = "/personal-gallery.php?user=".$session_token['username'];

                    echo '<li class="nav-item"><a href="'.$profile_link.'" class="nav-link">Your Gallery</a></li> ';
                    echo '<li class="nav-item"><a href="" class="nav-link" id="logout-btn">Logout</a></li> ';
                    echo '<a href="'.$profile_link.'" class="container nav-item nav-link">
                        <span me-2>'.$session_token['username'].'</span>
                        <img src="/photos/user_profile/'.$profile_picture.'" rel="your profile picture" style="height: 3vh;" class="drawing-profile-img object-fit-contain rounded-circle border border-secondary border-1">
                    </a>';
                }
                else {
                    echo '<li class="nav-item"><a href="/account-creation.php" class="nav-link">Create Account</a></li>';
                    echo '<li class="nav-item"><a href="/login.php" class="nav-link">Login</a></li>';
                }
            ?>
            
        </ul>
    </div>
</nav>
<script src="/js/logout.js"></script>