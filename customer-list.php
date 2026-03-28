<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success auto-hide">
        <?= $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: #f8f9fa;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background-color: #343a40;
            color: #ffffff;
            position: fixed;
            z-index: 1030;
        }

        #page-content-wrapper {
            width: 100%;
            transition: padding-left .25s ease-out;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #wrapper.toggled #page-content-wrapper {
            padding-left: 15rem;
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
            color: #ffffff;
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
                <a href="index.php?act=customer-list" class="list-group-item list-group-item-action active">
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


            <!-- MAIN CONTENT -->
            <div class="container-fluid p-4">

                <!-- Tiêu đề -->
                <h2 class="mt-4 fw-bold text-secondary">
                    <i class="fas fa-users me-2"></i> Quản Lý Khách Hàng
                </h2>

                <!-- Thanh hành động -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-semibold">
                        <i class="fas fa-list me-2"></i> Danh sách khách hàng
                    </h4>

                    <a href="index.php?act=customer-create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tạo khách hàng
                    </a>
                </div>

                <!-- Bảng -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">

                        <table class="table table-hover mb-0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <!-- <th>Ngày tạo</th> -->
                                    <th>Trạng thái</th>
                                    <th>Loại</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($customers)): ?>
                                    <?php $i = 1;
                                    foreach ($customers as $c): ?>
                                        <tr>
                                            <td><?= $i++; ?></td>

                                            <td class="fw-semibold"><?= htmlspecialchars($c['full_name']) ?></td>

                                            <td><?= htmlspecialchars($c['email']) ?></td>

                                            <td><?= htmlspecialchars($c['phone']) ?></td>

                                            <td><?= htmlspecialchars($c['address']) ?></td>


                                            




                                            <td>
                                                <?php if ($c['status'] == 1): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Inactive</span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                        <?php if ($c['customer_type'] === 'adult'): ?>
                            <span class="badge bg-primary">Người lớn</span>
                        <?php else: ?>
                            <span class="badge bg-success">Trẻ em</span>
                        <?php endif; ?>
                    </td>

                                            <td class="text-center">
                                                <a href="index.php?act=customer-detail&id=<?= $c['customer_id'] ?>"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Xem
                                                </a>

                                                <a href="index.php?act=customer-edit&id=<?= $c['customer_id'] ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-3">Không có dữ liệu</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>

                    </div>
                </div>

            </div>
            <script>
                // Toggle Sidebar
                document.getElementById("menu-toggle").onclick = function() {
                    document.getElementById("wrapper").classList.toggle("toggled");
                };

                setTimeout(function() {
                    const alert = document.querySelector('.auto-hide');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s';
                        alert.style.opacity = '0';

                        setTimeout(() => alert.remove(), 500);
                    }
                }, 2000);
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>