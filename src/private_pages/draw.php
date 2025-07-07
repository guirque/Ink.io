<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Draw</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body class="bg-body-secondary">

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/navbar.php" ?>

    <!-- Gallery -->
    <div class="container-fluid d-flex" style="flex-direction: column; height: 100vh;">
        <div class="row" style="height: 100vh;">

            <div class="col-8 d-flex align-items-center justify-content-center">
                <canvas id="canva" width="600" height="600" class="border border-secondary">

                </canvas>
            </div>
            <div class="col-4 text-bg-dark p-4 border border-secondary rounded-start-3">

                <form action="">
                    <label for="draw-title" class="form-label">Drawing Title: </label>
                    <input type="text" name="draw-title" id="draw-title" class="form-control">
                    <br>
                    <label for="draw-description" class="form-label">Drawing Description: </label>
                    <input type="text" name="draw-description" id="draw-description" class="form-control">
                    <br>

                    <input type="submit" class="btn btn-success" value="Save" id="save-button"></button>
                </form>
            </div>

        </div>
    </div>

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="js/draw.js"></script>
</body>
</html>