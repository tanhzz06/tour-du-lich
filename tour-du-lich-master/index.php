<?php 
// Require các file môi trường và hàm hỗ trợ
require_once './commons/env.php'; 
require_once './commons/function.php'; 

// Require Base Controller
require_once './controllers/Controller.php';

// Require Controllers
require_once './controllers/ProductController.php';
require_once './controllers/AdminController.php';
require_once './controllers/DiemDanhController.php';

// Require Models
require_once './models/ProductModel.php';
require_once './models/DiemDanhModel.php'; 

// Tạo kết nối database để truyền vào Controller
$db = connectDB();

// Lấy action từ URL
$act = $_GET['act'] ?? '/';

// Điều hướng
match ($act) {

    // Trang chủ
    '/' => (new ProductController($db))->Home(),

    // Tour
    'tour_management' => (new ProductController($db))->TourManagement(),
    'tour_add'        => (new ProductController($db))->CreateTour(),
    'tour_delete'     => (new ProductController($db))->DeleteTour(),

    // --- ĐIỂM DANH ---
    'diemdanh'       => (new DiemDanhController($db))->diemdanh(),
    'diemdanh_luu'   => (new DiemDanhController($db))->diemdanh_luu(),
    'danhsach_dd'    => (new DiemDanhController($db))->danhsach(),
    // -----------------

    // Mặc định
    default => (new ProductController($db))->Home(),
};
