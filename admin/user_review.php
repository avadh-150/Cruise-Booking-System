<?php session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
} else {
    // Delete review
    if (isset($_GET['del'])) {
        $review_id = intval($_GET['del']);
        $query = mysqli_query($con, "DELETE FROM tblreviews WHERE id='$review_id'");
        if ($query) {
            $msg = "Review deleted successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }

    // Add this after database connection
    $results_per_page = 5; // Number of results per page

    // Get current page
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * $results_per_page;

    // Modify the main query to include pagination
    $query = mysqli_query($con, "SELECT r.*, b.BoatName as BoatName, u.username as username 
                                FROM tblreviews r 
                                JOIN tblboat b ON r.boat_id = b.ID
                                JOIN users u ON r.user_id = u.id
                                ORDER BY r.review_date DESC
                                LIMIT $offset, $results_per_page");

    // Get total number of records for pagination
    $total_records_query = mysqli_query($con, "SELECT COUNT(*) as total FROM tblreviews");
    $total_records = mysqli_fetch_array($total_records_query)['total'];
    $total_pages = ceil($total_records / $results_per_page);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cruise Booking System | Manage Sub Admins</title>

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


            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Manage Users Review & Rating</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">User Review & Rating</li>
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
                                            <h3 class="card-title">Users Review & Rating Details</h3>
                                        </div>
                                        <!-- Success or Error Alert -->
                                        <?php if (isset($msg)) { ?>
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <?php echo $msg; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <?php echo $error; ?>
                                            </div>
                                        <?php } ?>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Boat Name</th>
                                                        <th>Username</th>
                                                        <th>Rating</th>
                                                        <th>Review</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cnt = 1;
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                            <tr>
                                                            <tr>
                                                                <td><?php echo htmlentities($cnt); ?></td>
                                                                <td><?php echo htmlentities($row['BoatName']); ?></td>
                                                                <td><?php echo htmlentities($row['username']); ?></td>
                                                                <td>
                                                                    <div class="star-rating">
                                                                        <?php
                                                                        for ($i = 1; $i <= 5; $i++) {
                                                                            if ($i <= $row['rating']) {
                                                                                echo '<i class="fa fa-star"></i>';
                                                                            } else {
                                                                                echo '<i class="fa fa-star-o"></i>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo htmlentities($row['review_text']); ?></td>
                                                                <td><?php echo htmlentities(date('M j, Y', strtotime($row['review_date']))); ?></td>
                                                                <td><a href="user_review.php?del=<?php echo $row['id']; ?>"
                                                                        onclick="return confirm('Do you really want to delete this review?');">
                                                                        <i class="fa fa-trash" style="color:red"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                    <?php $cnt = $cnt + 1;
                                                        }
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

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

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
                    "paging": false, // Disable DataTables pagination
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>

        <!-- Add this after the table but before the card-body closing div -->
        <div class="d-flex justify-content-center mt-3">
            <ul class="pagination">
                <?php if($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=1">&laquo; First</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php
                // Show 3 pages before and after current page
                for($i = max(1, $page-3); $i <= min($total_pages, $page+3); $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $total_pages; ?>">Last &raquo;</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        
    </body>

    </html>
<?php } ?>