<?php
namespace App\Models;

class Image {
    private $uploadDir;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->uploadDir = dirname(dirname(__DIR__)) . '/public/uploads/';
        if (!file_exists($this->uploadDir)) {
            error_log('Creando directorio de carga: ' . $this->uploadDir);
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function processImage($file, $enhancements) {
        error_log('Iniciando procesamiento de imagen');
        error_log('Datos del archivo: ' . print_r($file, true));
        error_log('Mejoras solicitadas: ' . print_r($enhancements, true));

        if ($file['error'] === UPLOAD_ERR_OK) {
            error_log('Archivo subido correctamente');
            $tempFile = $file['tmp_name'];
            $originalName = $file['name'];
            $originalPath = $this->uploadDir . 'original_' . $originalName;
            $enhancedPath = $this->uploadDir . 'enhanced_' . $originalName;

            error_log('Ruta original: ' . $originalPath);
            error_log('Ruta mejorada: ' . $enhancedPath);

            if (move_uploaded_file($tempFile, $originalPath)) {
                $image = $this->enhanceImage($originalPath, $enhancements);
                if ($image && $this->saveImage($image, $enhancedPath)) {
                    $_SESSION['original_image'] = '/VariadoPlataforma/public/uploads/original_' . $originalName;
                    $_SESSION['enhanced_image'] = '/VariadoPlataforma/public/uploads/enhanced_' . $originalName;
                    return true;
                }
            } else {
                $error = error_get_last();
                $errorMessage = $error ? $error['message'] : 'Error desconocido al mover el archivo';
                error_log('Error al mover el archivo: ' . $errorMessage);
            }
        } else {
            error_log('Error en la subida del archivo: ' . $file['error']);
        }
        return false;
    }

    public function enhanceImage($imagePath, $enhancements) {
        $image = imagecreatefromstring(file_get_contents($imagePath));
        if (!$image) {
            error_log('Error al crear la imagen desde: ' . $imagePath);
            return false;
        }

        foreach ($enhancements as $enhancement) {
            switch($enhancement) {
                case 'contrast':
                    imagefilter($image, IMG_FILTER_CONTRAST, -10);
                    break;
                case 'brightness':
                    imagefilter($image, IMG_FILTER_BRIGHTNESS, 10);
                    break;
                case 'smooth':
                    imagefilter($image, IMG_FILTER_SMOOTH, 5);
                    break;
            }
        }
        return $image;
    }

    public function saveImage($image, $path) {
        $info = pathinfo($path);
        $extension = strtolower($info['extension']);
        
        switch($extension) {
            case 'jpg':
            case 'jpeg':
                return imagejpeg($image, $path, 90);
            case 'png':
                return imagepng($image, $path, 9);
            case 'gif':
                return imagegif($image, $path);
            default:
                error_log('Formato de imagen no soportado: ' . $extension);
                return false;
        }
    }
}
?>
