<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Media y Desviación Estándar</title>
</head>
<body>
    <h1>Calculadora de Media y Desviación Estándar</h1>

    <form method="POST" enctype="multipart/form-data">
        <!-- Opción 1: Subir Archivo -->
        <label for="file">Sube un archivo de texto (.txt):</label><br>
        <input type="file" id="file" name="file"><br><br>
        <!-- Opción 2: Ingreso Manual -->
        <label for="numbers">O introduce los números separados por coma:</label><br>
        <input type="text" id="numbers" name="numbers" placeholder="Ej: 5.5, 3.14, 9.3" required><br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php
    // Si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numbers = [];

        // Opción 1: Leer datos desde el campo de texto
        if (!empty($_POST['numbers'])) {
            $inputData = $_POST['numbers'];
            // Convertir la cadena a un array de números
            $numbers = array_map('floatval', explode(',', $inputData));
        }

        // Opción 2: Leer datos desde el archivo
        if (!empty($_FILES['file']['tmp_name'])) {
            $fileData = file($_FILES['file']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $numbers = array_map('floatval', $fileData);
        }

        // Si se recibieron datos
        if (!empty($numbers)) {
            // Crear lista enlazada con los números
            $head = null;
            foreach ($numbers as $number) {
                $head = addToList($head, $number);
            }

            // Calcular media y desviación estándar
            $mean = calculateMean($head);
            $stdDev = calculateStandardDeviation($head, $mean);

            // Mostrar los resultados
            echo "<h2>Resultados</h2>";
            echo "Media: " . number_format($mean, 2) . "<br>";
            echo "Desviación estándar: " . number_format($stdDev, 2) . "<br>";
        } else {
            echo "<p>Por favor ingresa números o sube un archivo.</p>";
        }
    }
    ?>
    
</body>
</html>