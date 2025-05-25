<?php
namespace App\Controllers;

use App\Models\Image;

class ImageController {
    private $imageModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->imageModel = new Image();
    }

    public function enhancement() {
        // Agregar esta lógica al inicio del método
        if (isset($_GET['cancel'])) {
            // Limpiar las variables de sesión
            unset($_SESSION['original_image']);
            unset($_SESSION['enhanced_image']);
            unset($_SESSION['message']);
            unset($_SESSION['error']);
            header('Location: /VariadoPlataforma/public/index.php?controller=image&action=enhancement');
            exit;
        }

        echo "Método enhancement ejecutado";
        error_log('Método enhancement llamado');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //error_log('Método POST detectado');
            if (isset($_FILES['image'])) {
                error_log('Archivo de imagen detectado');
                // Validate file type
                $allowed = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowed)) {
                    $_SESSION['error'] = 'Tipo de archivo no permitido. Por favor, sube una imagen JPG, PNG o GIF.';
                    error_log('Tipo de archivo no permitido: ' . $_FILES['image']['type']);
                    return;
                }

                $result = $this->imageModel->processImage($_FILES['image'], $_POST['enhancements'] ?? []);
                if (!$result) {
                    $_SESSION['error'] = 'Error al procesar la imagen';
                    error_log('Error al procesar la imagen');
                    // Limpiar las sesiones si hay error
                    unset($_SESSION['original_image']);
                    unset($_SESSION['enhanced_image']);
                }
            }
        }
        require_once dirname(__DIR__) . '/views/image/enhancement.php';
    }
}
?>