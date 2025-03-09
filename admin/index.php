<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['uname']))
  { 
header('location:dashboard.php');
}

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTPDebug;
// Include PHPMailer autoload and database connection
include '../vendor/autoload.php'; // Ensure you have PHPMailer installed via Composer

if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $Password=md5($_POST['inputpwd']);
    $query=mysqli_query($con,"select * from tbladmin where Email='$email' AND Password='$Password' limit 1");
    if (mysqli_num_rows($query) > 0) {
  
        // Generate a random 6-digit OTP
        $otp = rand(100000, 999999);

        // Save the OTP in the database
        $update_query = "UPDATE tbladmin SET otp = ? WHERE Email = ?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, "is", $otp, $email);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Send OTP via email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output for production
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = '@gmail.com'; // Your Gmail address
                $mail->Password   = '';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
                $mail->Port       = 465; // TCP port

                // Recipients
                $mail->setFrom('@gmail.com', 'form cruisebooks.org');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'OTP for Login Authorized Admin';
                $mail->Body    = "Your OTP for Login Authorized Admin: <b>$otp</b>";

                $mail->send();

                $encoded_email = base64_encode($email); // Encode OTP for URL

                $msg = "<div class='alert alert-success'>An OTP has been sent to your email address.
                </div>";
                header('Location: otp_verify.php?email='.$encoded_email.'');

            } catch (Exception $e) {
                $msg = "<div class='alert alert-danger'>Failed to send OTP. Please try again later.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Failed to update OTP. Please try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email address not found.</div>";
    }



    //  header('location:otp_verify.php');
    }
    // else{
    // echo "<script>alert('Invalid Details.');</script>";          
    // }
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boat Booking System | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Admin</b> |  Cruise Booking</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Emter Email" name="email"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="inputpwd"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
   
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
         <p class="mb-1"><i class="fas fa-home"></i>
        <a href="../index.php">Home</a>
      </p>
      </form>


      <p class="mb-1">
        <a href="password-recovery.php">I forgot my password</a>
      </p>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<?php //}?>