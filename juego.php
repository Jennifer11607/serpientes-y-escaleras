<?php
// Función para generar un número aleatorio entre 1 y 12
function tirarDado()
{
    return rand(1, 12);
}

// Función para mover al jugador en el tablero
function moverJugador(&$posicion, $avance, &$escaleras, &$serpientes)
{
    $posicion += $avance;
    // Verificar si el jugador ha caído en una escalera o serpiente
    if (isset($escaleras[$posicion])) {
        $posicion = $escaleras[$posicion];
    } elseif (isset($serpientes[$posicion])) {
        $posicion = $serpientes[$posicion];
    }
}

// Definir las posiciones de las escaleras y las serpientes
$escaleras = [5 => 20, 30 => 50, 70 => 90];
$serpientes = [15 => 3, 45 => 25, 80 => 60];

// Obtener los nombres de los jugadores
$jugador1 = isset($_POST['jugador1']) ? $_POST['jugador1'] : '';
$jugador2 = isset($_POST['jugador2']) ? $_POST['jugador2'] : '';

// Obtener las posiciones actuales de los jugadores
$posicion_jugador1 = isset($_POST['posicion_jugador1']) ? $_POST['posicion_jugador1'] : 1;
$posicion_jugador2 = isset($_POST['posicion_jugador2']) ? $_POST['posicion_jugador2'] : 1;

// Inicializar el acumulado de las fichas y el número del dado
$acumulado_jugador1 = isset($_POST['acumulado_jugador1']) ? $_POST['acumulado_jugador1'] : 0;
$acumulado_jugador2 = isset($_POST['acumulado_jugador2']) ? $_POST['acumulado_jugador2'] : 0;
$numero_dado_jugador1 = 0;
$numero_dado_jugador2 = 0;

// Tirar los dados y mover a los jugadores
if (isset($_POST['tirar_dado'])) {
    $numero_dado_jugador1 = tirarDado();
    $numero_dado_jugador2 = tirarDado();
    $acumulado_jugador1 += $numero_dado_jugador1;
    $acumulado_jugador2 += $numero_dado_jugador2;
    moverJugador($posicion_jugador1, $numero_dado_jugador1, $escaleras, $serpientes);
    moverJugador($posicion_jugador2, $numero_dado_jugador2, $escaleras, $serpientes);
}

