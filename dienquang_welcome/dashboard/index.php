<?php
  session_start();
  if (isset($_SESSION['logged'])){
      if(!$_SESSION['logged']){
        header('Location: ./login.php');
      }
  }
  else{
    header('Location: ./login.php');
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        button:focus,
        input:focus,
        select:focus{
            outline: none! important;
            box-shadow: none! important;
        }

        .pointer{
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Welcome page</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="./logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Load content here to edit -->
                    <?php 
                        include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');
                        $web_content = new WebContent();
                        $result = $web_content->load_content();
                        if ($result != null){
                            for($i = 0; $i < mysqli_num_rows($result); $i+=1){
                                $content = mysqli_fetch_assoc($result);
                                ?>
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $content['name']; ?></h6>
                                        <div class="my-2">
                                            <select name="" id="select-option">
                                                <option value="1" 
                                                <?php echo $content['type'] == 1 ? 'selected="selected"':''; ?>>Text</option>
                                                <option value="2"
                                                <?php echo $content['type'] == 2 ? 'selected="selected"':''; ?>>Image</option>
                                                <option value="3"
                                                <?php echo $content['type'] == 3 ? 'selected="selected"':''; ?>>Embed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div content-id="<?php echo $content['id'];?>" 
                                    class="card-body" <?php echo $content['type'] == 1 ? 'contenteditable="true"':'' ?>>
                                        <?php 
                                            if ($content['type'] == 1) {
                                                ?>
                                                <!-- HTML for TEXT go here -->
                                                <?php echo $content['content']; ?>
                                                <?php
                                            }
                                            else if ($content['type'] == 2){
                                                ?>
                                                <!-- HTML for IMAGE go here -->
                                                <input type="file" name="image_to_upload" onchange="load_image(this)" 
                                                accept="image/png, image/jpeg, image/jpg" id="upload-image">
                                                <div class="text-center">
                                                    <img src="<?php echo $content['content']; ?>" alt="">
                                                </div>
                                                <?php
                                            }
                                            else if ($content['type'] == 3){
                                                ?>
                                                <!-- HTML for Embed go here -->
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Embed Link">
                                                    <div class="input-group-append">
                                                        <span onclick="load_embed(this)" class="input-group-text bg-info text-white pointer">Load</span>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <iframe width="560" height="315" src="<?php echo $content['content']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                    <!-- <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Embed Content
                            </h6>
                            <div class="my-2">
                                <select name="" id="">
                                    <option value="">Text</option>
                                    <option value="">Image</option>
                                    <option value="" selected="selected">Embed</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Embed Link">
                                <div class="input-group-append">
                                    <span onclick="load_embed(this)" class="input-group-text bg-info text-white pointer">Load</span>
                                </div>
                            </div>
                            <div class="text-center">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/5mhasaD8jzg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div> -->
                    <!-- Load content end here -->
                    <div class="float-right my-3">
                        <button id='savebtn' class="px-3 bg-success text-light border border-dark">Save</button>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
<!-- Approach -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>

</body>

</html>