<?php
 include("../../include/ad_session.php");
//--------------------------------------------------
    if(isset($_POST['submit'])){
      $avata=$_POST['first_name'];
      $fname=$_POST['first_name'];
      $lname=$_POST['last_name'];
      $username=$_POST['username'];
      $email=$_POST['email'];
      $phone=$_POST['phone'];
      $pass=$_POST['password'];
      $add1=$_POST['address1'];
      $add2=$_POST['address2'];
      $city=$_POST['city'];
      $country=$_POST['country'];
      $zip=$_POST['zip'];
      $level=1;
      if(empty($_POST['level']))
      $level=0;
      $status=1;
      if(empty($_POST['status']))
      $status=0;
      $img="";
      $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
      if(!empty($_FILES["img"]["name"])){
        $img=time()."-".$_FILES["img"]["name"];
        $tname=$_FILES['img']['tmp_name'];
        $uploads_dir='../asset/image/';
        move_uploaded_file($tname,$uploads_dir.'/'.$img);
        // echo $img."=====================1\n";
      }
      // echo $img."=====================2\n";
      $sql="INSERT INTO users (first_name,last_name ,email,"."password".",user_level,address1,address2,city,state_country,phone,statu,avata,username) VALUES ('$fname','$lname','$email','$password','$level','$add1','$add2','$city','$country','$phone',$status,'$img','$username')";
      $result=mysqli_query($conn,$sql);
      // echo $sql;
      
      header("location:index.php");
    }

?>
<!doctype html>
<html lang="en">
  <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="../../asset/css/style.css">
        <title>Thông tin cá nhân</title>
  </head>
  <body>
  <?php include "../../include/ad_navbar.php" ?>
<!-- --------------------------------------------------------------- -->
    <div class="row">
    <?php include "../../include/ad_list.php" ?>
<!-- ---------------------------------------------------------------------- -->
<div class="col-lg-10" style="min-height:600px;">
<!-- ---------------------------------------------------------------------- -->




<div class="row m-0">
<a href="create.php" class="btn btn-success m-3">Thêm mới</a>
    <a href="index.php" class="btn btn-success m-3">Xem toàn bộ</a>
</div>
<h4 class="m-3 text-center">Thêm tài khoản người dùng</h4>
<div class="container bg-light"><hr>
<!-- //================================================================ -->

<form action="create.php" method="post" enctype="multipart/form-data">
<div class="form-group mt-2">
  <label>Chọn một bức ảnh</label>
  <input class="form-control" name="img" type="file" id="formFile">
</div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Tên</label>
      <input type="text" class="form-control" name="first_name" id="validationDefault01" placeholder="..." >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Họ và đệm</label>
      <input type="text" class="form-control" name="last_name" id="validationDefault02" placeholder="..." >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Tên tài khoản</label>
      <div class="input-group">
        <input type="text" class="form-control" name="username" placeholder="..." required>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
    <label for="inputEmail4">Email</label>
      <input type="email" class="form-control"  name="email" placeholder="..."><!-- id="inputEmail4"  required-->
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Số điện thoại</label>
      <input type="number" class="form-control" id="validationDefault02" name="phone" placeholder="..." value="Otto">
    </div>
    <!-- <div class="col-md-4 mb-3"> -->
    <div class="form-group col-md-4 mb-3">
      <label for="inputPassword4">Mật khẩu</label>
      <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="..." required>
    </div>
    <!-- </div> -->
  </div>
  <div class="form-group">
    <label for="inputAddress">Địa chỉ</label>
    <input type="text" class="form-control" id="inputAddress" name="address1" placeholder="...">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Địa chỉ 2</label>
    <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="...">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Thành phố</label>
      <input type="text" class="form-control" id="inputCity" name="city" placeholder="...">
    </div>
    <div class="form-group col-md-4">
    <label for="inputCity">Quốc gia</label>
      <input type="text" class="form-control" id="inputCity" name="country" placeholder="...">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" name="zip" id="inputZip" placeholder="...">
    </div>
  </div>
  <div class="row">
  <div class="col-3">
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" name="level" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Tài khoản quản trị
      </label>
    </div>
  </div>
  </div>
  <div class="col-4">
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" name="status"  type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Kích hoạt tài khoản
      </label>
    </div>
  </div>
  </div>
  </div>
 
  
  <button type="submit" name="submit" class="mb-3 btn btn-primary">Tạo tài khoản</button>
</form>
<!-- //================================================================ -->
   
</div>
  
</div>



<!-- ------------------------------------------------------------------------------ -->
</div>
<!-- ------------------------------------------------------------------------------ -->
<!-- </div> -->
<?php include "../../include/ad_footer.php" ?>
  </body>
</html>