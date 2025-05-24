<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        // Include header
        require_once dirname(__DIR__) . '/views/layouts/header.php';
        
        // Include main content
        require_once dirname(__DIR__) . '/views/home/index.php';
        
        // Include footer
        require_once dirname(__DIR__) . '/views/layouts/footer.php';
    }
}