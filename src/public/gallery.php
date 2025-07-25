<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ink.io - Gallery</title>
    <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/general.css">
</head>
<body>

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/navbar.php" ?>

    <!-- Gallery -->
    <div id="gallery" class="container d-flex gap-4 pb-5" style="flex-direction: column; min-height: 100vh;">
                
    </div>

    <!-- Draw Button -->
    <?php include_once getenv("SRC_PATH")."/components/draw-btn.php" ?>

    <!-- Navbar -->
    <?php include_once getenv("SRC_PATH")."/components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="/js/gallery.js"></script>
    <script>
        renderDrawings();
    </script>
</body>
</html>