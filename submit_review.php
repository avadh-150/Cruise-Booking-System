<?php
session_start();
include('includes/config.php');

if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to submit a review.');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boat_id = mysqli_real_escape_string($con, $_POST['boat_id']);
    $user_id = $_SESSION['user_id'];
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $review_text = mysqli_real_escape_string($con, $_POST['review_text']);
    
    // Check if user has already reviewed this boat
    $check_review = mysqli_query($con, "SELECT * FROM tblreviews WHERE user_id='$user_id' AND boat_id='$boat_id'");
    if(mysqli_num_rows($check_review) > 0) {
        // Update existing review
        $update = mysqli_query($con, "UPDATE tblreviews SET rating='$rating', review_text='$review_text', 
                                    review_date=NOW(), status='pending' 
                                    WHERE user_id='$user_id' AND boat_id='$boat_id'");
    } else {
        // Insert new review
        $insert = mysqli_query($con, "INSERT INTO tblreviews (boat_id, user_id, booking_id, rating, review_text, status) 
                                    VALUES ('$boat_id', '$user_id', 
                                    (SELECT ID FROM tblbooking WHERE UserID='$user_id' AND BoatID='$boat_id' AND Status='Completed' LIMIT 1), 
                                    '$rating', '$review_text', 'pending')");
    }

    echo "<script>alert('Thank you for your review! It will be displayed after approval.');</script>";
    echo "<script>window.location.href='boat-details.php?bid=" . $boat_id . "';</script>";
}
?> 