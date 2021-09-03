<?php
$rurl = isset($viewData['rurl']) ? $viewData['rurl'] : '';
$message = isset($viewData['message']) ? $viewData['message'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo strcmp($rurl, '1') ? 'Đăng nhập Admin' : 'Đăng nhập Fbreiplex' ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo Url::abs('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo Url::abs('css/style.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <?php echo strcmp($rurl, '1') == 0 ? 'Đăng nhập Admin' : 'Đăng nhập Fbreiplex' ?>
                                        </h1>
                                    </div>
                                    <form action="<?php echo Url::build('/login') ?>" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username"
                                                name="username" aria-describedby="username"
                                                placeholder="Nhập tên tài khoản">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Nhập mật khẩu">
                                        </div>
                                        <input type="submit" name="submit" value="Đăng nhập"
                                            class="btn btn-primary btn-user btn-block">
                                        <?php 
                                        if (isset($viewData['csrfToken'])) {
                                            $token = $viewData['csrfToken'];
                                            ?>
                                            <input type="hidden" name="<?php echo $token['name'] ?>" 
                                            value="<?php echo $token['value'] ?>">
                                            <?php
                                        }
                                        ?>
                                        <input type="hidden" name="rurl" 
                                            value="<?php echo $rurl ?>">
                                    </form>
                                    <?php 
                                        if (strcmp($message, '') != 0) {
                                            ?>
                                            <div class="alert alert-danger mt-3" role="alert">
                                                <?php echo $message; ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>