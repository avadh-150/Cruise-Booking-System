<?php 
// Include PHPMailer autoloader
require '../vendor/autoload.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    include "includes/config.php";
    $id=$_GET['bid'];
    $query=mysqli_query($con,"select * from tblbookings where BookingNumber='$id' and cancel_status = '0'");

    if($query){
        $result=mysqli_fetch_array($query);
        $booking_number=$result['BookingNumber'];
        $booking_status=$result['BookingStatus'];
        $email=$result['EmailId'];
        $phone=$result['PhoneNumber'];
        $num_of_people=$result['NumnerofPeople'];
        $posting_date=$result['postingDate'];
        $created_at=$result['created_at'];

       

            echo "<script>alert('Booking confirmed successfully By admin with approval Payment ');
            </script>";

           echo "<script>alert('we will send Booking confirmed details to your email');
            </script>";

           $mail = new PHPMailer(true);

           try {
               // Server settings
               $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output for production
               $mail->isSMTP();
               $mail->Host       = 'smtp.gmail.com'; // SMTP server
               $mail->SMTPAuth   = true;
               $mail->Username   = '@gmail.com'; // Your Gmail address
               $mail->Password   = '';                               //SMTP password
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
               $mail->Port       = 465; // TCP port

               // Recipients
               $mail->setFrom('@gmail.com', 'form cruisebooks.org');
               $mail->addAddress($email);

               // Content
               $mail->isHTML(true);
               $mail->Subject = 'Booking Confirmed';
               $mail->Body    = "Your Booking has been confirmed: <b>$booking_number</b>
               <br>
               Your booking details are as follows:
               <br>
               Booking Number: $booking_number
               <br>
               Booking Status: $booking_status
               <br>
               Booking Date: $posting_date
               <br>
               Booking Time: $created_at
               <br>
               Booking Email: $email
               <br>
               Booking Phone: $phone
               <br>
               Number of People: $num_of_people
               <br>       
               Thank you for choosing cruisebooks.org
               ";

               $mail->send();

               $encoded_email = base64_encode($email); // Encode OTP for URL

               $msg = "<div class='alert alert-success'>Booking confirmed successfully By admin with approval Payment.
               </div>";
               echo "<script>alert('Please check your email for the Booking details');
               window.location.href = 'accepted-bookings.php';
                </script>";

           } catch (Exception $e) {
               $msg = "<div class='alert alert-danger'>Failed to send OTP. Please try again later.</div>";
           }    
}
else{
    echo "<script>alert('Booking not Confirmed');
    window.location.href = 'accepted-bookings.php';
    </script>";
}
    ?>