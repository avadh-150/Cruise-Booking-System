<?php
// Include database connection
include('includes/config.php');

// Check if user is logged in (assuming you have a session for login status)
session_start();
error_reporting(0);
$isLoggedIn = isset($_SESSION['user_id']); // Adjust according to your login system

// Retrieve data from the form
$from = $_GET['from'];
$to = $_GET['to'];
$Arrival = $_GET['Arrival'];

// Validate inputs
if (empty($from) || empty($to) || empty($Arrival)) {
    echo "<h3 style='color:red; text-align:center;'>Please fill in all the fields!</h3>";
    exit;
}

// Create a date range for the search
$startDateTime = $Arrival . " 00:00:00";
$endDateTime = $Arrival . " 23:59:59";

// Query the database for matching trips
$sql = "SELECT * FROM tblboat WHERE source = ? AND destination = ?  OR arrival_time BETWEEN ? AND ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssss", $from, $to, $startDateTime, $endDateTime);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
<link rel="stylesheet" href="css/custon.css">


  <style>
      /* .container {
          max-width: 900px;
          margin: auto;
          text-align: center;
        } */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .no-results {
            font-size: 18px;
            color: #888;
        }
        </style>

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">
        <?php include "includes/navbar.php"; ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container mt-12x">
        <h2 class="text-center mb-8">Search Results</h2>

        <?php if ($result->num_rows > 0): ?>

            <table>
                <thead>
                    <tr>
                        <th>Boat Name</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Arrival Date & Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['BoatName']); ?></td>
                            <td><?= htmlspecialchars($row['Source']); ?></td>
                            <td><?= htmlspecialchars($row['Destination']); ?></td>
                            <td><?= htmlspecialchars($row['arrival_time']); ?></td>
                            <td>
                                <?php if ($isLoggedIn): ?>
                                    <a href="get_detail.php?id=<?= htmlspecialchars($row['ID']); ?>" class="btn btn-primary">Book Now</a>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-warning">Login to Book</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-results">No trips found matching your criteria. <a href="index.php" class="btn btn-info">Search Again</a></p>
        <?php endif; ?>
    </div>
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

   
    <?php include_once("includes/footer.php"); ?>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15" />
    </svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script>



<?php
// Close database connection
$stmt->close();
$con->close();
?>
