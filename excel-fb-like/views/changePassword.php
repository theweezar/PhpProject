<?php
$token = $viewData['csrfToken'];
Layout::start('Đăng ký tài khoản');
?>

<div class="register-form-wrapper d-flex justify-content-center">
    <form action="<?php echo Url::build('/changepassword') ?>" method="post">
        <div class="text-center">
            <h2>Form đổi mật khẩu</h2>
        </div>
        <?php 
        if (isset($status)) {
            ?>
            <div class="alert <?php echo $status['success'] ? 'alert-success':'alert-danger'; ?>" role="alert">
                <?php echo $status['message']; ?>
            </div>
            <?php
        }
        ?>
        <div class="form-group mb-3">
            <label class="mb-2" for="realname">Mật khẩu cũ</label>
            <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Mật khẩu cũ">
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="username">Mật khẩu mới</label>
            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Mật khẩu mới">
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="password">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Xác nhận mật khẩu">
        </div>
        <div class="form-group mb-3">
            <input name="passwordGenerate" type="button" id="passwordGenerate" class="btn btn-warning w-100"
                value="Tạo mật khẩu ngẫu nhiên">
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-primary w-100" value="Submit">
        </div>
        <input type="hidden" name="<?php echo $token['name'] ?>" value="<?php echo $token['value'] ?>">
    </form>
</div>


<?php 
    Layout::end(); 
?>