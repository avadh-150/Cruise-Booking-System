<?php session_start();
// Database Connection
include('includes/config.php');

//Validating Session
if(strlen($_SESSION['aid']) == 0) { 
    header('location:index.php');
} else {
    if(isset($_POST['submit'])) {
        // Getting Post Values  
        $eid = intval($_GET['bid']);
        $boatname = mysqli_real_escape_string($con, $_POST['boatname']);
        $size = mysqli_real_escape_string($con, $_POST['size']);
        $capacity = mysqli_real_escape_string($con, $_POST['capacity']);
        $source = mysqli_real_escape_string($con, $_POST['source']);
        $destination = mysqli_real_escape_string($con, $_POST['destination']);
        $route = mysqli_real_escape_string($con, $_POST['route']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $arrival = mysqli_real_escape_string($con, $_POST['arrival']);
        $departure = mysqli_real_escape_string($con, $_POST['departure']);
        $addedby = mysqli_real_escape_string($con, $_SESSION['aid']);
        $executive = mysqli_real_escape_string($con, $_POST['executive']);
        $business = mysqli_real_escape_string($con, $_POST['business']);
        $room_cabin = mysqli_real_escape_string($con, $_POST['room_cabin']);
        $sleeper = mysqli_real_escape_string($con, $_POST['sleeper']);
        
        $query = "UPDATE tblboat SET 
            BoatName='$boatname', 
            Size='$size', 
            Capacity='$capacity',
            Source='$source', 
            Destination='$destination', 
            Route='$route', 
            Price='$price', 
            arrival_time='$arrival', 
            departure_time='$departure', 
            Description='$description', 
            AddedBy='$addedby',
            executive='$executive',
            business='$business',
            room_cabin='$room_cabin',
            sleeper='$sleeper'
            WHERE ID = $eid";
        
        $result = mysqli_query($con, $query);
        // echo $query;
        // exit;
        
        // Check if the query was successful
        if($result) {
            echo "<script>alert('Boat detail updated successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'manage-boat.php'; </script>";
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
  <title>Boat Booking System  | Update Boat</title>

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Boat</h1>
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
                <h3 class="card-title">Update Boat Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <?php 
$bid=$_GET['bid'];
$query = mysqli_query($con, "SELECT * FROM tblboat WHERE ID='$bid'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>
                <div class="card-body">


   <div class="form-group">
                    <label for="exampleInputFullname">Name of Boat</label>
                    <input type="text" class="form-control" id="boatname" name="boatname" value="<?php echo $result['BoatName'];?>" required>
                  </div>

              <div class="form-group">
                  <label for="exampleInputFullname">Old Image</label>
                  <img src="images/<?php echo $result['Image'];?>" width="100" height="100"><a href="change-image.php?id=<?php echo $result['ID'];?>">Edit Image</a>
              </div>
                <div class="form-group">
                    <label for="exampleInputFullname">Old inside Image 1</label>
                    <img src="images/<?php echo $result['image1'];?>" width="100" height="100"><a href="change-image.php?id=<?php echo $result['ID'];?>">Edit Image</a>
                </div>
                <div class="form-group">
                    <label for="exampleInputFullname">Old inside Image 2</label>
                    <img src="images/<?php echo $result['image2'];?>" width="100" height="100"><a href="change-image.php?id=<?php echo $result['ID'];?>">Edit Image</a>
                </div>
                <div class="form-group">
                    <label for="exampleInputFullname">Old inside Image 3</label>
                    <img src="images/<?php echo $result['image3'];?>" width="100" height="100"><a href="change-image.php?id=<?php echo $result['ID'];?>">Edit Image</a>
                </div>
                
                
                   <div class="form-group">
                    <label for="exampleInputFullname">Size</label>
                    
                    <select class="form-control" name="size" required>
                      <option value="<?php echo $result['Size'];?>"><?php echo $result['Size'];?></option>
                      <option value="Small">Small</option>
                      <option value="Medium">Medium</option>
                      <option value="Large">Large</option>

                     </select>
                  </div>

<div class="form-group">
                    <label for="exampleInputFullname">Capacity of Person</label>
                    <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $result['Capacity'];?>" required>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputFullname">Source</label>
                    <input type="text" class="form-control" id="source" name="source" value="<?php echo $result['Source'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFullname">Destination</label>
                    <input type="text" class="form-control" id="destination" name="destination"value="<?php echo $result['Destination'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFullname">Route</label>
                    <input type="text" class="form-control" id="route" name="route" value="<?php echo $result['Route'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFullname">Price Per Person</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $result['Price'];?>" required>
                  </div>
                  <div class="form-group">
                        <label for="exampleInputFullname">arrival</label>
                        <input type="datetime-local" class="form-control" id="route" name="arrival" placeholder="Enter Route" value="<?php echo $result['arrival_time'];?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFullname">departure</label>
                        <input type="datetime-local" class="form-control" id="route" name="departure" placeholder="Enter Route" value="<?php echo $result['departure_time'];?>" required>
                      </div>

                <div class="form-group">
                    <label for="exampleInputFullname">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description of Boat" required><?php echo $result['Description'];?></textarea>
                  </div>
                <div class="form-group">
                    <label for="exampleInputFullname">Executive Class Price (per person)</label>
                    <input type="number" class="form-control" id="executive" name="executive" placeholder="Enter Price" value="<?php echo $result['executive'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFullname">Business Class Price (per person)</label>
                    <input type="number" class="form-control" id="business" name="business" placeholder="Enter Price" value="<?php echo $result['business'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFullname">Room/Cabin Price (per person)</label>
                    <input type="number" class="form-control" id="room_cabin" name="room_cabin" placeholder="Enter Price" value="<?php echo $result['room_cabin'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFullname">Sleeper Class Price (per person)</label>
                    <input type="number" class="form-control" id="sleeper" name="sleeper" placeholder="Enter Price" value="<?php echo $result['sleeper'];?>" required>
                  </div>
<?php } ?>

  <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
                </div>
      
                </div>
                <!-- /.card-body -->
          
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->








    
              </form>
       
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

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
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
</script>
</body>
</html>
<?php } ?>
