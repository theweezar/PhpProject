<?php

include($_SERVER['DOCUMENT_ROOT'].'/database/Database.php');

class FunctionHelpers extends Database {

    private $mysqli;
    public function __construct() {
        $this->mysqli = $this->getConnection();
    }

    /**
     * Kiểm tra username đã tồn tại chưa
     */
    public function isUsernameExist(string $username) {
        $result = $this->mysqli->query('SELECT * FROM user WHERE username="'.$username.'"');
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return count($result) === 0 ? false:true;
    }

    /**
     * Đăng ký user mới, có dùng password hash
     */
    public function register(array $user) {
        $username = $user['username'];
        $password = password_hash($user['password'], PASSWORD_DEFAULT);
        $isAdmin = $user['isAdmin'];
        $stmt = $this->mysqli->prepare("INSERT INTO user(username, password, isAdmin, likes, comments, active,created_at) 
        VALUES (?, ?, ?, 0, 0, 0, NOW())");
        $stmt->bind_param("ssi", $username, $password, $isAdmin);
        if ($stmt->execute()) {
            return array(
                'success' => true,
                'message' => 'Thêm tài khoản thành công'
            );
        }
        else {
            return array(
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong cơ sở dữ liệu. Vui lòng kiểm tra lại.'
            );
        }
    }
    
    /**
     * Lấy danh sách tất cả user
     */
    public function getUser() {
        $result = $this->mysqli->query('SELECT * FROM user WHERE ');
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Kiểm tra đăng nhập cho user và admin
     */
    public function validateLogin(array $user) {
        $username = $user['username'];
        $password = $user['password'];
        $result = $this->mysqli->query('SELECT * FROM user WHERE username="'.$username.'"');
        $result = $result->fetch_all(MYSQLI_ASSOC);
        if (count($result) !== 0) {
            $dbUser = $result[0];
            return password_verify($password, $dbUser['password']);
        }
        return false;
    }

    /**
     * User thêm bài viết, likes, comments, ngày giờ tự tạo
     */
    public function addPost(array $post) {
        $userId = $post['userId'];
        $link = $post['link'];
        $likes = $post['likes'];
        $comments = $post['comments'];
        $stmt = $this->mysqli->prepare("INSERT INTO post(userId, link, likes, comments, created_at) 
        VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("isii", $userId, $link, $likes, $comments);
        if ($stmt->execute()) {
            return array(
                'success' => true,
                'message' => 'Thêm bài viết thành công'
            );
        }
        else {
            return array(
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong cơ sở dữ liệu. Vui lòng kiểm tra lại.'
            );
        }
    }

    /**
     * Kiểm tra xem tài khoản user đang có gói nào kích hoạt hay ko
     */
    public function isAccountActivate(string $id) {
        $result = $this->mysqli->query('SELECT * FROM user WHERE id='.$id.' AND active=1');
        return $result->fetch_all(MYSQLI_ASSOC);
        return count($result) === 0 ? false:true;
    }

    /**
     * Kích hoạt gói cho User và nhớ lưu vào History và dùng SUM để tính lượng gói đã kích hoạt
     * của user nào đó
     */
    public function activate(string $userId) {
        $stmt = $this->mysqli->prepare("UPDATE user SET active=1, likes=250, comments=200 WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}