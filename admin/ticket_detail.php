<?php session_start();
//error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
} else {

    // if (isset($_POST['submit'])) {
    //     $bid = intval($_GET['bid']);
    //     $estatus = $_POST['status'];
    //     $oremark = $_POST['officialremak'];

    //     $query = mysqli_query($con, "update tblbookings set AdminRemark='$oremark',BookingStatus='$estatus' where ID='$bid'");

    //     if ($query) {
    //         echo "<script>alert('Booking Details Updated   successfully.');</script>";
    //         echo "<script type='text/javascript'> document.location = 'all-booking.php'; </script>";
    //     } else {
    //         echo "<script>alert('Something went wrong. Please try again.');</script>";
    //     }
    // }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cruise Booking System | Booking Details</title>

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
            <!-- Navbar -->
            <?php include_once("includes/navbar.php"); ?>
            <!-- /.navbar -->

            <?php include_once("includes/sidebar.php"); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Ticket Details</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">Ticket Details</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">


                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Ticket Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">

                                                <tbody>

                                                    <?php

                                                    include "includes/config.php";
                                                    $bid = $_GET['bid'];
                                                    $query = mysqli_query($con, "select * from ticket where txn_id='$bid'");
                                                    $cnt = 1;
                                                    while ($result = mysqli_fetch_array($query)) {
                                                    ?>


                                                        <tr>
                                                            <th>Payment Transaction ID</th>
                                                            <td colspan="3"><?php echo $result['txn_id'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th> Ticket Number</th>
                                                            <td><?php echo $result['ticket_number'] ?></td>
                                                            <th>Login User Email</th>
                                                            <td> <?php echo $result['login_email'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Passenger Name </th>
                                                            <td><?php echo $result['passenger_name'] ?></td>
                                                            <th>No of Peoples</th>
                                                            <td><?php echo $result['number_of_passengers'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Class</th>
                                                            <td><?php echo $result['class'] ?> To </td>
                                                            <th>Passenger Email</th>
                                                            <td><?php echo $result['email'] ?></td>

                                                        </tr>
                                                        <tr>
                                                            <th>Price</th>
                                                            <td><?php echo $result['price'] ?></td>
                                                            <th>Boat Number</th>
                                                            <td><?php echo $result['boat_id'] ?> <a href='edit-boat.php?bid=<?php echo $result['boat_id']; ?>'> View Details</a></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Booking Date</th>
                                                            <td><?php echo $result['issue_date'] ?></td>
                                                            <th>Boat Number</th>
                                                            <td><?php echo $result['booking_id'] ?> </td>
                                                        </tr>



                                                      
                                                        <?php $cnt++;
                                                    } ?>

                                                </tbody>

                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include_once('includes/footer.php'); ?>


        </div>
        <!-- ./wrapper -->


        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Booking Satus</h4>
                    </div>
                    <div class="modal-body">
                        <form name="takeaction" method="post">

                            <p><select class="form-control" name="status" id="status" required>
                                    <option value="">Select Booking Status</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Rejected">Rejected</option>
                                </select></p>

                            <p><textarea class="form-control" name="officialremak" placeholder="Official Remark" rows="5" required></textarea></p>
                            <input type="submit" class="btn btn-primary" name="submit" value="update">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
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
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
        <script type="text/javascript">
            //For report file
            $('#rtable').hide();
            $(document).ready(function() {
                $('#status').change(function() {
                    if ($('#status').val() == 'Accepted') {
                        $('#rtable').show();
                        jQuery("#table").prop('required', true);
                    } else {
                        $('#rtable').hide();
                    }
                })
            })
        </script>
    </body>

    </html>
<?php } ?>