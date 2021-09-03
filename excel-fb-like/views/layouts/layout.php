
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?></title>
    <!-- Custom fonts for this template-->
    <link href="<?php echo Url::abs('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo Url::abs('css/style.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo Url::abs('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <!-- <link href="<?php echo Url::abs('css/sb-admin-2.min.css') ?>" rel="stylesheet"> -->
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <?php if (Session::get('isadmin')) {
                    ?>
                    <div class="sidebar-brand-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Admin</div>
                    <?php
                } ?>
                <?php if (!Session::get('isadmin')) {
                    ?>
                    <div class="sidebar-brand-icon">
                        <i class="fa fa-link" aria-hidden="true"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Fbreiplex</div>
                    <?php
                } ?>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Trang chủ
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <?php if (Session::get('isadmin')) {
                    ?>
                    <a class="nav-link" href="<?php echo Url::build('/admin');?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Danh sách tài khoản</span>
                    </a>

                    <a class="nav-link" href="<?php echo Url::build('/admin/register');?>">
                        <i class="fa fa-fw fa-user" aria-hidden="true"></i>
                        <span>Đăng ký tài khoản</span>
                    </a>
                    <?php
                } ?>
                <?php if (!Session::get('isadmin')) {
                    ?>
                    <a class="nav-link" href="<?php echo Url::build('/customer');?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Danh sách bài viết</span>
                    </a>

                    <a class="nav-link" href="<?php echo Url::build('/history');?>">
                        <i class="fa fa-fw fa-history" aria-hidden="true"></i>
                        <span>Lịch sử gói</span>
                    </a>
                    <?php
                } ?>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-inline text-gray-600 small">
                                    <?php
                                        echo Session::get('username');
                                    ?>
                                </span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> -->
                                <a class="dropdown-item" href="<?php echo Url::build('/changepassword'); ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đổi mật khẩu
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo Url::build('/logout'); ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <?php echo $content; ?>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo Url::abs('vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo Url::abs('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo Url::abs('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo Url::abs('js/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo Url::abs('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo Url::abs('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo Url::abs('js/demo/datatables-demo.js') ?>"></script>
    <!-- My JS -->
    <script src="<?php echo Url::abs('js/main.js') ?>"></script>

</body>

</html>