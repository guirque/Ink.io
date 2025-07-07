<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/general.css">
</head>
<body>

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/navbar.php" ?>

    <?php
        # Load account details
        $session_token = checkCookie();

        if(isset($session_token) && isset($session_token['username']))
        {
            require_once getenv("SRC_PATH")."/public/api/connection.php";
            $db_manager_obj = new DBManager();
            $user = $db_manager_obj->get_user_by_id($session_token['username']);
        }

    ?>

    <!-- Content -->
    <div id="gallery" class="container-fluid d-flex gap-4 pb-5" style="flex-direction: column; min-height: 100vh;">
        <div class="row">
            <div class="col-4 text-bg-dark d-flex align-items-center p-5 vstack">
                
                <?php
                    echo '<img src="/photos/user_profile/'.$user['Profile_Picture'].'" alt="your profile picture" width="200">';
                    echo '<h2>'.$user['Username'].'</h2>';
                ?>
            </div>
            <div class="col-8 vstack gap-2 p-2">
                <h2>Account Details</h2>
                    <table class="table">
                        <tr>
                            <th>Username</th>
                            <td><?= $user['Username'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $user['Email'] ?></td>
                        </tr>

                    </table>
                <hr/>
                <h2>Update your Info</h2>
                <h3>Update your E-mail</h3>
                <form action="/api/update.php" method="post" enctype="multipart/form-data">     
                    <input type="text" name="username" class="d-none" value="<?= $user['Username']?>">
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" name="email" id="email" class="form-control">
                    <br/>
                    <input type="submit" value="Update" class="btn btn-success">
                </form>
                <hr/>
                <h2>Account Deletion</h2>
                <form action="/api/delete_user.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="username" class="d-none" value="<?= $user['Username']?>">
                    <button class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>