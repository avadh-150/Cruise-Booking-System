<?php 
session_start();
// Database Connection
include('includes/config.php');
include "configuration.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Boat Booking System || Booking Status</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <?php include_once("includes/navbar.php"); ?>

        <br><br><br><br>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <h3>Verify the details before proceeding to payment</h3>
<br><br><br>
                    <?php 
                    if (isset($_GET['bookingno']) && isset($_GET['boatid'])) {

                        $booking_no = $_GET['bookingno'];
                        $id = $_GET['boatid'];
                    ?>
                        <div class="col-md-12">
                            <form action="payment.php" method="post" class="checkout-form">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Booking No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Passengers</th>
                                            <th>Price (₹)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tblbookings WHERE BookingNumber='$booking_no'";
                                        $query = mysqli_query($con, $sql);
                                        $cnt = 1;
                                        while ($result = mysqli_fetch_array($query)) {
                                        ?>

                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><input type="text" name="booking_no" value="<?php echo $result['BookingNumber'] ?>" readonly></td>
                                                <td><input type="text" name="name" value="<?php echo $result['FullName'] ?>" readonly></td>
                                                <td><input type="text" name="email" value="<?php echo $result['EmailId'] ?>" readonly></td>
                                                <td><input type="text" name="people" value="<?php echo $result['NumnerofPeople'] ?>" readonly></td>
                                                <td><input type="text" name="price" value="<?php echo $result['price'] ?>" readonly></td>
                                                <td>
                                                    <?php if ($result['BookingStatus'] == ''): ?>
                                                        <span class="badge bg-warning text-dark">Not Processed Yet</span>
                                                    <?php elseif ($result['BookingStatus'] == 'Accepted'): ?>
                                                        <span class="badge bg-success">Accepted</span>
                                                    <?php elseif ($result['BookingStatus'] == 'Rejected'): ?>
                                                        <span class="badge bg-danger">Rejected</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                        data-key="<?php echo $Publishable_key ?>"
                                                        data-amount="<?php echo $result['price'] * 100; ?>"
                                                        data-name="Cruise Booking"
                                                        data-description="Booking Number: <?php echo $result['BookingNumber'] ?>"
                                                        data-currency="inr"
                                                        data-email="<?php echo $result['EmailId'] ?>">
                                                    </script>
                                                </td>
                                            </tr>

                                            <!-- Hidden Inputs -->
                                            <input type="hidden" name="boatid" value="<?php echo $id ?>">
                                            <input type="hidden" name="class" value="<?php echo $result['class'] ?>">
                                            
                                        <?php 
                                            $cnt++;
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    <?php 
                    } 
                    ?>

                </div>
            </div>
        </div>

        <div class="site-section bg-image overlay" style="background-image: url('images/hero_2.jpg');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="text-white">Get In Touch With Us</h2>
                        <p class="mb-0"><a href="contact.php" class="btn btn-warning py-3 px-5 text-white">Contact Us</a></p>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once("includes/footer.php"); ?>
        
    </div>
    
    <!-- <?php include_once("footer.php"); ?> -->
    
</body>
</html>
