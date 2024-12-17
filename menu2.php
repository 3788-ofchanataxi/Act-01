<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'];

    switch ($option) {
        case '1': // Opción Fibonacy
            $n = intval($_POST['fibonacci_n']);
            if ($n < 1 || $n > 50) {
                $error = "El número debe estar en el rango de 1 a 50.";
            } else {
                // Calcular y mostrar los N primeros números de Fibonacci
                $f1 = 1;
                $f2 = 1;
                $fibonacci = [$f1, $f2];

                for ($i = 3; $i <= $n; $i++) {
                    $fibonacci[] = $fibonacci[$i - 3] + $fibonacci[$i - 2];
                }

                $result = "Los primeros $n números de Fibonacci son: " . implode(", ", $fibonacci);
            }
            break;

        case '2': // Opción Cubo
            define("MAX", 1000000);
            $resultados = [];

            for ($i = 1; $i <= MAX; $i++) {
                $suma = 0;
                $numero = $i;
                while ($numero > 0) {
                    $digito = $numero % 10;
                    $suma += pow($digito, 3);
                    $numero = intval($numero / 10);
                }

                if ($suma === $i) {
                    $resultados[] = $i;
                }
            }

            $result = "Los números entre 1 y " . MAX . " que cumplen la condición son: " . implode(", ", $resultados);
            break;

        case '3': // Opción Fraccionarios
            // Leer fraccionarios
            $num_a = intval($_POST['num_a']);
            $den_a = intval($_POST['den_a']);
            $num_b = intval($_POST['num_b']);
            $den_b = intval($_POST['den_b']);
            $num_c = intval($_POST['num_c']);
            $den_c = intval($_POST['den_c']);
            $num_d = intval($_POST['num_d']);
            $den_d = intval($_POST['den_d']);

            if ($den_a <= 0 || $den_b <= 0 || $den_c <= 0 || $den_d <= 0) {
                $error = "Los denominadores deben ser mayores que 0.";
            } else {
                // Calcular la expresión A + B * C - D
                $a = $num_a / $den_a;
                $b = $num_b / $den_b;
                $c = $num_c / $den_c;
                $d = $num_d / $den_d;

                $resultado = $a + ($b * $c) - $d;
                $result = "El resultado de la operación A + B * C - D es: $resultado";
            }
            break;

        case 'S': // Salir
            $result = "Gracias por usar el programa.";
            header("Location: index.html");
            break;

        default:
            $error = "Opción inválida.";
    }
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
        h1 {
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
        }
        .error {
            color: #ff4444;
        }
    </style>
</head>
<body>
</br></br></br>
			<div style="padding-left:510px;">
				<img src="Imagenes/selloespe.jpg" alt="ESPE" height="100" >
			</div>
    <div class="container">
        <h1>MENÚ</h1>
        <hr>
        <p>1. Fibonacci</p>
        <p>2. Cubo</p>
        <p>3. Fraccionarios</p>
        <p>S. Salir</p>
        <hr>
        <form method="post">
            <label for="option">Escoja una opción:</label>
            <select id="option" name="option" required onchange="updateInputs()">
                <option value="">Seleccione...</option>
                <option value="1" <?= isset($option) && $option == '1' ? 'selected' : '' ?>>1 - Fibonacci</option>
                <option value="2" <?= isset($option) && $option == '2' ? 'selected' : '' ?>>2 - Cubo</option>
                <option value="3" <?= isset($option) && $option == '3' ? 'selected' : '' ?>>3 - Fraccionarios</option>
                <option value="S" <?= isset($option) && $option == 'S' ? 'selected' : '' ?>>S - Salir</option>
            </select>

            <div id="inputs">
                <?php if (isset($option) && $option == '1'): ?>
                    <label for="fibonacci_n">Ingrese un número entero (1 ≤ N ≤ 50):</label>
                    <input type="number" id="fibonacci_n" name="fibonacci_n" min="1" max="50" value="<?= isset($n) ? $n : '' ?>" required>
                <?php elseif (isset($option) && $option == '3'): ?>
                    <label>Ingrese 4 fraccionarios:</label><br>
                    A: <input type="number" name="num_a" required> / <input type="number" name="den_a" required><br>
                    B: <input type="number" name="num_b" required> / <input type="number" name="den_b" required><br>
                    C: <input type="number" name="num_c" required> / <input type="number" name="den_c" required><br>
                    D: <input type="number" name="num_d" required> / <input type="number" name="den_d" required><br>
                <?php endif; ?>
            </div>

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

    <script>
        function updateInputs() {
            const option = document.getElementById('option').value;
            const inputs = document.getElementById('inputs');
            inputs.innerHTML = '';

            if (option === "1") {
                inputs.innerHTML = `
                    <label for="fibonacci_n">Ingrese un número entero (1 ≤ N ≤ 50):</label>
                    <input type="number" id="fibonacci_n" name="fibonacci_n" min="1" max="50" required>
                `;
            } else if (option === "3") {
                inputs.innerHTML = `
                    <label>Ingrese 4 fraccionarios:</label><br>
                    A: <input type="number" name="num_a" required> / <input type="number" name="den_a" required><br>
                    B: <input type="number" name="num_b" required> / <input type="number" name="den_b" required><br>
                    C: <input type="number" name="num_c" required> / <input type="number" name="den_c" required><br>
                    D: <input type="number" name="num_d" required> / <input type="number" name="den_d" required><br>
                `;
            }
        }
    </script>
</body>
</html>

