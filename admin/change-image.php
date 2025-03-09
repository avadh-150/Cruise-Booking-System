<?php
session_start();
// Database Connection
include('includes/config.php');

// Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
    exit();
}

if (isset($_POST['submit'])) {
    // Getting Post Values  
    $eid = intval($_GET['id']);
    $addedby = $_SESSION['aid'];

    // Function to handle image upload
    function uploadImage($file, $prefix) {
        $image = $file['name'];
        $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extension, $allowedExtensions)) {
            return false; // Invalid file type
        }

        $newImageName = $prefix . '_' . md5($image) . time() . '.' . $extension;
        $uploadPath = "images/" . $newImageName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $newImageName;
        } else {
            return false; // Upload failed
        }
    }

    // Update main image
    if (!empty($_FILES['image']['name'])) {
        $boatimage = uploadImage($_FILES['image'], 'boat');
        if ($boatimage) {
            $query = "UPDATE tblboat SET Image='$boatimage' WHERE ID = $eid";
            mysqli_query($con, $query);
        } else {
            echo "<script>alert('Invalid image format for main image. Allowed formats: jpg, jpeg, png, gif.');</script>";
        }
    }

    // Update inside images
    $insideImages = ['image1', 'image2', 'image3'];
    foreach ($insideImages as $imageField) {
        if (!empty($_FILES[$imageField]['name'])) {
            $insideImage = uploadImage($_FILES[$imageField], $imageField);
            if ($insideImage) {
                $query = "UPDATE tblboat SET $imageField='$insideImage' WHERE ID = $eid";
                mysqli_query($con, $query);
            } else {
                echo "<script>alert('Invalid image format for $imageField. Allowed formats: jpg, jpeg, png, gif.');</script>";
            }
        }
    }

    echo "<script>alert('Boat images updated successfully.');</script>";
    echo "<script>document.location = 'manage-boat.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boat Booking System | Update Boat</title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
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
            <h1>Update Boat Image</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Update Boat</li>
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
                <h3 class="card-title">Update Boat Image</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <?php
                $bid = intval($_GET['id']);
                $query = mysqli_query($con, "SELECT * FROM tblboat WHERE ID='$bid'");
                $result = mysqli_fetch_assoc($query);
                ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputFullname">Name of Boat</label>
                    <input type="text" class="form-control" id="boatname" name="boatname" value="<?php echo htmlspecialchars($result['BoatName']); ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFullname">Old Image</label>
                    <img src="images/<?php echo htmlspecialchars($result['Image']); ?>" width="200" height="200">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFullname">New Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFullname">Old Inside Image 1</label>
                    <img src="images/<?php echo htmlspecialchars($result['image1']); ?>" width="100" height="100">
                    <input type="file" class="form-control" id="image1" name="image1">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFullname">Old Inside Image 2</label>
                    <img src="images/<?php echo htmlspecialchars($result['image2']); ?>" width="100" height="100">
                    <input type="file" class="form-control" id="image2" name="image2">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFullname">Old Inside Image 3</label>
                    <img src="images/<?php echo htmlspecialchars($result['image3']); ?>" width="100" height="100">
                    <input type="file" class="form-control" id="image3" name="image3">
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
                  </div>
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

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>