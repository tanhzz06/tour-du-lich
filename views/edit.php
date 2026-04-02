<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Tour</title>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <style>
         body {
            background-color: #f8f9fa;
            /* Nền nhẹ nhàng */
        }

        /* Chiều rộng sidebar cố định và nền tối */
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            /* Ẩn sidebar ban đầu */
            transition: margin .25s ease-out;
            background-color: #343a40;
            /* Màu nền tối */
            color: #ffffff;
            position: fixed;
            z-index: 1030;
            /* Đặt trên nội dung */
        }

        /* Hiển thị sidebar khi menu active */
        #page-content-wrapper {
            width: 100%;
            padding-left: 0;
            transition: padding-left .25s ease-out;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #wrapper.toggled #page-content-wrapper {
            padding-left: 15rem;
        }

        /* Liên kết trong sidebar */
        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: #f8f9fa;
        }

        .list-group-item {
            background-color: transparent;
            color: #adb5bd;
            border: none;
            padding: 1rem 1.25rem;
        }

        .list-group-item:hover,
        .list-group-item.active {
            background-color: #495057;
            /* Hover */
            color: #ffffff;
        }
        .chart-container {
    height: 400px; 
    position: relative;
}

.chart-container canvas {
    height: 100% !important; 
    width: 100% !important;
}
    .shadow{
        height: 100%;
    }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                padding-left: 15rem;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }

            #wrapper.toggled #page-content-wrapper {
                padding-left: 0;
            }
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Shadow nổi bật hơn */
            background-color: #f8f9fa; /* Nền màu xám nhạt */
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #17a2b8; /* Màu xanh teal/info */
            border-bottom: 2px solid #17a2b8;
            padding-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
 <div class="d-flex" id="wrapper">

        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom border-secondary">
                <i class="fas fa-plane-departure text-info"></i> Quản Lý
            </div>
            <div class="list-group list-group-flush">
                <a href="index.php?act=admin-home" class="list-group-item list-group-item-action ">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="index.php?act=tour-list" class="list-group-item list-group-item-action ">
                    <i class="fas fa-list me-2"></i> Danh Sách Tour
                </a>
             
                <a href="index.php?act=schedule-list" class="list-group-item list-group-item-action">
                     <i class="fas fa-road me-2"></i> Quản Lý Tour
                </a>
                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action ">
                    <i class="bi bi-bootstrap me-2"></i> Quản Lý Booking
                </a>
                <a href="index.php?act=customer-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản Lý Khách Hàng
                </a>
                <a href="index.php?act=employees-list" class="list-group-item list-group-item-action">

                    <i class="fas fa-users me-2"></i> Quản Lý Nhân Sự
                </a>
                <a href="index.php?act=report-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-chart-line me-2"></i> Báo Cáo Thống Kê
                </a>
                <a href="index.php?act=user-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Quản Lý Tài Khoản
                </a>
                
            </div>
        </div>
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
                <button class="btn btn-outline-secondary ms-3" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse me-3">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><i class="fas fa-bell me-1"></i> Thông báo <span
                                    class="badge bg-danger">4</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Admin Name
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Hồ sơ</a>
                                <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="index.php?act=tour-logout">
                                    <i class="fas fa-sign-out-alt me-1"></i> Đăng xuất
                                                                                        </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            


<div class="container">
    <div class="form-container">
        <h2><i class="bi bi-pen-fill"></i> Chỉnh Sửa Thông Tin Tour</h2>

        <form action="index.php?act=tour-update" method="POST">
            <input type="hidden" name="id" value="<?= $tour['tour_id'] ?>">

            <div class="mb-3">
                <label for="tourId" class="form-label text-muted">ID Tour:</label>
                <input type="text" id="tourId" value="<?= $tour['tour_id'] ?>" class="form-control" readonly disabled>
            </div>

            <div class="mb-3">
                <label for="tourName" class="form-label">Tên tour:</label>
                <input type="text" name="name" id="tourName" value="<?= $tour['name'] ?>" class="form-control" required placeholder="Nhập tên tour du lịch...">
            </div>

            <div class="mb-3">
                <label for="tourName" class="form-label">Ảnh tour:</label>
                <input type="file" name="image" id="tourName" value="./uploads/imgproduct/<?= $tour['image'] ?>" class="form-control" required placeholder="Nhập ảnh tour du lịch...">
            </div>

            <div class="mb-3">
                <label for="tourType" class="form-label">Loại tour:</label>
                <select name="type" id="tourType" class="form-select">
                    <option value="Trong nước" <?= $tour['type']=='Trong nước'?'selected':'' ?>>Trong nước 🇻🇳</option>
                    <option value="Quốc tế" <?= $tour['type']=='Quốc tế'?'selected':'' ?>>Quốc tế 🌍</option>
                    <option value="Theo yêu cầu" <?= $tour['type']=='Theo yêu cầu'?'selected':'' ?>>Theo yêu cầu 💡</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tourPrice" class="form-label">Giá (VNĐ):</label>
                <input type="number" name="price" id="tourPrice" value="<?= $tour['price'] ?>" class="form-control" required min="0" placeholder="Chỉ nhập số, ví dụ: 5000000">
            </div>

            <div class="mb-3">
                <label for="tourDuration" class="form-label">Thời lượng (Ngày):</label>
                <input type="number" name="duration_days" id="tourDuration" value="<?= $tour['duration_days'] ?>" class="form-control" min="1" placeholder="Số ngày du lịch, ví dụ: 3">
            </div>

            <div class="mb-4">
                <label for="tourDescription" class="form-label">Mô tả chi tiết:</label>
                <textarea name="description" id="tourDescription" class="form-control" value="<?= $tour['description'] ?>" rows="4" placeholder="Mô tả các điểm nổi bật, lịch trình tóm tắt của tour..."><?= $tour['description'] ?></textarea>
            </div>
            <div class="mb-4">
                <label for="tourDescription" class="form-label">Trạng thái:</label>
                <select  name="status" id="status" class="form-select">
                    <option value="Active"<?= $tour['status']=='Active'?'selected':'' ?>>Active</option>
                    <option value="Inactive"<?= $tour['status']=='Inactive'?'selected':'' ?>>Inactive</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="tourDescription" class="form-label">Thời gian:</label>
                <input type="date" name="created_at" id="tourDescription" value="<?= $tour['created_at']?>" class="form-control" rows="4" placeholder="Thời gian tour..."><?= $tour['created_at']?></input>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-pen-fill"></i> Cập Nhật Thông Tin</button>
            </div>
            <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-danger btn-lg"><i class="bi bi-chevron-bar-left"></i> <a class="text-decoration-none text-white" href="index.php?act=tour-list">Hủy</a></button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>