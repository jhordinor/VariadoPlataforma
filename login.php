<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Plataforma</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://source.unsplash.com/random/1920x1080') center/cover no-repeat fixed;
            min-height: 100vh;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            max-width: 500px;
            margin: 2rem auto;
        }
        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="login-container">
            <div class="logo-section">
                <a href="indes.php" class="text-decoration-none">
                    <h1 class="text-primary">Plataforma</h1>
                </a>
            </div>
            <h2 class="text-center mb-4">Iniciar Sesión</h2>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar Sesión</button>
                <div class="text-center">
                    <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                    <hr>
                    <p class="mb-0">¿No tienes una cuenta? <a href="#" class="text-decoration-none">Regístrate</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>