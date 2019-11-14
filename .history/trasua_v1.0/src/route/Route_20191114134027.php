<?php

class Route extends Controller{

  
  public function home(){
    /**
     * Homepage sẽ liệt kê ra các món trà sữa để user lựa vào đặt món
     */
    if (isset($_SESSION['logged'])){
      $hanghoa = $this->model("Hanghoa");
      $trasua = $hanghoa->getAll();
      $this->view("home",true,["trasua"=>$trasua]);
    }
    else $this->view("start",false);
  }

  public function login(){
    /**
     * Sau khi login thành công ta sẽ kiểm tra tài khoản là client hay là administrator
     * cả 2 đều có thể order
     * kiểm tra xem user hiện tại có tồn tại giỏ hàng hay ko
     * nếu có thì tạo Session['mgh'] = giỏ hạng mà user đó đang có
     * Session['hascart'] = true vì giỏ hàng tồn tại
     */
    if (!isset($_SESSION["logged"])){
      if (isset($_POST['username']) && isset($_POST['password'])){
        $users = $this->model("Users");
        $curr_user = $users->validate($_POST['username'],$_POST['password']);
        if ($curr_user['logged']){
          $_SESSION['logged'] = true;
          $_SESSION['username'] = $curr_user['infor']['username'];
          $_SESSION['fname'] = $curr_user['infor']['fname'];
          $_SESSION['sdt'] = $curr_user['infor']['sdt'];
          $_SESSION['email'] = $curr_user['infor']['email'];
          $_SESSION['client'] = $curr_user['infor']['client'];
          /**
           * kiểm tra xem user đó có giỏ hàng tồn tại trong database ko để set SESSION
           */
          $giohang = $this->model("Giohang");
          if ($giohang->checkExist($_SESSION["username"])) {
            $_SESSION['hascart'] = true;
            $_SESSION['mgh'] = $giohang->getgiohangwithusername($_SESSION['username']);
          }
          else $_SESSION['hascart'] = false;
          header("Location: /home");
        }
        else $this->view("login",false,["error"=>"Wrong password or username"]);
      }
      else $this->view("login",false);
    }
    else header("Location: home");
  }

  public function logout(){
    if (isset($_SESSION['logged'])) session_destroy();
    header("Location: home");
  }

  public function register(){
    if (!isset($_SESSION['logged'])){
      if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['sdt']) && isset($_POST['email'])){
        $users = $this->model("Users");
        $fname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $users->createUser($fname,$username,$password,$sdt,$email,true);
        header("Location: home");
      }
      else $this->view("register",false);
    }
    else header("Location: home");
  }

  public function add($mh=''){
    /**
     * nếu user có sẵn giỏ hàng thì thêm vào giỏ đó, ko thì tạo mới rồi thêm món hàng đó vào luôn
     */
    if (isset($_SESSION['logged'])){
      $giohang = $this->model("Giohang");
      if (!$_SESSION['hascart']){
        $giohang->createnewgiohang($_SESSION['username']);
        $_SESSION['hascart'] = true;
        $_SESSION['mgh'] = $giohang->getgiohangwithusername($_SESSION['username']);
        $giohang->themHang($_SESSION['mgh'],$mh);
      }
      else $giohang->themHang($_SESSION['mgh'],$mh);
      echo $_SESSION['mgh'];
    }
  }

  public function giohang(){
    /**
     * tạo kết nối tới giỏ hàng
     * tìm giỏ hàng hiện tại khớp với user hiện tại
     * sau đó lấy toàn bộ hàng mà người đó đã order - sẽ bị lập lại
     * vào database HangHoa để lấy cả thông tin lẫn giá tiền theo mh, mh này được lấy từ
     * CTGH
     */
    if (isset($_SESSION['logged'])){
      $giohang = $this->model("Giohang");
      $hanghoa = $this->model("Hanghoa");
      $curr_giohang = array();
      $curr_trasua = array();
      if (isset($_SESSION['mgh'])){
        $curr_giohang = $giohang->getCTGHwithMGH($_SESSION['mgh']);
        foreach ($curr_giohang as $i => $hang) {
          # code...
          array_push($curr_trasua,$hanghoa->getwithcode($hang["mh"]));
        }
      }
      $this->view("giohang",true,["giohang"=>$curr_giohang,"trasua"=>$curr_trasua]);
    }
  }

  public function qlnd(){
    /**
     * List ra tất cả các Users
     */
    if (isset($_SESSION["logged"])){
      if (!$_SESSION["client"]){
        $users = $this->model("Users");
        $allusers = $users->getAllUsers();
        $this->view("quanly",true,["users"=>$allusers]);
      }
      else header("Location: home");
    }
    else header("Location: home");
  }

  public function thanhtoan($thanhtien=''){
    /**
     * kết nối database hóa đơn
     * tạo hóa đơn mới với mgh và thành tiền
     * unset Session['mgh'] đi vì giỏ hàng hiện tại đã được thanh toán
     * session['hascart'] = false vì ko còn giỏ hàng
     */
    if (isset($_SESSION['logged'])){
      $hoadon = $this->model("Hoadon");
      $giohang = $this->model("Giohang");
      $hoadon->createNewbill($_SESSION['mgh'],$thanhtien);
      $giohang->pay($_SESSION['mgh']);
      unset($_SESSION['mgh']);
      $_SESSION['hascart'] = false;
      header("Location: /");
    }
  }

  public function themtrasua(){
    if (isset($_POST['upload'])){
      $target_dir = "img/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]);
      print_r($target_file);
    }
    else $this->view("themtrasua",true); 
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // // Check if image file is a actual image or fake image
    // if(isset($_POST["submit"])) {
    //   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //   if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    //   } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    //   }
    // }
    // // Check if file already exists
    // if (file_exists($target_file)) {
    //   echo "Sorry, file already exists.";
    //   $uploadOk = 0;
    // }
    // // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    //   echo "Sorry, your file is too large.";
    //   $uploadOk = 0;
    // }
    // // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    // && $imageFileType != "gif" ) {
    //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //   $uploadOk = 0;
    // }
    // // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    //   echo "Sorry, your file was not uploaded.";
    // // if everything is ok, try to upload file
    // } else {
    //   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //     echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    //   } else {
    //     echo "Sorry, there was an error uploading your file.";
    //   }
    // }
  }

  public function pagenotfound(){
    echo "Page not found";
  }
}