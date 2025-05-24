<?php
class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario de login
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            // Aquí iría la lógica de autenticación
        }
        require_once '../app/views/auth/login.php';
    }
}