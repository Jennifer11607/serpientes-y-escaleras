<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganador</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #000; /* Fallback color */
            background-image: url("./video.mp4");
            background-size: cover;
            background-position: center;
        }

        .container {
            text-align: center;
            border: 2px solid #fff;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.7); /* Color de fondo con transparencia */
        }

        h1 {
            color: #008000;
        }

        p {
            color: #0000ff;
            margin: 10px 0;
        }

        button {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d40000;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $ganador = isset($_GET['ganador']) ? $_GET['ganador'] : '';
        $tiradas_jugador1 = isset($_GET['tiradas_jugador1']) ? $_GET['tiradas_jugador1'] : 0;
        $tiradas_jugador2 = isset($_GET['tiradas_jugador2']) ? $_GET['tiradas_jugador2'] : 0;
        ?>
        <h1>¡<?php echo $ganador; ?> ha ganado!</h1>
        <p><?php echo $tiradas_jugador1; ?> tiradas para Jugador 1</p>
        <p><?php echo $tiradas_jugador2; ?> tiradas para Jugador 2</p>
        <form action="index.php" method="post">
            <button type="submit">Jugar de nuevo</button>
        </form>
    </div>
</body>

</html>
