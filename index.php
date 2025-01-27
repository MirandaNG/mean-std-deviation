<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Calculadora de Media y Desviación Estándar</title>
</head>
<body>
    <div id="page-content-wrapper" class="container">
        <h1>Calculadora de Media y Desviación Estándar</h1>

        <!-- Formulario para elegir la opción -->
        <div class="row">
            <div class="col-sm-3 mb-3">
                <div class="card shadow border-0 card-body card-file" onclick="window.location.href='views/file-option.php';">
                    Subir Archivo
                </div>
            </div>

            <div class="col-sm-3 mb-3">
                <div class="card shadow border-0 card-body card-manual" onclick="window.location.href='views/manual-option.php';">
                    Ingreso Manual
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>