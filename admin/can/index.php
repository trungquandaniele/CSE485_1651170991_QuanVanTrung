<?php
  include("../../include/ad_session.php");
//--------------------------------------------------
   if(isset($_GET['del'])){
    $id=$_GET['del'];
    $sql="delete from can where c_id=$id";
    $resul=mysqli_query($conn,$sql);
   }
//--------------------------------------------------
   $sql="select * from can";
   $resul=mysqli_query($conn,$sql);
//    ---------------------------------------------
      $result=mysqli_query($conn,$sql);
      $total=$result->num_rows;
      $item=10;
      $pages=ceil($total/$item);
      $sql="select * from can limit 10";
//    ---------------------------------------------
if(isset($_GET['item'])){
$page=$_GET['page'];
$off=($page-1)*$item; 
$sql="select * from can limit $item offset $off";
}
$resul=mysqli_query($conn,$sql);
//-----------------------------------------------------------
      if(isset($_GET['logout'])){
        session_destroy();
        header('location:/CSE485_1651170912_NguyenThanhGiang-1/');
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
        <!-- -------------------------lien he----------------------------- -->

        <?php include "../../include/ad_navbar.php" ?>
        <!-- --------------------------------------------------------------- -->
        <div class="row">
 
            <?php include "../../include/ad_list.php" ?>
            <!-- ---------------------------------------------------------------------- -->
            <div class="col-lg-10" style="min-height:600px;">
                <!-- ---------------------------------------------------------------------- -->
                <?php include "../../include/ad_button.php" ?>
                <h4 class="m-3 text-center">Danh sách công việc làm được</h4>
                <div class="container bg-light">
                    <hr>

                    <div class="row">
                        <div class="col-1">
                            <h6>Id</h6>
                        </div>
                        <div class="col-2">
                            <h6>Tên công việc</h6>
                        </div>
                        <div class="col-4">
                            <h6>Mô tả</h6>
                        </div>
                        <div class="col-2">
                            <h6>Hình ảnh</h6>
                        </div>
                        <div class="col-3">
                            <h6>Thao tác</h6>
                        </div>
                    </div>
                    <hr>
                    <?php foreach($resul as $key => $v): ?>
                    <div class="row">
                        <div class="col-1">
                            <?php echo $v['c_id'] ?>
                        </div>
                        <div class="col-2">
                            <?php echo $v['c_name'] ?>
                        </div>
                        <div class="col-4">
                        <?php echo $v['c_body'] ?>
                        </div>
                        <div class="col-2">
                        <img src="..\..\asset\image\<?php  echo $v['c_image'];  ?>" class="w-100" alt="">
                        </div>
                        <div class="col-1"><a href="edit.php?edi=<?php echo $v['c_id'] ?>" style="color:orange">Sửa</a></div>
                        <div class="col-1"><a href="?del=<?php echo $v['c_id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?');" style="color:red">Xóa</a></div>
                    </div>
                    <hr>
                    <?php endforeach; ?>
                    <?php include "../../include/pagination.php" ?>
                </div>

            </div>



            <!-- ------------------------------------------------------------------------------ -->
        </div>
        <!-- ------------------------------------------------------------------------------ -->
        <?php include "../../include/ad_footer.php" ?>
        <script>
            function info() {
                alert("Bạn có chắc muốn xóa");
            }
        </script>
    </body>

    </html>