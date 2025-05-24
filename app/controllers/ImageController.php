<?php
class ImageController {
    private $imageModel;

    public function __construct() {
        $this->imageModel = new Image();
    }

    public function enhancement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['image'])) {
                $result = $this->imageModel->processImage($_FILES['image'], $_POST['enhancements'] ?? []);
                if ($result) {
                    $_SESSION['message'] = 'Imagen procesada con éxito';
                } else {
                    $_SESSION['error'] = 'Error al procesar la imagen';
                }
            }
        }
        require_once 'app/views/image/enhancement.php';
    }
}
?>