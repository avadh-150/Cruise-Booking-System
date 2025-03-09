<?php
include "includes/config.php";

$id = $_GET['id'];
echo "<script>alert('the Booking Number is $id');
        </script>";
$query = "update ticket set cancel_status = '1' WHERE booking_id = $id";
$result = mysqli_query($con, $query);
echo "<script>alert('Ticket cancelled successfully Payment will be refunded within 7 days');
        </script>";

if($result){
    
    $update_status = "update tblbookings set cancel_status = '1' WHERE BookingNumber = '$id'";
    $result_status = mysqli_query($con, $update_status);
    if($result_status){
        echo "<script>alert('Booking cancelled successfully Payment will be refunded within 7 days');
        window.location.href = 'my_ticket.php';
        </script>";
    }else{
        echo "<script>alert('Ticket not cancelled');
        window.location.href = 'my_ticket.php';
        </script>";
    }
}

?>