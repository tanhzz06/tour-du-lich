<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản Trị Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


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
    </style>
</head>

<body>

    <div class="d-flex" id="wrapper">

        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom border-secondary">
                <i class="fas fa-plane-departure text-info"></i> Quản Lý
            </div>
            <div class="list-group list-group-flush">
                <a href="index.php?act=admin-home" class="list-group-item list-group-item-action active ">
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
            <div class="container-fluid p-4">
                <h1 class="mt-4 mb-4 text-secondary">Dashboard Tổng Quan</h1>

                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-road fa-2x"></i>
                                    </div>
                                    <div class="col">
                                        <div class="text-uppercase fw-bold">Tổng số Tour</div>
                                        <div class="h5 mb-0"><?= $totalTours ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x"></i>
                                    </div>
                                    <div class="col">
                                        <div class="text-uppercase fw-bold">Doanh thu (Tháng)</div>
                                        <div class="h5 mb-0">500 Triệu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-warning text-dark shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                    <div class="col">
                                        <div class="text-uppercase fw-bold">Khách hàng mới</div>
                                        <div class="h5 mb-0">245</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card bg-danger text-white shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 mb-4">
                            <div class="card shadow">
                                <div class="card-header bg-white fw-bold">
                                    <i class="fas fa-chart-bar me-2"></i> Biểu đồ Doanh thu
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="revenueChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                        <div class="card shadow">
                            <div class="card-header-custom p-3">
                                <i class="fas fa-globe-asia me-2 text-success"></i> Phân loại Tour
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <canvas id="categoryChart" style="max-height: 350px; max-width: 350px;"></canvas>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
                

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header-custom p-3">
                                <i class="fas fa-history me-2 text-warning"></i> 10 Đơn hàng Gần nhất
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Mã Đơn</th>
                                                <th>Khách hàng</th>
                                                <th>Tour Đặt</th>
                                                <th>Ngày Đặt</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#00101</td>
                                                <td>Nguyễn Văn A</td>
                                                <td>Hạ Long 3N2Đ</td>
                                                <td>18/11/2025</td>
                                                <td>15,000,000 VNĐ</td>
                                                <td><span class="badge bg-warning">Chờ duyệt</span></td>
                                            </tr>
                                            <tr>
                                                <td>#00100</td>
                                                <td>Trần Thị B</td>
                                                <td>Phú Quốc 4N3Đ</td>
                                                <td>17/11/2025</td>
                                                <td>22,500,000 VNĐ</td>
                                                <td><span class="badge bg-success">Đã thanh toán</span></td>
                                            </tr>
                                            <tr>
                                                <td>#00099</td>
                                                <td>Lê Văn C</td>
                                                <td>Du Lịch Châu Âu</td>
                                                <td>17/11/2025</td>
                                                <td>78,000,000 VNĐ</td>
                                                <td><span class="badge bg-info">Đang xử lý</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Toggle Sidebar
                    document.getElementById("menu-toggle").onclick = function () {
                        document.getElementById("wrapper").classList.toggle("toggled");
                    };
                </script>

                <script src="./assets/js/main.js"></script>
</body>

</html>