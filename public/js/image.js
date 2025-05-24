document.addEventListener('DOMContentLoaded', function() {
    const downloadBtn = document.getElementById('downloadBtn');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function() {
            const enhancedImage = document.querySelector('.image-preview[alt="Imagen Mejorada"]');
            if (enhancedImage) {
                const link = document.createElement('a');
                link.href = enhancedImage.src;
                link.download = 'imagen_mejorada.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    }
});