<?php 
//  $conn=mysqli_connect("localhost","root","","thuchanh4");
include("../connect.php");
$use=$_GET['userid'];
$cod=$_GET['code'];
 
      
  $sql="select * from users where userid='$use' and activation_code='$cod'";
  $result=mysqli_query($conn,$sql);
      
    if ($result) 
    { 
        $row = mysqli_num_rows($result); 
          
           if ($row) 
              { 
                $sql="UPDATE users
                    SET statu = 1
                     WHERE userid='$use' and activation_code='$cod'";
                $result=mysqli_query($conn,$sql);
                echo "bạn đã kích hoạt thành công";

              } 
    } 
    mysqli_close($conn); 
?> 
