<?php
$controller = $_GET['controller'] ?? 'tour';
$action = $_GET['action'] ?? 'list';

require_once "controllers/TourController.php";
$c = new TourController();

switch ($action) {
    case 'list': $c->list(); break;
    case 'add': $c->add(); break;
    case 'edit': $c->edit(); break;
    case 'delete': $c->delete(); break;
    default: echo "Không tìm thấy hành động!";
}
?>
