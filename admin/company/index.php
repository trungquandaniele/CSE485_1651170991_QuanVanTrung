<?php
include("../../include/ad_session.php");
//--------------------------------------------------
   if(isset($_GET['del'])){
    $id=$_GET['del'];
    $sql="delete from company where  c_id=$id";
    $resul=mysqli_query($conn,$sql);
   }
//--------------------------------------------------
// if(isset($_GET['vie'])){
//     $id=$_GET['vie'];
//     $sql="delete from users where userid=$id";
//     $vie=mysqli_query($conn,$sql);
//    }
//--------------------------------------------------
   $sql="select * from company";
   $resul=mysqli_query($conn,$sql);
//    ---------------------------------------------
// $sql="select * from users";
// //  unset($_SESSION['loc']);
//  if(isset($_GET['active']) || isset($_SESSION['loc'])){
//    $_SESSION['loc']=true;
//   $sql="select * from users where status=1";
//  }
//  if(isset($_GET['view'])){
//   unset($_SESSION['loc']);
//   $sql="select * from users";
// }
      $result=mysqli_query($conn,$sql);
      $total=$result->num_rows;
      $item=10;
      $pages=ceil($total/$item);
      // echo "============".$pages;
      $sql="select * from company limit 10";
if(isset($_GET['item'])){
// $item=$_GET['item'];
// $pages=ceil($total/$item);
$page=$_GET['page'];
$off=($page-1)*$item; 
$sql="select * from company limit $item offset $off";
// if(isset($_SESSION['loc'])){
// $sql="select * from users  where status=1 limit $item offset $off";
}
// echo $sql;
$resul=mysqli_query($conn,$sql);
// }else{
// $sql="select * from users limit $item";
// if(isset($_SESSION['loc'])){
// $sql="select * from users  where status=1 limit $item";
// }
// $result=mysqli_query($conn,$sql);
// }   
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
  <?php include "../../include/ad_navbar.php" ?>
<!-- --------------------------------------------------------------- -->
    <div class="row">
    <?php include "../../include/ad_list.php" ?>
<!-- ---------------------------------------------------------------------- -->
<div class="col-lg-10" style="min-height:600px;">
<!-- ---------------------------------------------------------------------- -->



<!-- <h4 class="m-3">Quản lý tài khoản người dùng</h4> -->
<div class="row m-0">
    <a href="create.php" class="btn btn-success m-3">Thêm mới</a>
    <a href="index.php" class="btn btn-success m-3">Xem toàn bộ</a>
</div>
<h4 class="m-3 text-center">Danh sách công ty làm việc</h4>
<div class="container bg-light"><hr>

<div class="row">  
        <div class="col-1"><h6>Id</h6></div>
        <div class="col-2"><h6>Tên</h6></div>
        <!-- <div class="col-3"><h6>Miêu tả</h6></div> -->
        <div class="col-3"><h6>Trụ sở</h6></div>
        <div class="col-2"><h6>Ngày vào</h6></div>
        <div class="col-2"><h6>Ngày ra</h6></div>
        <div class="col-2"><h6>Thao tác</h6></div>
    </div><hr>
    <?php foreach($resul as $key => $v): ?>
    <div class="row">
        <div class="col-1"><h6><?php echo $v['c_id'] ?></h6></div>
        <div class="col-2"><h6><?php echo $v['c_name'] ?></h6></div>
 
        <div class="col-3"><h6><?php echo $v['c_place'] ?></h6></div>
        <div class="col-2"><h6><?php echo $v['c_date1'] ?></h6></div>
        <div class="col-2"><h6><?php echo $v['c_date2'] ?></h6></div>
        <!-- <div class="col-2"><h6>Thao tác</h6></div> -->
        <div class="col-1"><a href="edit.php?edi=<?php echo $v['c_id'] ?>" style="color:orange">Sửa</a></div>
        <div class="col-1"><a href="?del=<?php echo $v['c_id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?');" style="color:red">Xóa</a></div>
        
    </div><hr>
    <?php endforeach; ?>
    <?php include "../../include/pagination.php" ?>
</div>
  
</div>



<!-- ------------------------------------------------------------------------------ -->
</div>
<!-- ------------------------------------------------------------------------------ -->
<!-- </div> -->
<div class="row bg-success p-3"><p>day la chan trang</p></div>








<!--hien thi chi tiet-->
<!-- <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xem tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
                </div>

                <form action="index.php" method="POST">
                    <div class="modal-body">
                      <div class="container">
                        <div class="row"><h6>Tên tài khoản :</h6>  Nguyenthanhgiang</div>
                        <div class="row"><h6>Tên Email :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Số điện thoại :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Địa chỉ 1 :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Địa chỉ 2 :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Thành phố :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Quốc gia :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Zip-code :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Loại tài khoản :</h6> Nguyenthanhgiang</div>
                        <div class="row"><h6>Trạng thái :</h6> Nguyenthanhgiang</div>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>


            </div>
        </div>
    </div> -->





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
          function info(){
            alert("Bạn có chắc muốn xóa");
          }
    <script>
  </body>
</html>