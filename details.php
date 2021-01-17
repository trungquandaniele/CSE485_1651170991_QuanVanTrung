<?php
include("asset/connect.php");
session_start();
//dang ky
if(isset($_POST['reg'])){
  $use=$_POST['use'];
  $pas=$_POST['pas'];
  $ema=$_POST['ema'];
  //kiem tra co trung email hay username khong
  $sql="select email,username from users";
  $result=mysqli_query($conn,$sql);
  $check=true;
  foreach($result as $key => $value){
    if($value['email']==$ema || $value['username']==$use){
      $check=false;
      break;
    }
  }
  if($check){
    $code=rand(100000,999999);
    $pas=password_hash($pas, PASSWORD_DEFAULT);
    $sql="insert into users (email,password,activation_code,username) values ('$ema','$pas','$code','$use')";
    $result=mysqli_query($conn,$sql);
    $sql="select * from users where email='$ema'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    include("asset/Emailer/send.php");
    echo "<br>bạn còn bước cuối là vào email vừa cung cấp để kích hoạt tài khoản.";
  }else
  echo "tên tài khoản hoặc email đã được sử dụng";
}

  //dang nhap
if(isset($_POST['log'])){
$use=$_POST['use'];
$pas=$_POST['pas'];
$sql="select * from users where username='$use'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($result){
echo "truy van thanh cong";
}else{
echo "truy van that bai";
}
print_r($row["password"]);
$t= $row["password"];
echo $t;
if(password_verify($pas,$t) && $row["statu"]==1){
// echo "dung mat khau";
$_SESSION['use']=$use;
header("location:admin/users/");
}else{
echo $pas."   ".$t;
echo "sai mat khau hoac chua kich hoat";

}
} 
//dang xuat
if(isset($_GET['logout'])){
session_destroy();
header('location:/CSE485_1651170912_NguyenThanhGiang-1/');
} 

//lay du lieu tai khoan
$sql="select * from users where userid=123";
$u1=mysqli_query($conn,$sql);
$u=mysqli_fetch_assoc($u1);
// -------------------------------------------
$v=$_GET['id'];
// $sql="select * from post where id=$v";
$sql= "select * from post,users,type_post WHERE post.u_id=users.userid and post.t_id=type_post.t_id and post.id=$v";
$result=mysqli_query($conn,$sql);
$view=mysqli_fetch_assoc($result);
// -----------------------
$tt=$view['t_id'];
         $sql="select * from post a, type_post b where a.t_id=b.t_id and a.t_id=$tt";
         $t="";
         if(isset($_GET['search'])){
             $t=$_GET['sea'];
              $sql='select * from post a, type_post b where a.t_id=b.t_id
              and (a.title like "%'.$t.'%" or a.body like "%'.$t.'%")';
          }
          //chon san pham theo type
         if(isset($_GET['t_id'])){
            $v=$_GET['t_id'];
            $sql="select * from post a, type_post b where a.t_id=b.t_id
            and a.t_id= $v";
        }
         $result=mysqli_query($conn,$sql);
         $sql='select * from type_post';
         $type=mysqli_query($conn,$sql);
