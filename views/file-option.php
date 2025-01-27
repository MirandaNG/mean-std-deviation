<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Subir Archivo - Media y Desviación Estándar</title>
</head>
<body>
    <div id="page-content-wrapper" class="container">
        <h1>Sube el archivo</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="file">Selecciona un archivo (.txt):</label><br>
            <input type="file" id="file" name="file" accept=".txt" required><br><br>
            <input type="submit" value="Calcular" class="btn btn-success mb-3">
        </form>

        <?php
        // Si el formulario es enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
            // Leer el archivo
            $fileData = file($_FILES['file']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $numbers = array_map('floatval', $fileData);

            // Si hay datos, hacer los cálculos
            if (!empty($numbers)) {
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
            }
        }

        // Función para añadir un número a la lista enlazada
        function addToList($head, $value) {
            $newNode = new Node($value);
            if ($head === null) {
                return $newNode; // Si la lista está vacía, el nuevo nodo es la cabeza
            }

            $current = $head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $newNode;
            return $head;
        }

        // Función para calcular la media
        function calculateMean($head) {
            $sum = 0;
            $count = 0;
            $current = $head;

            while ($current !== null) {
                $sum += $current->value;
                $count++;
                $current = $current->next;
            }

            return $count === 0 ? 0 : $sum / $count;
        }

        // Función para calcular la desviación estándar de una muestra
        function calculateStandardDeviation($head, $mean) {
            $sum = 0;
            $count = 0;
            $current = $head;

            while ($current !== null) {
                $sum += pow($current->value - $mean, 2); // (x_i - x̄)^2
                $count++;
                $current = $current->next;
            }

            return $count <= 1 ? 0 : sqrt($sum / ($count - 1)); // Desviación estándar = sqrt( Σ(x_i - x̄)^2 / (n-1) )
        }

        // Clase para el nodo de la lista enlazada
        class Node {
            public $value;
            public $next;

            public function __construct($value) {
                $this->value = $value;
                $this->next = null;
            }
        }
        ?>

        <a href="../index.php">
            <button class="btn btn-secondary">Regresar</button>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>