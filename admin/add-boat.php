<?php
session_start();
// Database Connection
include('includes/config.php');

// Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        // Getting Post Values  
        $boatname = mysqli_real_escape_string($con, $_POST['boatname']);
        $size = mysqli_real_escape_string($con, $_POST['size']);
        $arrival = mysqli_real_escape_string($con, $_POST['arrival']);
        $departure = mysqli_real_escape_string($con, $_POST['departure']);
        $capacity = mysqli_real_escape_string($con, $_POST['capacity']);
        $source = mysqli_real_escape_string($con, $_POST['source']);
        $destination = mysqli_real_escape_string($con, $_POST['destination']);
        $route = mysqli_real_escape_string($con, $_POST['route']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $executive = mysqli_real_escape_string($con, $_POST['executive']);
        $business = mysqli_real_escape_string($con, $_POST['business']);
        $room_cabin = mysqli_real_escape_string($con, $_POST['room_cabin']);
        $sleeper = mysqli_real_escape_string($con, $_POST['sleeper']);
        $addedby = $_SESSION['aid'];

        // File upload handling
        $upload_dir = "images/";
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $boat_images = [];

        for ($i = 0; $i < 4; $i++) {
            $input_name = "image" . ($i == 0 ? "" : $i); // image, image1, image2, image3
            if (!empty($_FILES[$input_name]['name'])) {
                $file_name = $_FILES[$input_name]['name'];
                $file_tmp = $_FILES[$input_name]['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (in_array($file_ext, $allowed_extensions)) {
                    $new_file_name = md5($file_name . time()) . "." . $file_ext;
                    if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                        $boat_images[] = $new_file_name;
                    } else {
                        echo "<script>alert('Failed to upload an image. Please try again.');</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
                    exit;
                }
            } else {
                $boat_images[] = ''; // Placeholder in case of missing images
            }
        }

        // Insert data into database
        $query = mysqli_query($con, "INSERT INTO tblboat (BoatName, Image, Size, Capacity, Source, Destination, Route, Price, arrival_time, departure_time, Description, AddedBy, image1, image2, image3, executive, business, room_cabin, sleeper) 
            VALUES ('$boatname', '$boat_images[0]', '$size', '$capacity', '$source', '$destination', '$route', '$price', '$arrival', '$departure', '$description', '$addedby', '$boat_images[1]', '$boat_images[2]', '$boat_images[3]', '$executive', '$business', '$room_cabin', '$sleeper')");

        if ($query) {
            echo "<script>alert('Cruise detail added successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'add-boat.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boat Booking System  | Manage Boat</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>


<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include_once("includes/navbar.php"); ?>
    <?php include_once("includes/sidebar.php"); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Boat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Boat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Boat Details</h3>
                            </div>

                            <form method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name of Boat</label>
                                        <input type="text" class="form-control" name="boatname" placeholder="Enter Name of Boat" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Image of Cruise</label>
                                        <input type="file" class="form-control" name="image" required>
                                        <label>Image of Inside Cruise</label>
                                        <input type="file" class="form-control" name="image1">
                                        <input type="file" class="form-control" name="image2">
                                        <input type="file" class="form-control" name="image3">
                                    </div>

                                    <div class="form-group">
                                        <label>Size</label>
                                        <select class="form-control" name="size" required>
                                            <option value="">Choose Size</option>
                                            <option value="Small">Small</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Large">Large</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Capacity</label>
                                        <input type="number" class="form-control" name="capacity" placeholder="Enter Capacity" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Price Per Person</label>
                                        <input type="number" class="form-control" name="price" placeholder="Enter Price" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Source</label>
                                        <input type="text" class="form-control" name="source" placeholder="Enter Source" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Destination</label>
                                        <input type="text" class="form-control" name="destination" placeholder="Enter Destination" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Route</label>
                                        <input type="text" class="form-control" name="route" placeholder="Enter Route" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Arrival</label>
                                        <input type="datetime-local" class="form-control" name="arrival" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Departure</label>
                                        <input type="datetime-local" class="form-control" name="departure" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label> Executive Class Price</label>
                                        <input type="number" class="form-control" name="executive" placeholder="Enter Price" required>
                                    </div>
                                    <div class="form-group">
                                          <label>Business Class Price</label>
                                        <input type="number" class="form-control" name="business" placeholder="Enter Price" required>
                                    </div>
                                    <div class="form-group">
                                          <label>Room/Cabin Price</label>
                                        <input type="number" class="form-control" name="room_cabin" placeholder="Enter Price" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sleeper Class Price</label>
                                        <input type="number" class="form-control" name="sleeper" placeholder="Enter Price" required>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
    </div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
</div>
</body>
</html>
