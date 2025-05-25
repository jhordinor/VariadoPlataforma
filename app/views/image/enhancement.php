<?php require_once dirname(__DIR__) . '/layouts/header.php'; ?>
<link rel="stylesheet" href="/VariadoPlataforma/public/css/image.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5">
    <h2 class="text-center mb-4">Mejora de Imágenes</h2>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <?php if (!isset($_SESSION['enhanced_image'])): ?>
                    <form action="/VariadoPlataforma/public/index.php?controller=image&action=enhancement" method="POST" enctype="multipart/form-data">
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
                    
                    <div class="text-center mt-3">
                        <button id="downloadBtn" class="btn btn-success me-2">
                            <i class="fas fa-download me-2"></i>Descargar
                        </button>
                        <a href="/VariadoPlataforma/public/index.php?controller=image&action=enhancement&cancel=true" class="btn btn-danger">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/VariadoPlataforma/public/js/image.js"></script>
<?php require_once dirname(__DIR__) . '/layouts/footer.php'; ?>