<?php

function evaluarExpresion($expresion) {
    // Reemplazar 'x' por '*' para indicar multiplicación
    $expresion = str_replace('x', '*', $expresion);

    // Realizar el análisis de la cadena y evaluar la expresión
    $resultado = evaluarOperaciones($expresion);

    return $resultado;
}

function evaluarOperaciones($expresion) {
    $numeros = array_map('intval', preg_split('/[-+\/*]/', $expresion));
    $operadores = preg_split('/\d+/', $expresion, -1, PREG_SPLIT_NO_EMPTY);
    
    $resultado = $numeros[0];
    $numeros_count = count($numeros);
    
    for ($i = 1; $i < $numeros_count; $i++) {
        switch ($operadores[$i - 1]) {
            case '+':
                $resultado += $numeros[$i];
                break;
            case '-':
                $resultado -= $numeros[$i];
                break;
            case '*':
                $resultado *= $numeros[$i];
                break;
            case '/':
                $resultado /= $numeros[$i];
                break;
        }
    }

    return $resultado;
}

$expresion = "8*3+6*2";
$resultado = evaluarExpresion($expresion);

echo "Resultado: " . $resultado;


    function obtenerIndicesDeCaracter($cadena, $caracter) {
        $longitudCadena = strlen($cadena);
        $indices = null;
        for ($i = 0; $i < $longitudCadena; $i++) {
            if ($cadena[$i] === $caracter) {
                $indices .= $i;
            }
        }
        return $indices;
    }
    function separarCadenaPorIndices($cadena, $indices_excluir) {
        $resultado = array();
        $longitud_cadena = strlen($cadena);
        $indice_anterior = 0;
    
        foreach ($indices_excluir as $indice) {
            $longitud = $indice - $indice_anterior;
            $resultado[] = substr($cadena, $indice_anterior, $longitud);
            $indice_anterior = $indice + 1;
        }
    
        if ($indice_anterior < $longitud_cadena) {
            $resultado[] = substr($cadena, $indice_anterior);
        }
    
        return $resultado;
    }
    function calculo(){
        
    }
    function calculadora($operaciones, $numeros, $stringOriginal){
        for($i = 0; $i < count($operaciones); $i++){
            if ($stringOriginal[$operaciones[$i]] == "√") {
                $numeros[$i] = sqrt((int) $numeros[$i]);
                unset($operaciones[$i]);
                $numeros = array_values($numeros);
                $operaciones = array_values($operaciones);
                $i--;
            }
            else if($stringOriginal[$operaciones[$i]] == "x²"){
                $numeros[$i] = pow((int) $numeros[$i], 2);
                unset($operaciones[$i]);
                $numeros = array_values($numeros);
                $operaciones = array_values($operaciones);
                $i--;
            }
            else if ($stringOriginal[$operaciones[$i]] == "n") {
                $numeros[$i] = (int) $numeros[$i] * -1;
                unset($operaciones[$i]);
                $numeros = array_values($numeros);
                $operaciones = array_values($operaciones);
                $i--;
            }
            else if($stringOriginal[$operaciones[$i]] == "*"){
                $numeros[$i] = (int) $numeros[$i] * (int) $numeros[$i+1];
                unset($numeros[$i+1]);
                unset($operaciones[$i]);
                $numeros = array_values($numeros);
                $operaciones = array_values($operaciones);
                $i--;
            }
            else if($stringOriginal[$operaciones[$i]] == "/"){
                $numeros[$i] = (int) $numeros[$i] / (int) $numeros[$i+1];
                unset($numeros[$i+1]);
                unset($operaciones[$i]);
                $numeros = array_values($numeros);
                $operaciones = array_values($operaciones);
                $i--;
            }
            else if($stringOriginal[$operaciones[$i]] == "+"){
                $numeros[$i] = (int) $numeros[$i] + (int) $numeros[$i+1];
                unset($numeros[$i+1]);
                unset($operaciones[$i]);
                $numeros = array_values($numeros);
                $operaciones = array_values($operaciones);
                $i--;
            }
            else if($stringOriginal[$operaciones[$i]] == "-"){
                $numeros[$i] = (int) $numeros[$i] - (int) $numeros[$i+1];
                unset($numeros[$i+1]);
                unset($operaciones[$i]);
                $numeros = array_values($numeros);
                $operaciones = array_values($operaciones);
                $i--;
            }
            echo 8*3+6*2 . "<br>";

        }
        var_dump($numeros) ;
    }
    $op = array(
        "mod" => "mod",
        "/" => "/",
        "*" => "*",
        "-" => "-",
        "+" => "+",
        "n" => "n",
        "√" => "√",
        "x²" => "x²",
        "%" => "%",
    );
    session_start();
    if (isset($_POST['numero'])) {
        if ($_POST['numero'] == "=" && isset($_SESSION['num'])) {
            $indOperaciones = null;
            foreach($op as $clave => $valor){
                $indOperaciones .= obtenerIndicesDeCaracter($_SESSION['num'], $clave);
            }
            $indOperaciones = str_split($indOperaciones);
            sort($indOperaciones);
            $resultSubNumeros = separarCadenaPorIndices($_SESSION['num'], $indOperaciones);
            calculadora($indOperaciones, $resultSubNumeros, $_SESSION['num']);
        }
        else if($_POST['numero'] == "<--"){
            $_SESSION['num'] = substr($_SESSION['num'],0, -1);
        }else{
            if (isset($_SESSION['num'])) {
                $_SESSION['num'] .= $_POST['numero'];
            } else {
                $_SESSION['num'] =  $_POST['numero'];
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="calculadora.css">
    <title>Document</title>
</head>

<body>
    <div id="container">
        <div id="container_calculadora">
            <div id="calculadora_top">
                <input type="button" value="Borrar">
                <h3>Basic</h3>
            </div>
            <div id="calculadora_display_top">
                <p>

                </p>
            </div>
            <div id="calculadora_display_bottom">
                <p>
                    <?php
                        $result = (isset($_SESSION['num'])) ? (string)$_SESSION['num'] : "0";
                        echo $result;
                    ?>
                </p>
            </div>
            <form action="calculadora.php" method="post">
                <div id="calculadora_bottons">
                    <div id="column1" class="column">
                        <input type="submit" id="arrow" name="numero" value="<--" class="button form-control">
                        <input type="submit" value="7" name="numero" class="button form-control">
                        <input type="submit" value="4" name="numero" class="button form-control">
                        <input type="submit" value="1" name="numero" class="button form-control">
                        <input type="submit" value="0" name="numero" class="button form-control">
                    </div>
                    <div id="column2" class="column">
                        <input type="submit" value="(" name="numero" class="button form-control">
                        <input type="submit" value="8" name="numero" class="button form-control">
                        <input type="submit" value="5" name="numero" class="button form-control">
                        <input type="submit" value="2" name="numero" class="button form-control">
                        <input type="submit" value="," name="numero" class="button form-control">
                    </div>
                    <div id="column3" class="column">
                        <input type="submit" value=")" name="numero" class="button form-control">
                        <input type="submit" value="9" name="numero" class="button form-control">
                        <input type="submit" value="6" name="numero" class="button form-control">
                        <input type="submit" value="3" name="numero" class="button form-control">
                        <input type="submit" value="%" name="numero" class="button form-control">
                    </div>
                    <div id="column4" class="column">
                        <input type="submit" value="mod" name="numero" class="button form-control">
                        <input type="submit" value="/" name="numero" class="button form-control">
                        <input type="submit" value="*" name="numero" class="button form-control">
                        <input type="submit" value="-" name="numero" class="button form-control">
                        <input type="submit" value="+" name="numero" class="button form-control">
                    </div>
                    <div id="column5" class="column">
                        <input type="submit" value="n" name="numero" class="button form-control">
                        <input type="submit" value="√" name="numero" class="button form-control">
                        <input type="submit" value="x²" name="numero" class="button form-control">
                        <input id="button_equal" type="submit" value="=" name="numero" class="button form-control">
                    </div>
                </div>
            </form>
        </div>
</body>

</html>