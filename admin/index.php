<?php
session_start();
include('includes/config.php');

if(isset($_SESSION['uname'])) { 
    header('location:dashboard.php');
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include '../vendor/autoload.php';

$msg = '';

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = md5($_POST['inputpwd']);
    
    $query = mysqli_prepare($con, "SELECT * FROM tbladmin WHERE Email=? AND Password=? LIMIT 1");
    mysqli_stmt_bind_param($query, "ss", $email, $password);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    
    if (mysqli_num_rows($result) > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Update OTP in database
        $update_query = mysqli_prepare($con, "UPDATE tbladmin SET otp = ? WHERE Email = ?");
        mysqli_stmt_bind_param($update_query, "is", $otp, $email);
        
        if (mysqli_stmt_execute($update_query)) {
            // Send OTP via email
            $mail = new PHPMailer(true);
            
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'saximendapra@gmail.com';
                $mail->Password = 'mtqd xttn xswu bwpq';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                // Recipients
                $mail->setFrom('saximendapra@gmail.com', 'Cruise Booking Admin');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Login OTP Verification';
                $mail->Body = "
                    <h2>OTP Verification</h2>
                    <p>Your OTP for admin login verification is: <strong>{$otp}</strong></p>
                    <p>This OTP will expire in 10 minutes.</p>
                    <p>If you didn't request this OTP, please ignore this email.</p>
                ";

                $mail->send();
                $encoded_email = base64_encode($email);
                header('Location: otp_verify.php?email='.$encoded_email);
                exit();

            } catch (Exception $e) {
                $msg = "<div class='alert alert-danger'>Email sending failed. Please try again later.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>System error. Please try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Invalid email or password.</div>";
    }
}
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
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="index.php" class="h1"><b>Admin</b> | Cruise Booking</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            
            <?php if($msg) echo $msg; ?>

            <form method="post" id="loginForm">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="inputpwd" required 
                           minlength="6">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <a href="../index.php"><i class="fas fa-home"></i> Home</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                    </div>
                </div>
            </form>

            <p class="mt-3">
                <a href="password-recovery.php">I forgot my password</a>
            </p>
        </div>
    </div>
</div>
<!-- /.login-logo -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="inputpwd"]').value;
    
    if (!email || !password) {
        e.preventDefault();
        alert('Please fill in all fields');
        return false;
    }
    
    if (password.length < 6) {
        e.preventDefault();
        alert('Password must be at least 6 characters long');
        return false;
    }
});
</script>

</body>
</html>
<?php //}?>