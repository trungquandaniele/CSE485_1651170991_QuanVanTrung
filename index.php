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
          $_SESSION['id']=$row["userid"];
          $_SESSION['adm']=$row["user_level"];
          header("location:admin/users/");
        }else{
          echo $pas."   ".$t;
          echo "sai mat khau hoac chua kich hoat";
        
        }
      } 
      //dang xuat
      if(isset($_GET['logout'])){
        session_destroy();
        header('location:index.php');
      } 
      //lay du lieu bang school
      $sql="select * from school";
      $school=mysqli_query($conn,$sql);
      //lay du lieu bang skill
      $sql="select * from skill";
      $s=mysqli_query($conn,$sql);
      //lay du lieu bang can
      $sql="select * from can";
      $c=mysqli_query($conn,$sql);
      //lay du lieu tai khoan
      $sql="select * from users where userid=123";
      $u1=mysqli_query($conn,$sql);
      $u=mysqli_fetch_assoc($u1);
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
        <title>Thông tin cá nhân</title>
    </head>

    <body>
        <?php include("include/navbar.php") ?>
        <section id="header">
            <div class="container text-center">
                <div class="user-box">
                    <img src="asset/image/<?php echo $u['avata'] ?>" alt="">
                    <h3>
                        <?php echo $u['last_name']." " ?>
                        <?php echo $u['first_name'] ?>
                    </h3>
                    <p><?php echo $u['address2'] ?></p>
                </div>
            </div>
            <div class="social-icons">
                <ul>
                    <a href="#">
                        <li><i class="fa fa-facebook"></i></li>
                    </a>
                    <a href="#">
                        <li><i class="fa fa-twitter"></i></li>
                    </a>
                    <a href="#">
                        <li><i class="fa fa-medium"></i></li>
                    </a>
                    <a href="#">
                        <li><i class="fa fa-github"></i></li>
                    </a>
                    <a href="#">
                        <li><i class="fa fa-behance"></i></li>
                    </a>
                </ul>
            </div>
        </section>
        <p id="about"></p><br>
        <!-- -------------------------thong tin nguoi------------------------------------ -->
        <div class="container mt-2 p-3">
            <!-- <div class="container mt-1"> -->
            <div class="row pt-3" style="background-color:#F8F9FA;">
                <div class="col-lg-6">
                    <h5><b>Thông tin cơ bản</b></h5>
                    <p><b>Họ và Tên : </b>
                        <?php echo $u['last_name']." " ?>
                        <?php echo $u['first_name'] ?>
                    </p>
                    <p><b>Năm sinh : </b>
                        <?php echo $u['city'] ?>
                    </p>
                    <p><b>Email : </b>
                        <?php echo $u['email'] ?>
                    </p>
                    <p><b>Điện thoại : </b>
                        <?php echo $u['phone'] ?>
                    </p>
                    <p><b>Địa chỉ : </b>
                        <?php echo $u['address1'] ?>
                    </p>
                    <p><b>Ngôn ngữ : </b>
                        <?php echo $u['state_country'] ?>
                    </p>
                </div>
                <div class="col-lg-6 ">
                    <h5><b> Suy nghĩ của tôi</b></h5>
                    <p>Lorem ipsum dolor lit simiccusamus fugit debitis adipisci accusantium ipsam dolor, porro nisi nesciunt veritatis itaque! Obcaecati eius sequi, distinctio deserunt aperiam blanditiis, maxime fuga, commodi quod accusantium ad. Culpa
                        dolores error laboriosam velit eum doloribus architecto inventore quis fugit, sint aspernatur quibusdam magnam perspiciatis voluptate aliquam, voluptates provident pariatur adipisci modi blanditiis autem ea impedit. Hic! expedita
                        ab in tempora repellat. Voluptas, vero.</p>
                </div>
            </div>
        </div>

        </div>



        <!-- <div class="container mt-1"> -->
        <div class="container bg-light mb-5">
            <h5 class="text-center p-2 pt-4"><b>KĨ NĂNG</b></h5>
            <div class="row skills-bar">
                <?php foreach($s as $key => $v): ?>
                <div class="col-lg-6 mb-2">
                    <p>
                        <?php echo $v['k_name'] ?>
                    </p>
                    <div class="progress">
                        <div class="progress-bar" style='width:<?php echo $v['k_point'] ?>%;'>
                            <?php echo $v['k_point'] ?>%</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <p id="resume"></p><br>
        </div>
        <div class="container  pt-3" style="background-color:#F8F9FA;">
            <div class="row pr-4">
                <div class="col-md-6">
                    <h3 class="text-center">Kinh nghiệm làm việc</h3>
                    <ul class="timeline">
                        <li>
                            <h4><span>2020 - </span>FPT</h4>
                            <p>Lập trình viên ứng dụng quản lý nhân viên SAP dựa trên ngôn ngữ ABAP với cơ sở dữ liệu SQL
                                <br>
                                <b>Công ty</b> - FPT information system<br>
                                <b>Thời gian</b> - 2019 đến 2020<br>
                                <b>Địa điểm</b> - Tầng 20 tòa nhà kangname
                            </p>
                        </li>
                        <li>
                            <h4><span>2017 - </span>Front End Developer</h4>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis culpa maxime repellat voluptatibus error delectus ut enim sapiente fuga placeat.
                                <br>
                                <b>Company</b> - xyz company Pvt Ltd<br>
                                <b>Duration</b> -1yr [2017 to 2018]<br>
                                <b>Location</b> - Bangalore India
                            </p>
                        </li>
                        <li>
                            <h4><span>2016 - </span>Front End Developer</h4>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis culpa maxime repellat voluptatibus error delectus ut enim sapiente fuga placeat.
                                <br>
                                <b>Company</b> - xyz company Pvt Ltd<br>
                                <b>Duration</b> -1yr [2017 to 2018]<br>
                                <b>Location</b> - Bangalore India
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3 class="text-center">Trường học của tôi</h3>
                    <ul class="timeline">
                        <?php foreach($school as $key => $v): ?>
                        <li>
                            <h4><span><?php echo substr($v['s_date1'],0,4)  ?> - </span>
                                <?php echo $v['s_title'] ?>
                            </h4>
                            <p>
                                <?php echo $v['s_description'] ?>
                                <br>
                                <b>Trường</b>-
                                <?php echo $v['s_name'] ?><br>
                                <b>Thời gian</b>
                                <?php echo substr($v['s_date1'],0,4)  ?> -
                                <?php echo substr($v['s_date2'],0,4)  ?><br>
                                <b>Thành tích </b> -
                                <?php echo $v['s_place'] ?>
                            </p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
