<?php
class UserModel {

    public static function checkLogin($username, $password) {
        $conn = connectDB(); // hàm trong env.php

        $sql = "SELECT * FROM users WHERE username = :u AND password = :p LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':u' => $username,
            ':p' => $password
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
