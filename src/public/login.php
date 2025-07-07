<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

    <?php include_once getenv("SRC_PATH")."/components/navbar.php" ?>

    <div class="container d-flex gap-4 pb-5 justify-content-center" style="flex-direction: column; min-height: 100vh;">
        <div class="container">
            <!-- Card -->
            <div class="card bg-light-subtle">
                <div class="card-header">
                    <h1>Log In</h1>
                </div>

                <div class="card-body">
                    <div class="row">

                        <form method="post" enctype="multipart/form-data" class="vstack g-2">
                            
                            <label for="username_or_email" class="form-label">Username: </label>
                            <input type="text" name="username_or_email" id="username_or_email" class="form-control">
                            
                            <label for="password" class="form-label">Password: </label>
                            <input type="password" name="password" id="password" class="form-control">
                        
                            <br/>
                            <input type="submit" value="Submit" id="submit-button" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Alert -->
             <div class="alert alert-danger collapse mt-2" role="alert" id="psw-alert">User or password incorrect. Please try again.</div>
             <div class="alert alert-success collapse mt-2" role="alert" id="pos-alert">Logged in successfully. Redirecting...</div>
             
        </div>
    </div>
        <?php include_once getenv("SRC_PATH")."/components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="/js/login.js"></script>
</body>
</html>