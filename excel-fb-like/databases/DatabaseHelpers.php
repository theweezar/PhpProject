<?php

class DatabaseHelpers extends Database {

    private $mysqli;
    public function __construct() {
        $this->mysqli = $this->getConnection();
    }

    public function close() {
        $this->mysqli->close();
    }

    /**
     * Kiểm tra username đã tồn tại chưa
     */
    public function isUsernameExist(string $username) {
        $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user.username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return count($result) === 0 ? false:true;
    }

    /**
     * Đăng ký user mới, có dùng password hash
     */
    public function register(array $user) {
        if ($this->isUsernameExist($user['username'])) {
            return array(
                'success' => false,
                'message' => 'Tên tài khoản đã tồn tại. Vui lòng thay đổi tên tài khoản khác.'
            );
        }
        $username = $user['username'];
        $realname = $user['realname'];
        $password = password_hash($user['password'], PASSWORD_DEFAULT);
        $isadmin = $user['isadmin'];
        $stmt = $this->mysqli->prepare("INSERT INTO user(username, password, realname, isadmin, likes, comments, active, created_at) 
        VALUES (?, ?, ?, ?, 0, 0, 1, NOW())");
        $stmt->bind_param("sssi", $username, $password, $realname, $isadmin);
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
    public function getCustomer() {
        $result = $this->mysqli->query('
        SELECT *, (SELECT COUNT(*) FROM history WHERE history.userId = user.id) 
        as package_bought FROM user WHERE user.isadmin = 0
        ');
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Lấy user theo id
     */
    public function getCustomerById(string $userId) {
        $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user.id = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Lấy user theo username
     */
    public function getCustomerByUsername(string $username) {
        $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user.username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Kiểm tra đăng nhập cho user và admin
     */
    public function validateLogin(array $user) {
        $username = $user['username'];
        $password = $user['password'];

        $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user.username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        if (count($result) !== 0) {
            $dbUser = $result[0];
            if (password_verify($password, $dbUser['password'])) {
                return $dbUser;
            }
        }
        return null;
    }

    /**
     * Đổi mật khẩu
     */
    public function changePassword(array $user) {
        $username = $user['username'];
        $password = $user['password'];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->mysqli->prepare('
        UPDATE user SET password=? WHERE username=?
        ');
        $stmt->bind_param("ss", $hashPassword, $username);
        return $stmt->execute();
    }

    /**
     * User thêm bài viết, likes, comments, ngày giờ tự tạo
     */
    public function addPost(array $post) {
        $userId = $post['userId'];
        $postname = $post['postname'];
        $postlink = $post['postlink'];
        $likes = $post['likes'];
        $comments = $post['comments'];
        $stmt = $this->mysqli->prepare("
        INSERT INTO post(userId, postname, postlink, likes, comments, created_at) 
        VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->bind_param("issii", $userId, $postname, $postlink, $likes, $comments);
        if ($stmt->execute()) {
            return array(
                'success' => true,
                'message' => 'Yêu cầu đã được gửi, yêu cầu của bạn sẽ được hoàn thành chậm nhất 24h'
            );
        }
        else {
            return array(
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong cơ sở dữ liệu. Vui lòng kiểm tra lại.'
            );
        }
    }

    public function getNewPost(string $userId) {
        $stmt = $this->mysqli->prepare('SELECT * FROM post WHERE userId = ? ORDER BY created_at DESC');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Lấy bài viết theo user id
     */
    public function getPosts(string $userId) {
        $stmt = $this->mysqli->prepare('SELECT * FROM post WHERE userId = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Tính toán lượt like và comment khi dùng
     */
    public function calculateLikeAndComment(array $user) {
        $users = $this->getCustomerById($user['userId']);
        if (count($users) !== 0) {
            $dbUser = $users[0];
            // Đang có
            $currentLikes = intval($dbUser['likes']);
            $currentComments = intval($dbUser['comments']);
            // Đang cần
            $needLikes = intval($user['likes']);
            $needComments = intval($user['comments']);
            // Biến kiểm tra đạt yêu cầu hay ko 
            $passLikes = false;
            $passComments = false;
            // Số lượng likes và comments sau khi đã dùng
            $afterComments = 0;
            $afterLikes = 0;
            // Nếu lượng comment đang có, đủ cho hoặc lớn hơn đang cần
            if ($needComments <= $currentComments) {
                $passComments = true;
                $afterComments = $currentComments - $needComments;
            }
            // Nếu lượng like đang có, đủ cho hoặc lớn hơn đang cần
            if ($needLikes <= $currentLikes) {
                $passLikes = true;
                $afterLikes = $currentLikes - $needLikes;
            } else {
                // 1 comment quy đổi thành 2 like, quy đổi xong thì cộng vào lượt like hiện có
                $exchangeLikes = $afterComments * 2;
                $currentLikes += $exchangeLikes;
                // Nếu lượng like đang có + lượt like quy đổi, đủ cho hoặc lớn hơn đang cần
                if ($needLikes <= $currentLikes) {
                    $passLikes = true;
                    $afterLikes = 0;
                    // Số lượng comment bị trừ vì đã dùng cho quy đổi
                    $afterComments = floor(($currentLikes - $needLikes) / 2);
                }
            }
            return array(
                'passLikes' => $passLikes,
                'passComments' => $passComments,
                'afterLikes' => $afterLikes,
                'afterComments' => $afterComments
            );
        }
        return null;
    }

    /**
     * Sau khi tính toán ra sẽ được số like, comment còn lại, lấy chúng để update
     */
    public function proceedUseLikeAndComment(array $user) {
        $stmt = $this->mysqli->prepare('
        UPDATE user SET likes=?, comments=? WHERE id=?
        ');
        $stmt->bind_param("iii", $user['likes'], $user['comments'], $user['userId']);
        return $stmt->execute();
    }

    /**
     * Kiểm tra xem tài khoản user đang có gói nào kích hoạt hay ko
     */
    public function isAccountActivated(string $userId) {
        $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user.id = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $user = $result[0];
        return strcmp($user['active'], '1') === 0 ? true : false;
    }

    /**
     * Kích hoạt gói cho User và nhớ lưu vào History và dùng SUM để tính lượng gói đã kích hoạt
     * của user nào đó
     */
    public function activate(string $userId) {
        $stmt = $this->mysqli->prepare('
        UPDATE user AS a INNER JOIN user AS b ON a.id = b.id SET a.likes = b.likes + 250, 
        a.comments = b.comments + 200 WHERE a.id = ?
        ');
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    /**
     * Lưu lại lịch sử mua gói
     */
    public function saveHistory(string $userId) {
        $stmt = $this->mysqli->prepare("
        INSERT INTO history(userid, activated_at) 
        VALUES (?, NOW())
        ");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    /**
     * Lấy lịch sử mua gói
     */
    public function getHistory(string $userId) {
        $stmt = $this->mysqli->prepare('
        SELECT * FROM history WHERE userId = ?
        ');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}