<?php
Layout::start('Đăng ký tài khoản');
?>

<div class="register-form-wrapper d-flex justify-content-center">
    <form action="<?php echo Url::build('/admin/register') ?>" method="post">
        <div class="text-center">
            <h2>Form đăng ký tài khoản</h2>
        </div>
        <?php 
        if (isset($viewData['status'])) {
            $status = $viewData['status'];
            ?>
            <div class="alert <?php echo $status['success'] ? 'alert-success':'alert-danger'; ?>" role="alert">
                <?php echo $status['message']; ?>
            </div>
            <?php
            if ($status['success']) {
                ?>
                <div class="alert alert-primary" role="alert">
                    <div>
                        <b>Tài khoản: </b>
                        <span><?php echo $status['newUsername'] ?></span>
                    </div>
                    <div>
                        <b>Mật khẩu : </b>
                        <span><?php echo $status['newPassword'] ?></span>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="form-group mb-3">
            <label class="mb-2" for="realname">Họ và tên</label>
            <input type="text" class="form-control" id="realname" name="realname" placeholder="Họ và tên">
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="username">Tên tài khoản</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Tên tài khoản">
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
        </div>
        <div class="form-group mb-3">
            <input name="passwordGenerate" type="button" id="passwordGenerate" class="btn btn-warning w-100"
                value="Tạo mật khẩu ngẫu nhiên">
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="isadmin" value="isadmin" class="form-check-input" id="isadmin">
            <label class="form-check-label" for="isadmin">Đăng ký tài khoản này như là 1 Admin</label>
        </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-primary w-100" value="Submit">
        </div>
        <?php 
        if (isset($viewData['csrfToken'])) {
            $token = $viewData['csrfToken'];
            ?>
            <input type="hidden" name="<?php echo $token['name'] ?>" 
            value="<?php echo $token['value'] ?>">
            <?php
        }
        ?>
    </form>
</div>

<?php 
Layout::end();
?>