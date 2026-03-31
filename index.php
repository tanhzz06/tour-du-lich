<?php
ob_start();
?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách khách hàng</h3>
            </div>

            <div class="card-body">

                <a href="<?= BASE_URL ?>customer-create" class="btn btn-primary mb-3">
                    + Thêm khách hàng
                </a>
<div class="search-container">
    <form method="GET" action="">
        <input type="text" name="keyword" placeholder="Tìm kiếm ..." 
               value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" />
        <button type="submit">Tìm kiếm</button>
    </form>
</div><br>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <!-- <th>Số lượng người</th> -->
                                <!-- <th>Tour đã đặt</th> -->
                               
                                <th width="160">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($customers as $i => $customer): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>

                                <td><?= htmlspecialchars($customer->name) ?></td>

                                <td><?= htmlspecialchars($customer->email) ?></td>

                                <td><?= htmlspecialchars($customer->tel) ?></td>
                                <!-- <td><?= htmlspecialchars($customer->so_luong) ?></td> -->

                                <!-- <td><?= htmlspecialchars($customer->tour_name ?? '---') ?></td> -->

                                <!-- STATUS -->
                               

                                <!-- ACTION -->
                                <td>
                                    <a href="<?= BASE_URL ?>customer-edit&id=<?= $customer->id ?>"
                                       class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'huong_dan_vien'): ?>

                                    <form method="post"
                                          action="<?= BASE_URL ?>customer-delete"
                                          style="display:inline-block"
                                          onsubmit="return confirm('Xóa khách hàng này?')">
                                        <input type="hidden" name="id" value="<?= $customer->id ?>">
                                        <button class="btn btn-sm btn-danger">Xóa</button>
                                    </form><?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title,
    'pageTitle' => $title,
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Trang chủ', 'url' => BASE_URL . 'home'],
        ['label' => 'Khách hàng', 'url' => BASE_URL . 'customers', 'active' => true],
    ],
]);
