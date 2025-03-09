<?php
session_start();
// Database Connection
include('includes/config.php');

// Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');

require('PHPMailer/SMTP.php');

require('PHPMailer/PHPMailer.php');


if (isset($_REQUEST['Login'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['Message'];

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'avadhradadiya293@gmail.com';
        $mail->Password = 'nxvv aqtu igeh cytg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('avadhradadiya293@gmail.com', $name);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Cruise services organisation';
        $email_template = "Name: $name <br> Email: $email <br> Message: $message";
        $mail->Body = $email_template;

        $mail->send();
     echo "<script>alert('Message has been sent');
     window.location.href='user_query.php?mark_as_read=" . $_GET['mark_as_read'] . "'
     </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cruise Booking System | Add Sub admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once("includes/navbar.php"); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once("includes/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manage Users Queries</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Supports && Request</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <?php
            $said = intval($_GET['mark_as_read']);
            $query = mysqli_query($con, "select * from contact where id='$said'");
            $cnt = 1;
            while ($result = mysqli_fetch_array($query)) {
            ?>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-8">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Fill the Info</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form name="subadmin" method="post" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <!-- Username-->
                                            <div class="form-group">
                                                <label for="exampleInputusername">Name</label>
                                                <input type="text" placeholder="Enter Sub-Admin Username" name="name" id="sadminusername" class="form-control" value="<?php echo $result['name']; ?>" readonly>
                                                <span id="user-availability-status" style="font-size:14px;"></span>
                                            </div>

                                            <!-- User Email---->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="emailid" name="email" placeholder="Enter email" value="<?php echo $result['email']; ?>" readonly>
                                            </div>
                                            <!-- User Contact Number---->
                                            <div class="form-group">
                                                <label for="text">Mobile Number</label>
                                                <input type="number" class="form-control" id="mobilenumber" name="mobile" placeholder="Enter email" value="<?php echo $result['phone']; ?>" readonly>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="message">From Customer Message :</label>
                                                <div class="controls">
                                                    <textarea class="form-control" id="Message" name="Message" value="<?php echo $result['message']?>" rows="5" readonly><?php echo $result['message']?></textarea>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="message">Send Message :</label>
                                                <div class="controls">
                                                    <textarea class="form-control" id="Message" name="Message" placeholder="Please enter your message here..." rows="5"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="Login" id="submit">Send</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!--/.col (left) -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
            <?php } ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once('includes/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>