<?php
ob_start();
?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách booking</h3>
            </div>

            <div class="card-body">

                <a href="<?= BASE_URL ?>booking-create" class="btn btn-primary mb-3">
                    + Thêm booking
                </a>


                <div class="table-responsive">
           
                    <br>
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tour</th>
                                <th>Khách hàng</th>
                                <th>Hướng dẫn viên</th>
                                <!-- <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th> -->
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                                <th width="160">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($bookings as $i => $booking): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>

                                <td><?= htmlspecialchars($booking->tour_name ?? '---') ?></td>
<td><?= htmlspecialchars($booking->customer_name ?? '---') ?></td>
<td><?= htmlspecialchars($booking->guide_name ?? '--') ?></td>

                                <!-- <td><?= htmlspecialchars($booking->start_date ?? '---') ?></td>
                                <td><?= htmlspecialchars($booking->end_date ?? '---') ?></td> -->
                                <td>
                                    <?php
                                    switch ($booking->status) {
                                        case 0: echo 'Đã đặt'; break;
                                        case 1: echo 'Đang tiến hành'; break;
                                        case 2: echo 'Đã hoàn thành'; break;
                                        case 3: echo 'Đã hủy'; break;
                                        default: echo '---';
                                    }
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($booking->notes ?? '') ?></td>

                                <!-- ACTION -->
                                <td>
                                    <a href="<?= BASE_URL ?>booking-edit&id=<?= $booking->id ?>"
                                       class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>

            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'huong_dan_vien'): ?>

                                    <form method="post"
                                          action="<?= BASE_URL ?>booking-delete"
                                          style="display:inline-block"
                                          onsubmit="return confirm('Xóa booking này?')">
                                        <input type="hidden" name="id" value="<?= $booking->id ?>">
                                        <button class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
<?php endif; ?>
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
        ['label' => 'Booking', 'url' => BASE_URL . 'bookings', 'active' => true],
    ],
]);
