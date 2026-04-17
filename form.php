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
    <input type="hidden" name="id" value="<?= $user->id ?? '' ?>">

    <!-- Tên người dùng -->
    <div class="form-full">
        <label class="admin-label">Tên người dùng</label>
        <input type="text" name="name" class="admin-input"
               value="<?= htmlspecialchars($user->name ?? '') ?>" required>
    </div>

    <!-- Email -->
    <div class="form-full">
        <label class="admin-label">Email</label>
        <input type="email" name="email" class="admin-input"
               value="<?= htmlspecialchars($user->email ?? '') ?>" required>
    </div>

    <!-- Mật khẩu (chỉ dùng khi thêm mới hoặc đổi) -->
    <div class="form-full">
        <label class="admin-label">Mật khẩu</label>
        <input type="password" name="password" class="admin-input"
               <?= isset($user) ? '' : 'required' ?>>
        <?php if(isset($user)): ?>
            <small>Để trống nếu không muốn thay đổi mật khẩu</small>
        <?php endif; ?>
    </div>

    <!-- Vai trò -->
    <div class="form-full">
        <label class="admin-label">Vai trò</label>
        <select name="role" class="admin-select" required>
            <option value="admin" <?= (isset($user->role) && $user->role == 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="huong_dan_vien" <?= (isset($user->role) && $user->role == 'huong_dan_vien') ? 'selected' : '' ?>>Hướng dẫn viên</option>
            <option value="user" <?= (isset($user->role) && $user->role == 'user') ? 'selected' : '' ?>>User</option>
        </select>
    </div>

    <!-- Trạng thái -->
    <div class="form-full">
        <label class="admin-label">Trạng thái</label>
        <select name="status" class="admin-select" required>
            <option value="1" <?= (isset($user->status) && $user->status == 1) ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= (isset($user->status) && $user->status == 0) ? 'selected' : '' ?>>Inactive</option>
        </select>
    </div>

    <button type="submit" class="admin-button">💾 Lưu</button>
</form>
