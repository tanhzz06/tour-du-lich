<style>
.admin-form {
    max-width: 900px;
    margin: 20px auto;
    padding: 24px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    font-family: system-ui, sans-serif;
}

.admin-label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

/* input chung */
.admin-input,
.admin-select,
.admin-textarea,
.admin-file {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
}

/* textarea gọn */
.admin-textarea {
    min-height: 60px;
    resize: vertical;
}

/* grid 2 cột */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}

/* grid full */
.form-full {
    margin-bottom: 16px;
}

/* button */
.admin-button {
    padding: 10px 18px;
    background: #4f46e5;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
</style>
<form method="post" action="<?= $action ?>" class="admin-form">
    
    <!-- ID (chỉ dùng khi edit) -->
    <input type="hidden" name="id" value="<?= $booking->id ?? '' ?>">

    <!-- Chọn Tour -->
    <div class="form-full">
        <label class="admin-label">Tour</label>
        <select id="tourSelect" name="tour_id[]" multiple required>
            <?php 
            $selectedTours = isset($booking->tour_id) ? explode('|', $booking->tour_id) : [];
            foreach ($tours as $tourItem): ?>
                <option value="<?= $tourItem->id ?>" 
                    <?= in_array($tourItem->id, $selectedTours) ? 'selected' : '' ?> >
                    <?= htmlspecialchars($tourItem->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Chọn Khách hàng -->
    <div class="form-full">
        <label class="admin-label">Khách hàng</label>
        <select name="customers_id" class="admin-select" required>
            <option value="">-- Chọn khách hàng --</option>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= $customer->id ?>"
                    <?= (isset($booking->customers_id) && $booking->customers_id == $customer->id) ? 'selected' : '' ?> >
                    <?= htmlspecialchars($customer->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Chọn Guide (chỉ admin) -->
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'huong_dan_vien'): ?>
        <div class="form-full">
            <label class="admin-label">Hướng dẫn viên</label>
            <select name="guide_id" class="admin-select" required>
                <option value="">-- Chọn hướng dẫn viên --</option>
                <?php foreach ($guides as $guideItem): ?>
                    <option value="<?= $guideItem->id ?>"
                        <?= (isset($booking->guide_id) && $booking->guide_id == $guideItem->id) ? 'selected' : '' ?> >
                        <?= htmlspecialchars($guideItem->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Thời gian -->
    <div class="form-grid">
        <div>
            <label class="admin-label">Ngày bắt đầu</label>
            <input type="date" name="start_date" value="<?= $booking->start_date ?? '' ?>" class="admin-input" required>
        </div>
        <div>
            <label class="admin-label">Ngày kết thúc</label>
            <input type="date" name="end_date" value="<?= $booking->end_date ?? '' ?>" class="admin-input" required>
        </div>
    </div>

    <!-- Trạng thái -->
    <div class="form-full">
        <label class="admin-label">Trạng thái</label>
        <select name="status" class="admin-select" required>
            <option value="0" <?= (isset($booking->status) && $booking->status == 0) ? 'selected' : '' ?>>Đã đặt</option>
            <option value="1" <?= (isset($booking->status) && $booking->status == 1) ? 'selected' : '' ?>>Đang tiến hành</option>
            <option value="2" <?= (isset($booking->status) && $booking->status == 2) ? 'selected' : '' ?>>Đã hoàn thành</option>
            <option value="3" <?= (isset($booking->status) && $booking->status == 3) ? 'selected' : '' ?>>Đã hủy</option>
        </select>
    </div>

    <!-- Ghi chú -->
    <div class="form-full">
        <label class="admin-label">Ghi chú</label>
        <textarea name="notes" class="admin-textarea" required><?= htmlspecialchars($booking->notes ?? '') ?></textarea>
    </div>

    <button type="submit" class="admin-button">💾 Lưu</button>
</form>

<!-- Tom Select CSS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

<!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect('#tourSelect', {
            plugins: ['remove_button'], // cho nút xóa từng item
            placeholder: 'Chọn tour...',
            maxItems: null, // cho phép chọn nhiều
            searchField: ['text'] // tìm kiếm theo text
        });
    });
</script>
