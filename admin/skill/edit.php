<?php
   include("../../include/ad_session.php");
//--------------------------------------------------
    $id="";
    if(isset($_GET['edi'])){
      $_SESSION['ediski']=$_GET['edi'];
    }
    $t=$_SESSION['ediski'];
    // echo $_SESSION['ediuse'];
    if(isset($_POST['submit'])){
      $a=$_POST['c_name'];
      $f=$_POST['c_place'];

        $t=$_SESSION['ediski'];
        $sql="update skill
        set  k_name='$a',k_point='$f'
        where k_id=$t;
        ";
       $result=mysqli_query($conn,$sql);
      header("location:index.php");
    }
     //hien thi du lieu
  
     $sql="select * from skill where k_id=$t";
     $result=mysqli_query($conn,$sql);
     $r=mysqli_fetch_assoc($result);

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
<h4 class="m-3 text-center">Sửa kĩ năng</h4>
<div class="container bg-light"><hr>
<!-- //================================================================ -->

<form  action="edit.php" method="post" >
  <div class="form-group mt-2">
    <label for="exampleInputEmail1">Tên kĩ năng</label>
    <input type="text" class="form-control" name="c_name" aria-describedby="emailHelp" value="<?php echo $r["k_name"] ?>" required>
  </div>
<div class="form-group mt-2">
    <label for="exampleInputEmail1">Điểm số</label>
    <input type="number" class="form-control" name="c_place" aria-describedby="emailHelp" value="<?php echo $r['k_point'] ?>" required>
  </div>
  <input type="submit" class="btn btn-primary mt-2 mb-4" name="submit" value="Submit"></input>
</form>
</div>
  
</div>



<!-- ------------------------------------------------------------------------------ -->
</div>
<!-- ------------------------------------------------------------------------------ -->
<!-- </div> -->
<?php include "../../include/ad_footer.php" ?>
  </body>
</html>