<?php
   include("../../include/ad_session.php");
//--------------------------------------------------
    $id="";
    if(isset($_GET['edi'])){
      $_SESSION['edipos']=$_GET['edi'];
    }
    // echo $_SESSION['ediuse'];
    if(isset($_POST['submit'])){
        $a=$_POST['title'];
        $b=$_POST['body'];
        $c=$_POST['id_t'];
        $d=$_SESSION['id'];
        $ev=1;
        if(empty($_POST['check']))
        $ev=0;
      $img="";
      if(!empty($_FILES["img"]["name"])){
        $img=time()."-".$_FILES["img"]["name"];
        $tname=$_FILES['img']['tmp_name'];
        $uploads_dir='../../asset/image/';
        move_uploaded_file($tname,$uploads_dir.'/'.$img);
        $t=$_SESSION['edipos'];
      $sql="update post
      set title='$a',body='$b',img='$img',pulish='$ev',t_id='$c',u_id='$d'
      where id='$t';
      ";
      }else{
        $t=$_SESSION['edipos'];
        $sql="update post
        set title='$a',body='$b',pulish='$ev',t_id='$c',u_id='$d'
        where id='$t'";
      }
      
      $result=mysqli_query($conn,$sql);
    //   echo $sql;
    //   header("location:index.php");
    }
     //hien thi du lieu
     $t=$_SESSION['edipos'];
     $sql="select * from post where id=$t";
     $result=mysqli_query($conn,$sql);
     $r=mysqli_fetch_assoc($result);
     //------------------------------------------------
    $sql='select * from type_post';
    $type=mysqli_query($conn,$sql);

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
                <h4 class="m-3 text-center">Sửa bài viết</h4>
                <div class="container bg-light">
                    <hr>
                    <!-- //================================================================ -->

                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-lg-3 ">
                                <img class="border border-dark" src="<?php echo "../../asset/image/".$r['img']; ?>" width="200px" alt="">
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="form-group mt-2">
                                    <label>Chọn một bức ảnh để thay thế</label>
                                    <input class="form-control" name="img" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="validationDefault01">Tiêu đề</label>
                            <input type="text" class="form-control" name="title" id="validationDefault01" placeholder="..." value="<?php echo $r['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nội dung</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="body"  rows="10"><?php echo $r['body'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Chọn thể loại</label>
                            <select class="custom-select" name="id_t">
                               <!-- <option selected>chọn ở đây</option> -->
                                 <?php foreach($type as $key =>$t): ?>
                                    <?php if($t['t_id']==$r['t_id']): ?>
                                 <option  value="<?php echo $t['t_id'] ?>" selected><?php echo $t['t_name'] ?></option>
                                 <?php else: ?>
                                    <option  value="<?php echo $t['t_id'] ?>"><?php echo $t['t_name'] ?></option>
                                    <?php endif; ?>
                                 <?php endforeach; ?>
                            </select>
                        </div>
               

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" <?php if($r['pulish'])echo "checked" ?> name="check" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1" >Để công khai</label>
                        </div>
                        <button type="submit" name="submit" class="mb-3 btn btn-primary">Sửa bài viết</button>
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