<?php
require_once 'models/HdvModel.php';

class HdvController {
    private $model;

    public function __construct($db) {
        $this->model = new HdvModel($db);
    }

    // Hiển thị danh sách lịch làm việc
    public function index() {
        // Giả sử user_id đã được lưu trong session khi đăng nhập
        $userId = $_SESSION['user_id'] ?? null; 
        
        if (!$userId) {
            header("Location: login.php");
            exit();
        }

        $hdvInfo = $this->model->getHdvIdByUserId($userId);
        
        if (!$hdvInfo) {
            echo "Tài khoản này chưa được liên kết hồ sơ Hướng dẫn viên.";
            return;
        }

        $myTours = $this->model->getAssignedTours($hdvInfo['id']);
        
        // Include View
        require 'views/hdv/my_schedule.php';
    }

    // Xem chi tiết lịch trình cụ thể của 1 tour
    public function detail($tourId) {
        $tourInfo = $this->model->getTourDetail($tourId);
        $itinerary = $this->model->getTourItinerary($tourId);

        // Include View
        require 'views/hdv/tour_detail.php';
    }
}
?>