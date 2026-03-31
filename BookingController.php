    <?php
    // Kiểm tra xem class đã tồn tại chưa trước khi khai báo
    if (!class_exists('BookingController')) {

        class BookingController {
            private $db;
            private $model;
            private $tourModel;
            private $khachModel;
            private $khachThamGiaModel;

            public function __construct($db) {
                $this->db = $db;
                
                // Khởi tạo các Model cần thiết
                $this->model = new BookingModel($db);
                $this->tourModel = new TourModel($db);
                $this->khachModel = new KhachHangModel($db);
                
                // Kiểm tra model phụ nếu có
                if(class_exists('KhachThamGiaModel')) {
                    $this->khachThamGiaModel = new KhachThamGiaModel($db);
                }
            }

            // 1. Danh sách
            public function index() {
                $bookings = $this->model->getAll();
                require ROOT . "/views/admin/booking/index.php";
            }

            // 2. Chi tiết
            public function detail() {
                $id = $_GET['id'] ?? 0;
                $booking = $this->model->getOne($id);
                if (!$booking) die("Đơn hàng không tồn tại");

                $list_khach = [];
                if($this->khachThamGiaModel) {
                    $list_khach = $this->khachThamGiaModel->getByBookingId($id);
                }
                
                require ROOT . "/views/admin/booking/detail.php";
            }

            // 3. Form Tạo mới
            public function create() {
                $khachhangs = $this->khachModel->getAll(); 
                $tours = $this->tourModel->getAll(); 
                require ROOT . "/views/admin/booking/create.php";
            }

            // 4. Lưu mới (Store)
            public function store() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    
                    // 1. Lấy thông tin Tour từ DB
                    $tourId = $_POST['tour_id'] ?? 0;
                    $tourInfo = $this->tourModel->getById($tourId);
                    $giaTour = $tourInfo['gia_tour'] ?? 0;

                    // 2. Xử lý Snapshot Tên Tour (Tránh lỗi NULL)
                    $tenTourSnapshot = $_POST['snapshot_ten_tour'] ?? '';
                    if (empty($tenTourSnapshot) && !empty($tourInfo)) {
                        $tenTourSnapshot = $tourInfo['ten_tour'] ?? 'Tour không xác định';
                    }
                    if (empty($tenTourSnapshot)) $tenTourSnapshot = "Tour ID: $tourId";

                    // 3. Xử lý số lượng khách
                    $passengers = $_POST['passengers'] ?? [];
                    $soLuongKhach = count($passengers);
                    if ($soLuongKhach == 0) {
                        $soLuongKhach = (int)($_POST['so_luong_khach'] ?? 1);
                    }

                    // 4. Tính tiền
                    $tongTien = !empty($_POST['tong_tien']) ? $_POST['tong_tien'] : ($giaTour * $soLuongKhach);

                    // [FIX LỖI] Xử lý tiền đã thanh toán: Nếu rỗng -> gán bằng 0
                    $daThanhToan = 0;
                    if (!empty($_POST['da_thanh_toan'])) {
                        // Xóa dấu chấm/phẩy (ví dụ: 1.000.000 -> 1000000)
                        $daThanhToan = str_replace(['.', ','], '', $_POST['da_thanh_toan']);
                    }

                    // 5. Chuẩn bị dữ liệu
                    $bookingData = [
                        'tour_id'           => $tourId,
                        'khach_hang_id'     => $_POST['khach_hang_id'] ?? null,
                        'so_luong_nguoi_lon'=> $_POST['so_luong_nguoi_lon'] ?? 1,
                        'so_luong_tre_em'   => $_POST['so_luong_tre_em'] ?? 0,
                        'so_luong_em_be'    => $_POST['so_luong_em_be'] ?? 0,
                        'so_luong_khach'    => $soLuongKhach,
                        'tong_tien'         => $tongTien,
                        'ghi_chu'           => $_POST['ghi_chu'] ?? '',
                        'trang_thai'        => $_POST['trang_thai'] ?? 'CHO_XU_LY',
                        'loai_booking'      => $_POST['loai_booking'] ?? 'LE',
                        
                        // Sử dụng giá trị đã xử lý
                        'da_thanh_toan'     => $daThanhToan,

                        // Snapshot Khách
                        'snapshot_kh_ho_ten'        => $_POST['snapshot_kh_ho_ten'] ?? '',
                        'snapshot_kh_email'         => $_POST['snapshot_kh_email'] ?? '',
                        'snapshot_kh_so_dien_thoai' => $_POST['snapshot_kh_so_dien_thoai'] ?? '',
                        'snapshot_kh_dia_chi'       => $_POST['snapshot_kh_dia_chi'] ?? '',
                        
                        // Snapshot Tour
                        'snapshot_ten_tour'         => $tenTourSnapshot 
                    ];

                    // 6. Insert Booking
                    $bookingId = $this->model->insert($bookingData);

                    // 7. Lưu khách đi cùng (Nếu có)
                    if ($bookingId && !empty($passengers) && $this->khachThamGiaModel) {
                        foreach ($passengers as $p) {
                            if (!empty($p['ho_ten'])) {
                                $this->khachThamGiaModel->insert([
                                    'booking_id' => $bookingId,
                                    'ho_ten'     => $p['ho_ten'],
                                    'gioi_tinh'  => $p['gioi_tinh'] ?? 'KHAC',
                                    'ngay_sinh'  => $p['ngay_sinh'] ?? null,
                                    'so_giay_to' => $p['so_giay_to'] ?? '',
                                    'ghi_chu'    => $p['ghi_chu'] ?? '',
                                    'yeu_cau_dac_biet' => ''
                                ]);
                            }
                        }
                    }

                    // 8. Chuyển hướng
                    if ($bookingId) {
                        header("Location: index.php?act=booking-detail&id=" . $bookingId);
                    } else {
                        echo "<script>alert('Lỗi: Không thể tạo đơn hàng!'); window.history.back();</script>";
                    }
                    exit;
                }
            }

            // 5. Form Sửa
            public function edit() {
                $id = $_GET['id'] ?? 0;
                $booking = $this->model->getOne($id);
                if (!$booking) die("Booking không tồn tại");

                $khachhangs = $this->khachModel->getAll();
                $tours = $this->tourModel->getAll();

                require ROOT . "/views/admin/booking/edit.php";
            }

            // 6. Cập nhật
            public function update() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['id'];
                    
                    // Tính lại tiền nếu đổi tour hoặc số lượng
                    $tour = $this->tourModel->getById($_POST['tour_id']);
                    $giaTour = $tour['gia_tour'] ?? 0;
                    
                    // Ưu tiên lấy tổng tiền nhập tay, nếu không thì tự tính
                    $tongTien = !empty($_POST['tong_tien']) ? $_POST['tong_tien'] : ($giaTour * (int)$_POST['so_luong_khach']);

                    // [FIX LỖI] Xử lý tiền thanh toán khi update
                    $daThanhToan = 0;
                    if (!empty($_POST['da_thanh_toan'])) {
                        $daThanhToan = str_replace(['.', ','], '', $_POST['da_thanh_toan']);
                    }

                    // Lấy lại tên tour cũ nếu không đổi (hoặc cập nhật mới nếu cần)
                    $tenTourSnapshot = $tour['ten_tour'] ?? 'Tour đã cập nhật';

                    $data = [
                        'id'                => $id,
                        'tour_id'           => $_POST['tour_id'],
                        'khach_hang_id'     => $_POST['khach_hang_id'],
                        'so_luong_nguoi_lon'=> $_POST['so_luong_nguoi_lon'],
                        'so_luong_tre_em'   => $_POST['so_luong_tre_em'],
                        'so_luong_em_be'    => $_POST['so_luong_em_be'],
                        'so_luong_khach'    => $_POST['so_luong_nguoi_lon'] + $_POST['so_luong_tre_em'] + $_POST['so_luong_em_be'],
                        'tong_tien'         => $tongTien,
                        'trang_thai'        => $_POST['trang_thai'],
                        'loai_booking'      => $_POST['loai_booking'],
                        'ghi_chu'           => $_POST['ghi_chu'] ?? '',
                        'da_thanh_toan'     => $daThanhToan, // Sử dụng biến đã xử lý
                        
                        // Snapshot
                        'snapshot_kh_ho_ten' => $_POST['snapshot_kh_ho_ten'] ?? '',
                        'snapshot_kh_email'  => $_POST['snapshot_kh_email'] ?? '',
                        'snapshot_kh_so_dien_thoai' => $_POST['snapshot_kh_so_dien_thoai'] ?? '',
                        'snapshot_kh_dia_chi' => $_POST['snapshot_kh_dia_chi'] ?? '',
                        'snapshot_ten_tour'  => $tenTourSnapshot
                    ];

                    $this->model->update($id, $data);
                    header("Location: index.php?act=booking-detail&id=" . $id);
                    exit;
                }
            }

            // 7. Xóa
            public function delete() {
                $id = $_GET['id'];
                $this->model->delete($id);
                header("Location: index.php?act=booking-list");
                exit;
            }
            
            // 8. Cập nhật trạng thái nhanh (nếu cần)
            public function updateStatus() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['id'];
                    $status = $_POST['trang_thai'];
                    $this->model->updateStatus($id, $status);
                    header("Location: index.php?act=booking-detail&id=" . $id);
                    exit;
                }
            }

            // ... Các hàm quản lý khách (guestList, storeGuest, etc.) giữ nguyên ...
            public function guestList() {
                $id = $_GET['id'];
                $booking = $this->model->getOne($id);
                $guestList = $this->khachThamGiaModel->getByBookingId($id);
                require ROOT . "/views/admin/booking/guest_list.php";
            }

            public function storeGuest() {
                $this->khachThamGiaModel->insert($_POST);
                $this->model->syncBookingStats($_POST['booking_id']);
                header("Location: index.php?act=booking-guest-list&id=" . $_POST['booking_id']);
            }

            public function deleteGuest() {
                $id = $_GET['id'];
                $booking_id = $_GET['booking_id'];
                $this->khachThamGiaModel->delete($id);
                $this->model->syncBookingStats($booking_id);
                header("Location: index.php?act=booking-guest-list&id=" . $booking_id);
            }
            
            public function editGuest() {
                $id = $_GET['id'];
                $guest = $this->khachThamGiaModel->getOne($id);
                require ROOT . "/views/admin/booking/guest_edit.php";
            }

            public function updateGuest() {
                $this->khachThamGiaModel->update($_POST['id'], $_POST);
                header("Location: index.php?act=booking-guest-list&id=" . $_POST['booking_id']);
            }
            
            public function importGuests() {
                // Logic import CSV
            }
        }
    }
    ?>