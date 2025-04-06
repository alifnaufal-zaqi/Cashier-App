<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CDN Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CDN Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .auth{
            background-color: #071952;
            color: white;
        }

        .auth:hover{
            border-color: #071952;
            border-radius: 8px;
        }
    </style>

    <title>Sistem Informasi Kasir</title>
</head>

<body class="d-flex flex-column">
    <!-- Navbar -->
    <?php include('components/navbar.php') ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="p-2 bg-dark text-white" style="width: 180px;">
            <?php include('components/sidebar.php') ?>
        </div>

        <!-- Content -->
        <div class="flex-grow-1 p-4">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <?php include('components/footer.php') ?>


    <!-- CDN Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>