//-----------------------------------------
         $sql="select * from post";
         $resul=mysqli_query($conn,$sql);
  
         $conn->close(); 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="asset/css/style.css">
        <title>Document</title>
    </head>

    <body>
    <?php include("include/navbar.php") ?>



    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active bg-dark" style="height:90vh">
      <img class="d-block h-100 mx-auto"  src="asset/image/1610629703-nhieuthietbi.jpg" alt="First slide">
    </div>
    <?php foreach($resul as $key => $value): ?>
    <div class="carousel-item bg-dark" style="height:90vh">
      <img class="d-block h-100 mx-auto" src="asset/image/<?php echo $value['img'] ?>" alt="Second slide">
    </div>
    <?php endforeach;?>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

        <!-- ---------------------------------------------------------------------------------------------------------- -->

        <div class="container">
           
            <div class="row mt-4">
            <div class="col-lg-3">
                    <div class="row">
                        <h5 class="mx-auto">Loại bài</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-4">
                            <div class="card" style="width:100%;">
                                <?php foreach($type as $key =>$value): ?>
                             
                                <a class="btn btn-success border-bottom p-2" href="<?php echo 'blog.php?t_id='.$value['t_id'].'&name='.$value['t_name'] ?>">  <?php echo $value['t_name'] ?></a>
                                <?php endforeach; ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-6">
                            <h5>
                                <?php
                             if(isset($_GET['search'])){
                                echo "Kết quả tìm kiếm : ".$result -> num_rows." bài viết";
                             }
                        ?>
                            </h5>
                        </div>
                        <div class="col-lg-5 col-md-6 col-6">
                        <form class="d-flex" action="blog.php" method="GET" style="height:45px;">
                                <input class="form-control me-2 h-100" type="search" name="sea" placeholder="Bạn muốn tìm..." value="<?php if($t!=" "){echo $t;} ?>" aria-label="Search">
                                <button class="btn btn-outline-success" name="search" type="submit">Tìm</button>
                            </form>
                        </div>

                    </div>

                    <h5 class="mt-4 btn-success p-1"><b>Thông tin bài viết</b></h5>
                    <div class="row mt-4">
                        <div class="col-6"><img src="asset\image\<?php echo $view['img']; ?>" class="w-100" alt=""></div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <?php echo "<b>Tiêu Đề : </b>".$view['title']; ?>
                                </div>
                                <!-- ------------------------- -->
                            </div>
                            <div class="row mt-2 mb-2">
                                <div class="col">
                                    <?php echo "<b>Tác giả : </b>".$view['username']; ?>
                                </div>
                                <!-- ------------------------- -->
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php echo "<b>Ngày đăng : </b>".$view['date']; ?>
                                </div>
                                <!-- ------------------------- -->
                            </div>
                        </div>
                      
                    </div>
                    <div class="row mt-2">
                                <div class="col">
                                    <?php echo "<b>Thông tin chi tiết : </b>".$view['body']; ?>
                                </div>
                                <!-- ------------------------- -->
                        </div>


                    <h5 class="mt-4 btn-success p-1"><b>Những bài viết liên quan</b></h5>
                       <div class="row mb-5">
                        <?php foreach($result as $key => $value): ?>
                        <?php $tt=$value['body'];
                          if(strlen($tt)>45){
                          $tt=mb_substr($tt,0,50);
                          $tt=$tt."...";
                     }
                     if($v!=$value['id']):
                     ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                            <div class="card" style="width:100%;">
                                <img src="<?php echo "asset/image/".$value['img'] ?>" class="card-img-top" height="145px" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $value['title'] ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $tt; ?>
                                    </p>
                                    <a href="details.php?id=<?php echo $value['id'] ?>" class="btn btn-success">Chi tiết</a>
                                </div>
                            </div>

                        </div>
                        <?php 
                           endif;
                          endforeach; ?>
                    </div>





                </div>
            </div>
        </div>









     </div>
        <!-- -------------------------------------------------------------------------------- -->
        <div class="contact" id="contact">
            <div class="container text-center">
                <h1>liên hệ với tôi</h1>
                <p>Chúng tôi tiếp tục cải thiện nội dung và dịch vụ của mình để làm cho trang web của tôi dễ truy cập hơn cho mọi người. Nếu bạn gặp sự cố khi sử dụng trang web của chúng tôi, vui lòng liên hệ với Quản trị viên web để được trợ giúp ở phần dươí</p>
                <div class="row">
                    <div class="col-md-4">
                        <i class="fa fa-phone"></i>
                        <p>+1 <?php echo $u['phone'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <i class="fa fa-envelope"></i>
                        <p><?php echo $u['email'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <i class="fa fa-internet-explorer"></i>
                        <p>www.giang.ga</p>
                    </div>
                </div>
                <button type="button" class="btn btn-primary"><i class="fa fa-download"></i>Resume</button>
                <button type="button" class="btn btn-primary"><i class="fa fa-rocket"></i>Hire me</button>
            </div>
            <div class="footer text-center">
                <p>Tạo ra bởi <i class="fa fa-heart-o"></i>nhóm thiết kế chuyên nghiệp</p>
            </div>
        </div>
        <!-- </section> -->
        <!-- ------------------------------------------------------------ -->
        <!-- dang ky-->
        <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Đăng ký tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="index.php" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Tên tài khoản</label>
                                <input type="text" name="use" class="form-control" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input type="email" name="ema" class="form-control" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="pas" class="form-control" placeholder="Enter Course">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" name="rep" class="form-control" placeholder="Enter Course">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="reg" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>







        <!-- dang nhap -->
        <div class="modal fade" id="studentaddmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Đăng nhập </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="index.php" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label> Tài khoản </label>
                                <input type="text" name="use" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> Mật khẩu </label>
                                <input type="password" name="pas" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="log" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>