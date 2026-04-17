<?php
ob_start();
?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách người dùng</h3>
            </div>

            <div class="card-body">

                <a href="<?= BASE_URL ?>user-create" class="btn btn-primary mb-3">
                    + Thêm người dùng
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
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                                <th width="160">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($users as $i => $user): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($user->name ?? '---') ?></td>
                                <td><?= htmlspecialchars($user->email ?? '---') ?></td>
                                <td>
                                    <?php
                                        switch ($user->role) {
                                            case 'admin': echo 'Admin'; break;
                                            case 'huong_dan_vien': echo 'Hướng dẫn viên'; break;
                                            case 'user': echo 'User'; break;
                                            default: echo '---';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?= isset($user->status) && $user->status == 1 ? 'Active' : 'Inactive' ?>
                                </td>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'huong_dan_vien'): ?>

                                <!-- ACTION -->
                                <td>
                                    <a href="<?= BASE_URL ?>user-edit&id=<?= $user->id ?>"
                                       class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>
                                    <form method="post"
                                          action="<?= BASE_URL ?>user-delete"
                                          style="display:inline-block"
                                          onsubmit="return confirm('Xóa người dùng này?')">
                                        <input type="hidden" name="id" value="<?= $user->id ?>">
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
        ['label' => 'Người dùng', 'url' => BASE_URL . 'users', 'active' => true],
    ],
]);
