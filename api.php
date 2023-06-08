<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Calculadora</title>
</head>
<body>
    <div id="container">
        <div class="container_div">
            <form action="api.php" method="get">
                <h1>Calculadora</h1>
                <input type="number" name="numero1" id="numero1" placeholder="Numero 1" required>
                <input type="number" name="numero2" id="numero2" placeholder="Numero 2" required>
                <select name="op" id="op" required>
                    <option value="0" selected disabled>Seleccione una opcion</option>
                    <option value="+">Suma</option>
                    <option value="-">Resta</option>
                    <option value="*">Multiplicacion</option>
                    <option value="/">Division</option>
                </select>
                <input type="submit" value="Enviar">
            </form>
        </div>
        <div class="container_div">
            <h1>Resultado</h1>
            <div id="container_response">
                <?php
                    if(!empty($_GET)){
                        if ($_GET['op'] == "/" && $_GET['numero2'] == 0) {
                            echo "<h2>Division por 0 no es posible</h2>";
                            return;
                        }
                        echo "<h2>";
                        eval("echo " .  $_GET['numero1'] . $_GET['op'] . $_GET['numero2'] . ";");
                        echo "</h2>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>