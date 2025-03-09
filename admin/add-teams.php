<?php
session_start();
// error_reporting(0);
// Database Connection
include('includes/config.php');

// Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
    exit();
}
// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize and validate input data
    $username = mysqli_real_escape_string($con, $_POST['name']);
    $mobile = mysqli_real_escape_string($con, $_POST['manager']);
    $email = mysqli_real_escape_string($con, $_POST['members']);
    $city = mysqli_real_escape_string($con, $_POST['boat_id']);
    $profileImage = ''; // Initialize profile image variable


    // Handle profile image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "uploads/team/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
        }

        $file_name = time() . "_" . basename($_FILES['profile_image']['name']);
        $target_file = $target_dir . $file_name;
        $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_types)) {
            echo "<script>alert('Invalid image format. Allowed: JPG, JPEG, PNG, GIF.');</script>";
            exit();
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $profileImage = $file_name; // Update image if upload succeeds
        } else {
            echo "<script>alert('Failed to upload profile image.');</script>";
            exit();
        }
    }

    // Insert user data into the database
    $query = mysqli_query($con, "INSERT INTO staff (captain_name, manager, members,image,boat_id) 
                                 VALUES ('$username', '$email','$mobile','$profileImage','$city')");

    if ($query) {
        echo "<script>alert('Teams details added successfully.');</script>";
        echo "<script type='text/javascript'> document.location = 'team.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boat Booking System | Add Sub admin</title>

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
                            <h1>Create Teams</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Teams</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

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
                                            <label for="exampleInputusername">Cruise Captain</label>
                                            <input type="text" placeholder="Enter cruise captain name" name="name" id="sadminusername" class="form-control" required>
                                            <span id="user-availability-status" style="font-size:14px;"></span>
                                        </div>

                                        <!-- User Email---->
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Manager:</label>
                                            <input type="text" class="form-control" id="emailid" name="manager" placeholder="Enter manager of Cruise" required>
                                        </div>
                                        <!-- User Contact Number---->
                                        <div class="form-group">
                                            <label for="text">Crew Members</label>
                                            <input type="text" class="form-control" id="mobilenumber" name="members" placeholder="Enter Members" required>
                                        </div>

                                        <!---Password--->
                                        
                                        <!-- User City--->
                                        <div class="form-group">
                                            <label for="exampleInputFullname">Related boat id</label>
                                            <input type="text" class="form-control" id="fullname" name="boat_id" placeholder="Enter Boat Id" required>
                                        </div>
                                        <!-- User image--->
                                        <div class="form-group">
                                            <label for="exampleInputFullname">Upload Profile Image</label>
                                            <input type="file" class="form-control" id="image" name="profile_image" required>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
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