<!-- //--------------------------------------------------------------------------- -->
        <p id="services"></p>
        <div class="container bg-light mt-5 pt-3 mb-5 pb-4">
            <!-- <h5 class="text-center p-2"><b>Công việc mà tôi có thể làm</b></h5> -->
            <h5 class="text-center p-2 pt-4"><b>CÔNG VIỆC MÀ TÔI CÓ THỂ LÀM</b></h5>
            <div class="row">
                <?php foreach($c as $key => $v): ?>
                <div class="col-lg-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-4">
                                <img src="asset\image\<?php echo $v['c_image'] ?>"  class="card-img h-100" alt="...">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title"><b><?php echo $v['c_name'] ?></b></h5>
                                    <p class="card-text">
                                        <?php echo $v['c_body'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- -------------------------lien he----------------------------- -->
        <div class="contact" id="contact">
            <div class="container text-center">
                <h1>liên hệ với tôi</h1>
                <p>Chúng tôi tiếp tục cải thiện nội dung và dịch vụ của mình để làm cho trang web của tôi dễ truy cập hơn cho mọi người. Nếu bạn gặp sự cố khi sử dụng trang web của chúng tôi, vui lòng liên hệ với Quản trị viên web để được trợ giúp ở phần
                    dươí
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <i class="fa fa-phone"></i>
                        <p>+1
                            <?php echo $u['phone'] ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <i class="fa fa-envelope"></i>
                        <p>
                            <?php echo $u['email'] ?>
                        </p>
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
        <script src="asset/js/smooth-scroll.js"></script>
        <script>
            var scroll = new SmothScroll('a[href*="#"]');
        </script>
    </body>

    </html>