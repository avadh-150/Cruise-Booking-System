<?php
include 'includes/config.php';
session_start();
?>
<?php
if ($_GET['tid'] && $_GET['card'] == 'Yes' && $_GET['bid']) {
    $tid = $_GET['tid'];
    $bid = $_GET['bid'];
    $sql = "SELECT * FROM tblpayment WHERE txn_id='$tid'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $title = 'Payment Successful';
        $response = '<div class="panel-body">
                        <i class="fa fa-check-circle text-success"></i>
                        <h3>Payment Successful</h3>
                        <p>Your ticket has been sent to your email address.</p>
                        <a href="' . $hostname . '" class="btn btn-md btn-primary">Enjoy your ferry ride</a>
                     </div>';
    } else {
        $title = 'Payment Unsuccessful';
        $response = '<div class="panel-body">
                        <i class="fa fa-times-circle text-danger"></i>
                        <h3>Payment Unsuccessful</h3>
                        <a href="' . $hostname . '" class="btn btn-md btn-primary">Try Again</a>
                     </div>';
    }
} else {
    $title = 'Payment Unsuccessful';
    $response = '<div class="panel-body">
                    <i class="fa fa-times-circle text-danger"></i>
                    <h3>Payment Unsuccessful</h3>
                    <a href="' . $hostname . '" class="btn btn-md btn-primary">Try Again</a>
                 </div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
</head>
<body>
    <div class="payment-response">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
                        <?php echo $response; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="alert alert-success">
            <strong>Success!</strong> Payment has been successful
        </div>

        <table id="ticketDetails" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Booking Number</th>
                    <th>Transaction ID</th>
                    <th>Ticket Number</th>
                    <th>Passenger Name</th>
                    <th>Login Email</th>
                    <th>Price</th>
                    <th>Boat Number</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Number of Passengers</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tid1 = $_GET['tid'];
                $user = $_SESSION['email'];
                $sql1 = "SELECT * FROM ticket WHERE txn_id='$tid' AND login_email='$user'";
                $result2 = mysqli_query($con, $sql1);
                if ($result2) {
                    foreach ($result2 as $row3) {
                        echo "<tr>
                                <td>{$row3['booking_id']}</td>
                                <td>{$row3['txn_id']}</td>
                                <td>{$row3['ticket_number']}</td>
                                <td>{$row3['passenger_name']}</td>
                                <td>{$_SESSION['email']}</td>
                                <td>₹{$row3['price']}</td>
                                <td>{$row3['boat_id']}</td>
                                <td>{$row3['email']}</td>
                                <td>{$row3['class']}</td>
                                <td>{$row3['number_of_passengers']}</td>
                             </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#ticketDetails').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#ticketDetails_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>
</html>
