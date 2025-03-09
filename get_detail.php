<?php
session_start();
error_reporting(0);
include('includes/config.php');
$msg='';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $boatid = intval($_GET['id']);
    $fname = mysqli_real_escape_string($con, $_POST['first_name']);
    $lname = mysqli_real_escape_string($con, $_POST['last_name']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $emailid = mysqli_real_escape_string($con, $_POST['email']);
    $aadhar = mysqli_real_escape_string($con, $_POST['aadhar_card']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phone']);
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $price = floatval($_POST['price']); // Ensure it's a numeric value
    $nopeople = intval($_POST['passenger_count']); // Ensure it's an integer
    $name = $fname . " " . $lname;
    $user_id = $_SESSION['user_id'];

    $bno = mt_rand(100000000, 9999999999);
    $check = "SELECT * FROM tblbookings WHERE EmailId='$emailid'";
    $check_result = mysqli_query($con, $check);
    
    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $msg = "<div class='alert alert-warning'>The email has already been registered.</div>";
    }else{

    // Insert into database
    $sql = "INSERT INTO tblbookings (BoatID, BookingNumber, FullName, EmailId, adhar_card, PhoneNumber, price, class, gender, NumnerofPeople, Notes,user_id)
            VALUES ('$boatid', '$bno', '$name', '$emailid', '$aadhar', '$phonenumber', '$price', '$class', '$gender', '$nopeople', '','$user_id');";

    $query = mysqli_query($con, $sql);

    if ($query) {
        echo "<script>alert('Your boat booking request has been sent successfully. Booking number is $bno');</script>";
        // echo "<script>document.location.href = 'verify_detail.php?bookingno=$bno&&boatid=$boatid';</script>";
        echo "<script>document.location.href = 'status.php';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}
}

if (isset($_GET['id'])) {
    $boatid = intval($_GET['id']);
    $sql = "SELECT * FROM tblboat WHERE ID = '$boatid'";
    $query = mysqli_query($con, $sql);
    $boat = mysqli_fetch_assoc($query);

    // Fetch class prices from the database
    $classPrices = [
        "executive" => $boat['executive'],
        "business" => $boat['business'],
        "room_cabin" => $boat['room_cabin'],
        "sleeper" => $boat['sleeper'],
    ];
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">
<script>
    // Function to calculate the total price
    function calculatePrice() {
        const classPrices = {
            "executive": <?php echo $classPrices['executive']; ?>,
            "business": <?php echo $classPrices['business']; ?>,
            "room_cabin": <?php echo $classPrices['room_cabin']; ?>,
            "sleeper": <?php echo $classPrices['sleeper']; ?>,
        };

        const basePrice = <?php echo $boat['Price']; ?>; // Base price from tblboat
        const selectedClass = document.getElementById("class").value;
        const passengerCount = parseInt(document.getElementById("passenger_count").value) || 0;
        const classPrice = classPrices[selectedClass] || 0;

        // Total price = (Base price + Class price) * Number of passengers
        const totalPrice = (basePrice + classPrice) * passengerCount;

        // Display price per passenger (base price + class price)
        document.getElementById("price_per_passenger").value = (basePrice + classPrice) || '';
        document.getElementById("total_price").value = totalPrice || '';
    }
</script></head>


<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div class="site-wrap">
    <?php include "includes/navbar.php"; ?>
    <br>

<br><br><br>
<div class="container mt-5">
    <h2 class="text-center">Passenger Details</h2>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="passenger_count" class="form-label">Number of Passengers</label>
                    <input type="number" name="passenger_count" id="passenger_count" class="form-control" min="1" required oninput="calculatePrice()">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    <span><?php echo $msg; ?></span>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="aadhar_card" class="form-label">Aadhar Card Number</label>
                    <input type="text" name="aadhar_card" id="aadhar_card" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="class" class="form-label">Class</label>
                    <select name="class" id="class" class="form-select" required onchange="calculatePrice()">
                        <option value="">Select Class</option>
                        <option value="executive">Executive Class</option>
                        <option value="business">Business Class</option>
                        <option value="room_cabin">Room/Cabin</option>
                        <option value="sleeper">Sleeper Class</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="price_per_passenger" class="form-label">Price Per Passenger</label>
                    <input type="text" id="price_per_passenger" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input type="text" name="price" id="total_price" class="form-control" readonly>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary">Book Now</button>
            <button type="reset" class="btn btn-secondary" onclick="calculatePrice()">Reset</button>
        </div>
    </form>
</div>    <br>
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
