<?php
// Sử dụng layout và truyền nội dung vào
ob_start();
?>

<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <!-- Default box -->    
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sửa</h3>
                <div class="card-tools">
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-collapse"
                        title="Collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
             
                    <div class="table-reponsive">


                         <!-- <a href="<?= BASE_URL ?>booking-create" class="btn btn-primary">+ Thêm tour</a> -->

<form method="post" action="<?= BASE_URL ?>booking-update">
    <input type="hidden" name="id" >
    <?php include 'form.php'; ?>
</form>

                              

                       
                    </div>
                

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!--end::Row-->

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
    'title' => $title,
    'pageTitle' => $title,
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Trang chủ', 'url' => BASE_URL . 'home', 'active' => true],
        ['label' => 'danh mục', 'url' => BASE_URL . 'categories', 'active' => true],
    ],
]);
?>