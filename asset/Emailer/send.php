  <?php
      if(isset($_POST['reg'])){
          include('lib/PHPMailerAutoload.php');
     
      $mail = new PHPMailer;
      $mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'giangnt633@gmail.com';                 // SMTP username
$mail->Password = 'giangnt633@gmail1';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;   
$mail->isHTML(true);
$mail->setFrom('giangnt634@gmail.com', 'NguyenThanhGiang');
$mail->addAddress($_POST['ema'],"hello"); 
$mail->Subject = "gui ma xac nhan tu web cua giang";

$mail->Body    = "http://localhost/CSE485_1651170912_NguyenThanhGiang-1/asset/Emailer/active.php?userid=".$row['userid']."&code=".$row['activation_code'].'"';
// $mail->Body    = "Thưa thầy em tên : Nguyễn Thành Giang MSV:1651170912 em gửi email để điểm danh buổi học hôm nay tại lớp 60th5 ạ";
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}
   
  ?>