// Verificar si un jugador ha ganado
if ($posicion_jugador1 >= 100 || $posicion_jugador2 >= 100) {
    $ganador = $posicion_jugador1 >= 100 ? $jugador1 : $jugador2;
    $tiradas_jugador1 = isset($_POST['tiradas_jugador1']) ? $_POST['tiradas_jugador1'] : 0;
    $tiradas_jugador2 = isset($_POST['tiradas_jugador2']) ? $_POST['tiradas_jugador2'] : 0;
    header("Location: ganador.php?ganador=$ganador&tiradas_jugador1=$tiradas_jugador1&tiradas_jugador2=$tiradas_jugador2");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Serpientes y Escaleras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-image: url(./fondo\ selva.jpg);
        }

        /* Estilos para el contenedor principal */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 50px;
            /* Ajusta este margen según sea necesario */
        }

        /* Estilos para el título */
        h1 {
            margin-bottom: 20px;
            /* Espacio entre el título y el tablero */
        }

        /* Estilos para el tablero */
        .tablero {
            display: grid;
            grid-template-columns: repeat(10, auto); /* Usamos "auto" para que las columnas se ajusten automáticamente */
            width: fit-content; /* Ajustamos el tamaño del tablero al contenido */
            max-width: 16cm; /* Evita que el tablero se desborde en dispositivos pequeños */
            border: 2px solid black;
            border-collapse: collapse;
        }

        .casilla {
            width: 16cm; /* Las casillas ocupan todo el ancho de la columna */
            height: 1.5cm; /* Las casillas ocupan todo el alto de la fila */
            text-align: center;
            position: relative; /* Añadido */
            border: solid black;
        }

        .ficha {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: absolute;
        }

        .ficha.negra {
            background-color: black;
        }

        .ficha.anaranjada {
            background-color: orange;
        }

        .imagen {
            width: 10%;
            height: 35%;
            position: absolute;
            top: 170px;
            left: 68%;
            transform: rotate(-30deg);
            z-index: 1;
        }

        .imagen1 {
            width: 10%;
            height: 45%;
            position: absolute;
            top: 135px;
            left: 51%;
            transform: rotate(20deg);
            z-index: 1;
        }

        .imagens {
            width: 5%;
            height: 20%;
            position: absolute;
            top: 78%;
            left: 73%;
            transform: rotate(20deg);
            z-index: 1;
        }

        .imagen2 {
            width: 10%;
            height: 30%;
            position: absolute;
            top: 55%;
            left: 55%;
            transform: rotate(20deg);
            z-index: 1;
        }

        .imagen3 {
            width: 10%;
            height: 30%;
            position: absolute;
            top: 25%;
            left: 60%;
            transform: rotate(20deg);
            z-index: 1;
        }

        .imagena {
            width: 10%;
            height: 30%;
            position: absolute;
            top: 55%;
            left: 70%;
            transform: rotate(20deg);
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-white">JUEGO DE ESCALERAS Y SERPIENTES</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post">
                    <label for="acumulado_jugador1" class="text-white">Acumulado Jugador 1:</label>
                    <input type="text" id="acumulado_jugador1" name="acumulado_jugador1" value="<?php echo htmlspecialchars($acumulado_jugador1); ?>" readonly>
                    <br><br>
                    <label for="acumulado_jugador2" class="text-white">Acumulado Jugador 2:</label>
                    <input type="text" id="acumulado_jugador2" name="acumulado_jugador2" value="<?php echo htmlspecialchars($acumulado_jugador2); ?>" readonly>
                    <br><br>
                    <input type="hidden" name="posicion_jugador1" value="<?php echo $posicion_jugador1; ?>">
                    <input type="hidden" name="posicion_jugador2" value="<?php echo $posicion_jugador2; ?>">
                    <input type="hidden" name="tiradas_jugador1" value="<?php echo isset($_POST['tiradas_jugador1']) ? $_POST['tiradas_jugador1'] + 1 : 1; ?>">
                    <input type="hidden" name="tiradas_jugador2" value="<?php echo isset($_POST['tiradas_jugador2']) ? $_POST['tiradas_jugador2'] + 1 : 1; ?>">
                    <button type="submit" name="tirar_dado" class="btn btn-primary">Tirar dado</button>
                    <button type="submit" name="reiniciar" class="btn btn-danger">Reiniciar juego</button>
                </form>
            </div>
            <div class="col-md-6">
                <table class="tablero">
                    <?php
                    function generarColoresAleatorios($cantidad)
                    {
                        $colores = ['yellow', 'white', 'blue', 'green', 'red'];
                        $resultados = array_rand($colores, $cantidad);
                        if ($cantidad == 1) {
                            return [$colores[$resultados]];
                        } else {
                            $res = [];
                            foreach ($resultados as $r) {
                                $res[] = $colores[$r];
                            }
                            return $res;
                        }
                    }

                    function generarNumeros()
                    {
                        $numeros = [];
                        $inicio = 100;
                        for ($fila = 0; $fila < 10; $fila++) {
                            $fila_numeros = [];
                            if ($fila % 2 == 0) {
                                // Fila ascendente
                                for ($j = 0; $j < 10; $j++) {
                                    $fila_numeros[] = $inicio--;
                                }
                            } else {
                                // Fila descendente
                                $inicio -= 9;
                                for ($j = 0; $j < 10; $j++) {
                                    $fila_numeros[] = $inicio++;
                                }
                                $inicio -= 11;
                            }
                            $numeros = array_merge($numeros, $fila_numeros);
                        }
                        return $numeros;
                    }

                    // Generar las posiciones iniciales de las fichas
                    $posicion_ficha_negra = 0;
                    $posicion_ficha_anaranjada = 0;

                    $numeros = generarNumeros();
                    $indice = 0;
                    for ($i = 0; $i < 10; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 10; $j++) {
                            $numero = $numeros[$indice++];
                            $colores = generarColoresAleatorios(1); // Genera un solo color aleatorio para cada casilla
                            echo "<td class='casilla' style='background-color: {$colores[0]};'>";
                            echo "<div class='numero'>$numero</div>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <img src="./escalera3.webp" alt="" class="imagen">
        <img src="./esca.png" alt="" class="imagen1">
        <img src="./es.png" alt="" class="imagens">
        <img src="./image.png" alt="" class="imagen2">
        <img src="./snakeee.png" alt="" class="imagena">
        <img src="./ser.png" alt="" class="imagen3">

        <?php
        // Calcular las coordenadas de las fichas
        $fila_jugador1 = 9 - intval($posicion_jugador1 / 10);
        $columna_jugador1 = $posicion_jugador1 % 10 == 0 ? 10 : $posicion_jugador1 % 10;
        $fila_jugador2 = 9 - intval($posicion_jugador2 / 10);
        $columna_jugador2 = $posicion_jugador2 % 10 == 0 ? 10 : $posicion_jugador2 % 10;

        // Mostrar las fichas en las nuevas posiciones
        if ($fila_jugador1 == $fila && $columna_jugador1 == $j + 1) {
            echo "<div class='ficha negra'></div>";
        }

        if ($fila_jugador2 == $fila && $columna_jugador2 == $j + 1) {
            echo "<div class='ficha anaranjada'></div>";
        }

        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
