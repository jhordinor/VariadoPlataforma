<?php
class Image {
    private $uploadDir = 'public/uploads/';

    public function __construct() {
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function processImage($file, $enhancements) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $tempFile = $file['tmp_name'];
            $originalName = $file['name'];
            $originalPath = $this->uploadDir . 'original_' . $originalName;
            $enhancedPath = $this->uploadDir . 'enhanced_' . $originalName;

            if (move_uploaded_file($tempFile, $originalPath)) {
                $image = $this->enhanceImage($originalPath, $enhancements);
                if ($image) {
                    $this->saveImage($image, $enhancedPath);
                    $_SESSION['original_image'] = $originalPath;
                    $_SESSION['enhanced_image'] = $enhancedPath;
                    return true;
                }
            }
        }
        return false;
    }

    private function enhanceImage($imagePath, $enhancements) {
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

    private function saveImage($image, $path) {
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
}
?>