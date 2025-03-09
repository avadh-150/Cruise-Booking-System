<?php
include 'includes/config.php';
session_start();
error_reporting(0);

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "<script>
    alert('Log in to access this feature');
    window.location.href='login.php';
    </script>";
    exit();
}

// Ensure the database connection is established
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$user = $_SESSION['email'];
$sql1 = "SELECT * FROM tblpayment WHERE login_email='$user'";
$result2 = mysqli_query($con, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div class="site-wrap">
    <?php include_once "includes/navbar.php"; ?>
    <br><br><br>
    <br><br><br>
    <center><h1 class="mt-5">Payment History</h1></center><br>
<br>
    <div class=" mt-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking Number</th>
                    <th>Transaction ID</th>
                    <th>Passenger Email</th>
                    <th>Amount</th>
                    <th>Login Email</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result2 && mysqli_num_rows($result2) > 0): ?>
                    <?php while ($row3 = mysqli_fetch_assoc($result2)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row3['booking_id']); ?></td>
                            <td><?php echo htmlspecialchars($row3['txn_id']); ?></td>
                            <td><?php echo htmlspecialchars($row3['email']); ?></td>
                            <td>₹<?php echo number_format($row3['amount'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row3['login_email']); ?></td>
                            <td><?php echo htmlspecialchars($row3['payment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row3['payment_status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No Payment Records Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

    <!-- CTA Section -->
    <section class="cta-section" style="background-image: url('images/hero_2.jpg');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center" data-aos="fade-up">
            <h2 class="cta-title">Ready to Start Your Journey?</h2>
            <p class="cta-text">Book your dream cruise vacation today and create memories that will last a lifetime.</p>
            <div class="cta-buttons">
              <a href="services.php" class="btn btn-primary btn-lg">Book Now</a>
              <a href="contact.php" class="btn btn-outline-light btn-lg">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END CTA Section -->

<?php include "footer.php"; ?>
<?php include "includes/footer.php"; ?>

</body>
</html>
