<?php
session_start();
include('includes/config.php');
include 'configuration.php'; // Include Stripe configuration

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

// Sanitize input
$booking_no = mysqli_real_escape_string($con, $_POST['booking_no']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$people = mysqli_real_escape_string($con, $_POST['people']);
$class = mysqli_real_escape_string($con, $_POST['class']);
$boatid = mysqli_real_escape_string($con, $_POST['boatid']);
$price = mysqli_real_escape_string($con, $_POST['price']) * 100; // Convert to paise
$bno = mt_rand(100000000, 9999999999);
$username=$_SESSION['email'];

// Minimum price check
if ($price < 5000) { // Minimum ₹50 (5000 paise)
    die("Error: Minimum amount for payment is ₹50.");
}

echo "<script>alert('bookingNumber is : $booking_no');</script>";
// Fetch the `ID` from tblbookings using `booking_no`
$query = "SELECT * FROM tblbookings WHERE BookingNumber = '$booking_no'";
$result = mysqli_query($con, $query);

if($result)
{
    echo "<script>
    alert('Get Booking Number.. $booking_no');
    </script>"; 
}else{
    
    echo "<script>
    alert('Booking Number not found..');
    </script>";
}

// Check if Stripe token exists

if (isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];

    try {
        // Process payment with Stripe
        $charge = \Stripe\Charge::create([
            "amount" => $price,
            "currency" => "inr",
            "description" => "Cruise Booking",
            "source" => $token,
        ]);

        // Check if payment succeeded
        if ($charge->status === 'succeeded') {
            $txn_id = $charge->balance_transaction; // Stripe transaction ID
            $payment_status = 'Yes'; // Payment success
            $amount_inr = $price / 100; // Convert to INR

            $txn= $txn_id;
            echo "<script>
            alert('Get Booking Number.. $booking_no and txn_id is..:$txn_id');
            </script>";
            // Insert into payment table
            $payment_query = "INSERT INTO tblpayment (booking_id, txn_id, email, amount, payment_status,login_email) 
                              VALUES ('$booking_no', '$txn', '$email', '$amount_inr', '$payment_status','$username')";

echo "<script>
alert('Get Booking Number.. $booking_no');
</script>";

            // Insert into ticket table
            $ticket_query = "INSERT INTO ticket (txn_id, ticket_number, login_email, passenger_name, price, boat_id,email, class, number_of_passengers,booking_id) 
                             VALUES ('$txn', '$bno', '$username', '$name', '$amount_inr', '$boatid','$email','$class', '$people','$booking_no')";

            // Execute queries
            $update="update tblbookings set BookingStatus = 'Accepted' where BookingNumber='$booking_no'";
            $update_result = mysqli_query($con, $update);
            $result1 = mysqli_query($con, $payment_query);
            $result2 = mysqli_query($con, $ticket_query);

            if ($result1 && $result2 && $result) {
                echo "<script>
                alert('Payment successfully processed');
                window.location.href = 'success.php?tid=$txn&card=$payment_status&bid=$boatid';
                </script>";
            } else {
                echo "<script>
                alert('Database error occurred.');
                window.location.href = 'verify_detail.php';
                </script>";
            }
        } else {
            die("Payment failed.");
        }
    } catch (\Stripe\Exception\ApiErrorException $e) {
        die("Stripe error: " . $e->getMessage());
    }
} else {
    die("Error: Stripe token is missing.");
}
?>
