<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'];
    $number = isset($_POST['number']) ? intval($_POST['number']) : null;

    // Validar el número ingresado
    if ($number !== null && ($number < 0 || $number > 10)) {
        $error = "El número debe estar en el rango de 0 a 10.";
    } else {
        switch ($option) {
            case '1': // Factorial
                if ($number !== null) {
                    $factorial = 1;
                    for ($i = 1; $i <= $number; $i++) {
                        $factorial *= $i;
                    }
                    $result = "El factorial de $number es: $factorial";
                } else {
                    $error = "Debe ingresar un número para calcular el factorial.";
                }
                break;

            case '2': // Primo
                if ($number !== null) {
                    if ($number < 2) {
                        $isPrime = false;
                    } else {
                        $isPrime = true;
                        for ($i = 2; $i <= sqrt($number); $i++) {
                            if ($number % $i === 0) {
                                $isPrime = false;
                                break;
                            }
                        }
                    }
                    $result = $isPrime ? "$number es un número primo." : "$number no es un número primo.";
                } else {
                    $error = "Debe ingresar un número para verificar si es primo.";
                }
                break;

            case '3': // Serie Matemática
                if ($number !== null) {
                    $serie = 0;
                    $sign = 1;
                    $serieTerms = [];
                    for ($i = 1; $i <= $number; $i++) {
                        $term = $sign * (pow($i, 2) / factorial($i));
                        $serie += $term;
                        $serieTerms[] = $sign > 0 ? "+ " . (pow($i, 2) . "/" . factorial($i)) : "- " . (pow($i, 2) . "/" . factorial($i));
                        $sign *= -1;
                    }
                    $result = "La serie matemática es: " . implode(" ", $serieTerms) . "<br>El resultado es: $serie";
                } else {
                    $error = "Debe ingresar un número para calcular la serie matemática.";
                }
                break;

            case 'S': // Salir
                $result = "Gracias por usar el programa. ¡Hasta luego!";
                header("Location: index.html");
                break;

            default:
                $error = "Opción inválida.";
        }
    }
}

// Función para calcular factorial
function factorial($n)
{
    $factorial = 1;
    for ($i = 1; $i <= $n; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('Imagenes/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1, h2 {
            text-align: center;
            color: #ffd700;
        }
        hr {
            border: 1px solid #ffd700;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
        }
        select, input, button {
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        select, input {
            background: #333;
            color: #fff;
        }
        button {
            background: #ffd700;
            color: #333;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #ffcc00;
        }
        .result {
            background: #222;
            padding: 15px;
            border-radius: 5px;
            color: #fff;
        }
        .error {
            color: #ff4444;
        }
        .menu-option {
            margin: 10px 0;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>MENÚ DE OPCIONES</h1>
        <hr>
        <div class="menu-option">1. Factorial</div>
        <div class="menu-option">2. Primo</div>
        <div class="menu-option">3. Serie Matemática</div>
        <div class="menu-option">S. Salir</div>
        <hr>
        <form method="post">
            <label for="option">Escoja una opción:</label>
            <select id="option" name="option" required>
                <option value="">Seleccione...</option>
                <option value="1" <?= isset($option) && $option == '1' ? 'selected' : '' ?>>1 - Factorial</option>
                <option value="2" <?= isset($option) && $option == '2' ? 'selected' : '' ?>>2 - Primo</option>
                <option value="3" <?= isset($option) && $option == '3' ? 'selected' : '' ?>>3 - Serie Matemática</option>
                <option value="S" <?= isset($option) && $option == 'S' ? 'selected' : '' ?>>S - Salir</option>
            </select>

            <label for="number">Ingrese un número (0 ≤ num ≤ 10):</label>
            <input type="number" id="number" name="number" min="0" max="10" value="<?= isset($number) ? $number : '' ?>">

            <button type="submit">Enviar</button>
        </form>
        <hr>
        <?php if (isset($result)): ?>
            <div class="result">
                <h2>Resultado:</h2>
                <p><?= $result ?></p>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="result error">
                <h2>Error:</h2>
                <p><?= $error ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

