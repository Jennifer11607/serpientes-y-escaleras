<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de Juego</title>
    <style>
        body{
            background-image: url(./fondo\ selva.jpg);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        /* Estilos para el tablero */
        .tablero {
            display: flex;
            flex-wrap: wrap;
            width: 600px;
            border: 2px solid #000;
        }
        .casilla {
            width: 50px;
            height: 50px;
            border: 1px solid #000;
            box-sizing: border-box;
            text-align: center;
            line-height: 50px;
        }
        /* Estilos para las imágenes */
        .imagen {
            width: 100%;
            height: auto;
        }
        
        form {
            background-color: gray;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: white;
            text-shadow: 0 0 5px green;
            margin-bottom: 20px;
            
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
   
    <form action="juego.php" method="post">
        <label for="jugador1">Nombre del jugador 1:</label>
        <input type="text" id="jugador1" name="jugador1" required>
        <br>
        <label for="jugador2">Nombre del jugador 2:</label>
        <input type="text" id="jugador2" name="jugador2" required>
        <br>
        <button type="submit">Comenzar juego</button>
    </form>
</body>
</html>
