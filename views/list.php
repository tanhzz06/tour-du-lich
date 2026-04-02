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
    <title>Dashboard Quản Trị Tour</title>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a href="index.php?act=tour-list" class="list-group-item list-group-item-action active ">
                    <i class="fas fa-list me-2"></i> Danh Sách Tour
                </a>
             
                <a href="index.php?act=schedule-list" class="list-group-item list-group-item-action">
                     <i class="fas fa-road me-2"></i> Quản Lý Tour
                </a>
                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action">
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

            <!-- MAIN CONTENT -->
            <div class="container-fluid p-4">

                <h2 class="mt-4 text-secondary">Danh Sách Tour</h2>

                <a href="index.php?act=tour-create" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Thêm Tour
                </a>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên tour</th>
                            <th>Ảnh tour</th>
                            <th>Loại</th>
                            <th>Giá</th>
                            <th>Thời lượng</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>

                            <th style="width: 150px;">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($tours as $tour): ?>
                            <tr>
                                <td><?= $tour['tour_id'] ?></td>
                                <td><?= $tour['name'] ?></td>
                                <td><img src="./uploads/imgproduct/<?= $tour['image'] ?>" alt="<?= $tour['name'] ?>" style="max-width: 200px; height: auto; margin-bottom: 10px;"></td>
                                <td><?= $tour['type'] ?></td>
                                <td><?= number_format($tour['price'] ?? 0) ?>đ</td>
                                <td><?= $tour['duration_days'] ?> ngày</td>
                                <td><?= $tour['description'] ?></td>
                                <td><?php
                                       $status = $tour['status'];
                                       $badgeClass = "bg-secondary";

                                       if($status=='Active'){
                                        $badgeClass ="bg-danger";
                                       }elseif ($status=='Inactive'){
                                            $badgeClass ="bg-success";
                                       }

                                       echo "<span class='badge $badgeClass px-3 py-2'>$status</span>";
                                 ?></td>
                                 <td><?= $tour['created_at'] ?></td>

                                <td>
                                    <a class="btn btn-sm btn-warning"
                                        href="index.php?act=tour-edit&id=<?= $tour['tour_id'] ?>">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>   
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        document.getElementById("menu-toggle").onclick = function () {
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
</body>

</html