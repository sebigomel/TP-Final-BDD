<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="light-blue lighten-5">
    <?php
    include 'connection.php';
    $conn = OpenCon();
    $productId = $_GET['id_producto'];
    $consultaSQL = "SELECT * FROM `reviews` WHERE `id_producto` = $productId";
    $nombreProducto = "SELECT nombre FROM `productos` WHERE id = $productId";
    $resultadoNombre = mysqli_query($conn, $nombreProducto);
    $result = mysqli_query($conn, $consultaSQL);
    $reviews = mysqli_fetch_array($resultadoNombre);
    CloseCon($conn);
    ?>
    <nav>
        <div class="nav-wrapper light-blue darken-3">
            <a href="index.php" class="brand-logo center">Reseñas de <?php echo $reviews["nombre"] ?></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php
        foreach ($result as $row) : ?>
            <div class="section ratings">
                <h4><?php echo $row["texto"] ?></h4>
                <?php for ($rating = $row["estrellas"]; $rating > $row["estrellas"] - 5; $rating--) {
                    if ($rating <= 0) { ?>
                        <i class="medium material-icons">star_border</i>
                    <?php } else {
                    ?>
                        <i class="medium material-icons yellow-text">star</i>
                <?php }
                } ?>
            </div>
            <div class="divider"></div>
        <?php endforeach; ?>
    </div>
</body>

</html>