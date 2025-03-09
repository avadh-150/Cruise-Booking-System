<?php 
// Include PHPMailer autoloader
require '../vendor/autoload.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    include "includes/config.php";
    $id=$_GET['id'];
    $query=mysqli_query($con,"select * from tblbookings where BookingNumber='$id' and cancel_status = '1'");

    if($query){
        $result=mysqli_fetch_array($query);
        $email=$result['EmailId'];
    
        // $delete_query=mysqli_query($con,"update tblbookings set Notes='1' where BookingNumber ='$id'");
        $delete_query=mysqli_query($con,"delete from tblbookings where BookingNumber ='$id'");
        if($delete_query){
            // $delete_ticket=mysqli_query($con,"update ticket set Notes='1' where booking_id ='$id'");
            $delete_ticket=mysqli_query($con,"delete from ticket where booking_id ='$id'");
            if($delete_ticket){
                echo "<script>alert('Booking cancelled successfully By admin Payment Will be Send to Email');
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
                    $mail->setFrom('avadhradadiya293@gmail.com', 'form cruisebooks.org');
                    $mail->addAddress($email);
    
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Booking Cancelled';
                    $mail->Body    = "Your Booking has been cancelled: <b>$id</b>
                    <br>
                    Payment will be refunded to your account within 3-5 working days.
                    <br>
                    Thank you for choosing cruisebooks.org
                    ";
    
                    $mail->send();
    
                    $encoded_email = base64_encode($email); // Encode OTP for URL
    
                    $msg = "<div class='alert alert-success'>Booking cancelled successfully By admin Payment Will be Send to Email.
                    </div>";
                    echo "<script>alert('Please check your email for the refund details of Payments');
                    window.location.href = 'cancel_ticket.php';
                     </script>";
    
                } catch (Exception $e) {
                    $msg = "<div class='alert alert-danger'>Failed to send OTP. Please try again later.</div>";
                }
    

                

        }else{
            echo "<script>alert('Booking not cancelled');
            window.location.href = 'cancel_ticket.php';
            </script>";
        }
        
    }else{
        echo "<script>alert('Booking not cancelled');
        window.location.href = 'cancel_ticket.php';
        </script>";
    }
}
    ?>