<?php
$nombre = "Sistema de Gestión de Ventas";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'includes/head.php'; ?>
    <title><?php echo $nombre; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/style.css" rel="stylesheet">
    <style>
        .image-container {
            text-align: center; 
            margin-top: 20px; 
        }
        .custom-background {
            background-color: #061320 !important;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container-xxl position-relative custom-background d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <?php include 'includes/menu.php'; ?>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Header Start -->
            <?php include 'includes/header.php'; ?>
            <!-- Header End -->

            <div class="image-container">
                <img src="public/img/menu.jpg" style="width: 700px;">
            </div>

            <!-- Footer Start -->
            <div class="footer">
                <?php include 'includes/footer.php'; ?>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <?php include 'includes/scripts.php'; ?>
</body>

</html>
