<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

    <!-- Navbar -->
    <?php include_once "components/navbar.php" ?>

    <!-- Gallery -->
    <div class="container d-flex gap-4 pb-5" style="flex-direction: column; min-height: 100vh;">
        <div class="row row-cols-3">
            <div class="col">
                <!-- User Drawing -->
                <div class="card">
                    <!-- User info -->
                    <div class="card-header hstack gap-2 align-items-center">
                        <img src="./img/icon.png" alt="User photo" style="width:40px;">
                        <h3> User </h3>
                    </div>

                    <!-- Drawing itself -->
                    <img class="card-img-top" src="./img/drawing-placeholder.png" alt="a drawing"></img>

                    <!-- Drawing info -->
                    <div class="card-body">
                        <div class="card-text">
                            Thought it would be a fun idea to post this drawing I made a brief while ago.
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>

    <!-- Navbar -->
    <?php include_once "components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>