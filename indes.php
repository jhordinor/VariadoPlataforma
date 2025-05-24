<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma - Inicio</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Incluir el menú -->
    <?php include 'header.php'; ?>

    <!-- Banner Section -->
    <div class="container-fluid p-0">
        <div class="position-relative">
            <!-- Banner Image -->
            <div class="w-100" style="height: 100vh; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://source.unsplash.com/random/1920x1080') center/cover no-repeat;"></div>
            
            <!-- Banner Content -->
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                <h1 class="display-3 fw-bold mb-4">Bienvenido a Nuestra Plataforma</h1>
                <p class="lead mb-4">Descubre oportunidades increíbles y conéctate con profesionales</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="login.php" class="btn btn-primary btn-lg px-4 gap-3">Iniciar Sesión</a>
                    <button type="button" class="btn btn-outline-light btn-lg px-4">Más Información</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>