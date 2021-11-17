<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Ecommerce</title>
</head>

<body class="light-blue lighten-5">
    <?php
    include 'connection.php';
    $conn = OpenCon();
    $inputValue = $_GET['value'];
    if ($inputValue != '') {
        $consultaSQL = "SELECT * FROM productos WHERE nombre LIKE " . "'" . $inputValue . "%" . "'";
    } else {
        $consultaSQL = "SELECT * FROM productos";
    }
    $result = mysqli_query($conn, $consultaSQL);
    CloseCon($conn);
    ?>

    <nav>
        <div class="nav-wrapper light-blue darken-3">
            <form action="" method="get" name="myform">
                <div class="input-field">
                    <input id="search" type="search" name="value" required placeholder="Buscar productos" onchange="myform.submit();">
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </div>
    </nav>
    <div class="container row" style="margin-top: 10px;">
        <?php
        foreach ($result as $row) : ?>
            <div class="card col s10 m5 l3">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/<?php echo $row["url_imagen"] ?>.jpg">
                </div>
                <div class="card-content" style="display: flex;">
                    <span class="card-title activator grey-text text-darken-4"><?php echo $row["nombre"] ?><i class="material-icons right">more_vert</i></span>
                    <p><a href="reviews.php?id_producto=<?php echo $row["id"] ?>">Reseñas</a></p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4"><?php echo $row["nombre"] ?><i class="material-icons right">close</i></span>
                    <p><?php echo $row["descripcion"] ?></p>
                    <p>Precio: <?php echo $row["precio"] ?>$</p>
                    <p>Publicado el <?php echo $row["fecha_de_publicacion"] ?></p>
                </div>
            </div>
            <div class="col s1"></div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>