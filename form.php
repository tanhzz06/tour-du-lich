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
    <input type="hidden" name="id" value="<?= $customer->id ?? '' ?>">

    <div class="form-full">
        <label class="admin-label">Tên khách hàng (cá nhân hoặc người đại diện)</label>
        <input
            type="text"
            name="name"
            value="<?= htmlspecialchars($customer->name ?? '') ?>"
            class="admin-input"
            required
        >
    </div>

    <div class="form-grid">
        <div>
            <label class="admin-label">Số điện thoại (cá nhân hoặc người đại diện)</label>
            <input
                type="tel"
                name="tel"
                value="<?= htmlspecialchars($customer->tel ?? '') ?>"
                class="admin-input"
                pattern="[0-9]{10,15}"
                title="Số điện thoại chỉ gồm 10-15 chữ số"
                required
            >
        </div>

        <div>
            <label class="admin-label">Email</label>
            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($customer->email ?? '') ?>"
                class="admin-input"
                required
            >
        </div>

        <!-- Nếu muốn bắt buộc số lượng khách, bỏ comment và thêm required -->
        <!--
        <div>
            <label class="admin-label">Số lượng người (Nếu khách hàng là người đại diện)</label>
            <input
                type="number"
                name="so_luong"
                min="1"
                value="<?= htmlspecialchars($customer->so_luong ?? '') ?>"
                class="admin-input"
                required
            >
        </div>
        -->
    </div>

    <button type="submit" class="admin-button">💾 Lưu</button>
</form>

