<?php 
$root = dirname(dirname(dirname(dirname(__FILE__))));
require_once $root . '/app/views/layouts/header.php';
?>
<div class="container py-5">
    <div class="login-container">
        <div class="logo-section">
            <a href="/" class="text-decoration-none">
                <h1 class="text-primary">Plataforma</h1>
            </a>
        </div>
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form method="POST" action="/?controller=auth&action=login">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
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
<?php require_once $root . '/app/views/layouts/footer.php'; ?>