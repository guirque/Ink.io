<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/general.css">
</head>
<body>

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/navbar.php" ?>

    <!-- User Profile -->
    <div class="container hstack text-bg-dark border rounded p-3 mb-2 gap-3" style="position: relative;">
        <?php
            include_once getenv("SRC_PATH")."/public/api/connection.php";
            $db_manager_obj = new DBManager();
            if(isset($_GET['user']))
            {
                $user = $db_manager_obj->get_user_by_id($_GET['user']);
                echo '<img src="/photos/user_profile/'.$user['Profile_Picture'].'" rel="'.$user['Username'].'" width="100" class="object-fit-contain rounded-circle border border-light border-2">';
                echo '<h1>'.$user['Username'].'</h1>';
            }
        ?>
        <?php
            require_once getenv("SRC_PATH")."/utils/cookie-checker.php";

            $session_token_content = checkCookie();
            if(isset($session_token_content) && isset($session_token_content['username']) && $session_token_content['username'] == $user['Username'])
            {
                echo '<a class="btn btn-primary" style="position: absolute; right: 1vw; bottom: 1vh;" href="settings.php?user='. $user['Username'] .'">User Settings</a>';
            }

        ?>
    </div>

    <!-- Gallery -->
    <div id="gallery" class="container d-flex gap-4 pb-5" style="flex-direction: column; min-height: 100vh;">
                
    </div>

    <!-- Draw Button -->
    <?php include_once getenv("SRC_PATH")."/components/draw-btn.php" ?>

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="js/gallery.js"></script>
    <script>
        renderDrawings(false);
    </script>
</body>
</html>