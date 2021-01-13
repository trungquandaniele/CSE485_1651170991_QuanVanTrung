<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <?php
      if(isset($_POST['send'])){
          include('lib/PHPMailerAutoload.php');
      }
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
$mail->addAddress($_POST['email'], $_POST['fullname']); 
$mail->Subject = $_POST['subject'];
$mail->Body    = $_POST['content'];
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}   
  ?>
  <form action="index.php" method="POST" class="col-5 bg-success m-5 p-5">
  <h3>Contact form</h3>
  <div class="form-group">
    <label>Họ tên</label>
    <input type="text" name="fullname" class="form-control">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" >
  </div>
  <div class="form-group">
    <label>Chủ đề</label>
    <input type="text" name="subject" class="form-control">
  </div>

    <label>Nội dung</label>
    <textarea class="form-control mb-4" name="content" aria-label="With textarea"></textarea>
  <button type="submit"  name="send" class="btn btn-primary">Submit</button>
</form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>