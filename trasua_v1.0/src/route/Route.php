<?php

class Route extends Controller{
  
  public function home(){
    /**
     * Homepage sẽ liệt kê ra các món trà sữa để user lựa vào đặt món
     */
    if (isset($_SESSION['logged'])){
      $hanghoa = $this->model("Hanghoa");
      $trasua = $hanghoa->getAllStillSell();
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

  public function quanly($username=''){
    /**
     * List ra tất cả các Users
     * Ngoài ra, còn có thể xem được đơn hàng hiện tại của User
     * Nếu giỏ hàng có tồn tại ($giohang->checkExist($username)) thì ta sẽ lấy cái giở hàng đó
     */
    if (isset($_SESSION["logged"])){
      if (!$_SESSION["client"]){
        $users = $this->model("Users");
        // $hanghoa = $this->model("Hanghoa");
        // $giohang = $this->model("Giohang");
        $hoadon = $this->model("Hoadon");
        if (strcasecmp(trim($username),"") == 0){
          $allusers = $users->getAllUsers();
          $this->view("quanly",true,["users"=>$allusers]);
        }
        else{
          // if ($giohang->checkExist($username)){
          //   $ghinfor = array();
          //   $mgh = $giohang->getgiohangwithusername($username);
          //   $ctgh = $giohang->getCTGHwithMGH($mgh);
          //   foreach ($ctgh as $key => $gh) {
          //     # code...
          //     array_push($ghinfor,["hang"=>$hanghoa->getwithcode($gh["mh"]),"soluong"=>$gh["soluong"]]);
          //   }
          //   $this->view("chitietdonhang",true,["ctgh"=>$ghinfor]);
          // }
          // else $this->view("chitietdonhang",true);
          $allbills = $hoadon->getAllPaidBill($username);
          $this->view("lichsugd",true,["allbills"=>$allbills]);
        }
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
     * trong mysql đã dùng current_timestamp cho cột created_at nên ta ko cần tạo mới nữa
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

  public function lichsu($mgh=""){
    /**
     * Lịch sử giao dịch 
     */
    if (isset($_SESSION["logged"])){
      $hoadon = $this->model("Hoadon");
      $giohang = $this->model("Giohang");
      $hanghoa = $this->model("Hanghoa");
      if (strcasecmp($mgh,"") == 0){
        $allbills = $hoadon->getAllPaidBill($_SESSION["username"]);
        // print_r($allbills);
        $this->view("lichsugd",true,["allbills"=>$allbills]);
      }
      else{
        $OK = false;
        if (!$_SESSION["client"]) $OK = true;
        else if ($giohang->isMyGH($mgh)) $OK = true;
        if ($OK){
          $ctgh = $giohang->getCTGHwithMGH($mgh);
          // $thanhtien = $hoadon->getPrice($mgh);
          $bill = $hoadon->getOneBill($mgh);
          $ghinfor = array();
          foreach ($ctgh as $key => $gh) {
            # code...
            array_push($ghinfor,["hang"=>$hanghoa->getwithcode($gh["mh"]),"soluong"=>$gh["soluong"]]);
          }
          $this->view("chitietdonhang",true,["ctgh"=>$ghinfor,"thanhtien"=>$bill["thanhtien"],"created_at"=>$bill["created_at"]]);
        }
        else header("Location: /");
      }
    }
  }

  public function themtrasua(){
    /**
     * $_FILES là kiểu $_POST của file
     * print_r($_FILES["fileToUpload"]) để xem thêm thuộc tính của nó
     * move_uploaded_file là hàm di chuyển file, nếu thành công sẽ return true, và ngược lại
     */

    if (isset($_SESSION["logged"])){
      if (!$_SESSION["client"]){
        if (isset($_POST['upload'])){
          if (isset($_POST["tenhang"]) &&  isset($_POST["gia"])){
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // print_r($target_file);
            // print_r($_FILES["fileToUpload"]);
            
            if (file_exists($target_file)) {
              $this->view("themtrasua",true,["msg"=>"File da ton tai trong database"]);
              $uploadOk = 0;
            }
      
            // if ($_FILES["fileToUpload"]["size"] > 500000) {
            //   echo "Sorry, your file is too large.";
            //   $uploadOk = 0;
            // }
      
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
              $this->view("themtrasua",true,["msg"=>"File khong phai hinh anh"]);
              $uploadOk = 0;
            }
      
            if ($uploadOk == 0) {
              $this->view("themtrasua",true,["msg"=>"Có lỗi, vui lòng thử lại !"]);
            } 
            else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $hanghoa = $this->model("Hanghoa");
                $hanghoa->add($_POST["tenhang"],$_POST["gia"],$_FILES["fileToUpload"]["name"]);
                $this->view("themtrasua",true,["msg"=>"File img đã được thêm vào folder","done"=>true]);
              } 
              else {
                $this->view("themtrasua",true,["msg"=>"Có lỗi, vui lòng thử lại !"]);
              }
            }
          }
          else $this->view("themtrasua",true,["msg"=>"Vui lòng điền đẩy đủ thông tin !"]);
        }
        else $this->view("themtrasua",true);
      }
      else header("Location: /");
    }
    
  }

  public function xoamon($mh=''){
    if (isset($_SESSION["logged"])){
      if (!$_SESSION["client"]){
        $hanghoa = $this->model("Hanghoa");
        if (strcasecmp("",trim($mh)) == 0){
          $alldrinks = $hanghoa->getAll();
          $this->view("xoamon",true,["alldrinks"=>$alldrinks]);
        }
        else{
          if ($hanghoa->getwithcode($mh) == null){
            header("Location: /xoamon");
          } 
          else{
            $hanghoa->stopSelling($mh);
            header("Location: /xoamon");
          }
        }
      }
    }
  }

  public function moban($mh=''){
    if (isset($_SESSION["logged"])){
      if (!$_SESSION["client"]){
        $hanghoa = $this->model("Hanghoa");
        if (strcasecmp("",trim($mh)) == 0){
          header("Location: /xoamon");
        }
        else{
          if ($hanghoa->getwithcode($mh) == null){
            header("Location: /xoamon");
          } 
          else{
            $hanghoa->startSelling($mh);
            header("Location: /xoamon");
          }
        }
      }
    }
  }

  public function pagenotfound(){
    echo "Page not found";
  }
}