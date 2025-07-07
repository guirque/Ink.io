<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

    <?php include_once getenv("SRC_PATH")."/components/navbar.php" ?>

    <div class="container d-flex gap-4 pb-5 justify-content-center" style="flex-direction: column; min-height: 100vh;">
        <div class="container">

            <div class="card bg-light-subtle">
                <div class="card-header">
                    <h1>Create Account</h1>
                </div>

                <div class="card-body">
                    <div class="row">

                        <form action="./api/create_user.php" method="post" enctype="multipart/form-data" class="vstack g-2">
                            
                            <label for="username" class="form-label">Username: </label>
                            <input type="text" name="username" id="username" class="form-control">
                    
                            <label for="password" class="form-label">Password: </label>
                            <input type="password" name="password" id="password" class="form-control">
                            
                            <label for="email" class="form-label">Email: </label>
                            <input type="email" name="email" id="email" class="form-control">
                    
                            <label for="profile_picture" class="form-label">Profile Picture: </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                            
                            <br/>
                            <input type="submit" value="Submit" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
        <?php include_once getenv("SRC_PATH")."/components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>