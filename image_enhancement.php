<?php
session_start();

// Directorio para guardar las imágenes temporales y procesadas
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Función para mejorar la imagen
function enhanceImage($imagePath, $enhancements) {
    $image = imagecreatefromstring(file_get_contents($imagePath));
    
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

// Función para guardar la imagen
function saveImage($image, $path) {
    $info = pathinfo($path);
    $extension = strtolower($info['extension']);
    
    switch($extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image, $path, 90);
            break;
        case 'png':
            imagepng($image, $path, 9);
            break;
        case 'gif':
            imagegif($image, $path);
            break;
    }
    
    imagedestroy($image);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tempFile = $_FILES['image']['tmp_name'];
        $originalName = $_FILES['image']['name'];
        $originalPath = $uploadDir . 'original_' . $originalName;
        $enhancedPath = $uploadDir . 'enhanced_' . $originalName;
        
        // Guardar imagen original
        move_uploaded_file($tempFile, $originalPath);
        
        // Procesar y guardar imagen mejorada
        if (isset($_POST['enhancements'])) {
            $image = enhanceImage($originalPath, $_POST['enhancements']);
            saveImage($image, $enhancedPath);
            $_SESSION['original_image'] = $originalPath;
            $_SESSION['enhanced_image'] = $enhancedPath;
            $_SESSION['original_name'] = $originalName;
        }
    }
}

// Procesar acciones de guardar o cancelar
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'save' && isset($_SESSION['enhanced_image'])) {
        // Preparar la imagen para descarga
        $file = $_SESSION['enhanced_image'];
        $fileName = 'mejorada_' . $_SESSION['original_name'];
        
        // Configurar headers para descarga
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($file));
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Transfer-Encoding: binary');
        
        // Enviar archivo
        readfile($file);
        
        // Limpiar archivos temporales
        unlink($_SESSION['enhanced_image']);
        unlink($_SESSION['original_image']);
        
        // Limpiar sesión
        unset($_SESSION['original_image']);
        unset($_SESSION['enhanced_image']);
        unset($_SESSION['original_name']);
        exit;
    } elseif ($_POST['action'] === 'cancel') {
        // Eliminar ambas imágenes
        if (isset($_SESSION['enhanced_image'])) unlink($_SESSION['enhanced_image']);
        if (isset($_SESSION['original_image'])) unlink($_SESSION['original_image']);
        
        // Limpiar sesión
        unset($_SESSION['original_image']);
        unset($_SESSION['enhanced_image']);
        unset($_SESSION['original_name']);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mejora de Imágenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .image-preview {
            max-width: 100%;
            height: auto;
            margin: 10px 0;
        }
        .preview-container {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Mejora de Imágenes</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <?php if (!isset($_SESSION['enhanced_image'])): ?>
                        <!-- Formulario de carga de imagen -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="image" class="form-label">
                                    <i class="fas fa-image me-2"></i>Selecciona una imagen
                                </label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="contrast" name="enhancements[]" value="contrast">
                                    <label class="form-check-label" for="contrast">Mejorar contraste</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brightness" name="enhancements[]" value="brightness">
                                    <label class="form-check-label" for="brightness">Ajustar brillo</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="smooth" name="enhancements[]" value="smooth">
                                    <label class="form-check-label" for="smooth">Suavizar imagen</label>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-magic me-2"></i>Mejorar Imagen
                                </button>
                            </div>
                        </form>
                        <?php else: ?>
                        <!-- Vista previa de imágenes -->
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center">Imagen Original</h5>
                                <div class="preview-container">
                                    <img src="<?php echo $_SESSION['original_image']; ?>" class="image-preview" alt="Imagen Original">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center">Imagen Mejorada</h5>
                                <div class="preview-container">
                                    <img src="<?php echo $_SESSION['enhanced_image']; ?>" class="image-preview" alt="Imagen Mejorada">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botones de acción -->
                        <div class="text-center mt-3">
                            <form action="" method="POST" class="d-inline-block">
                                <input type="hidden" name="action" value="save">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-download me-2"></i>Guardar
                                </button>
                            </form>
                            <form action="" method="POST" class="d-inline-block">
                                <input type="hidden" name="action" value="cancel">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>