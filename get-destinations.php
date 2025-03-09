<?php
// Database Connection
include 'includes/config.php';

// Check if source is set
if(isset($_POST['source'])) {
    $source = mysqli_real_escape_string($con, $_POST['source']);
    
    // Get available destinations based on selected source
    $query = "SELECT DISTINCT Destination FROM tblboat WHERE Source = '$source'";
    $result = mysqli_query($con, $query);
    
    $destinations = array();
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $destinations[] = $row['Destination'];
        }
    }
    
    // Return destinations as JSON
    header('Content-Type: application/json');
    echo json_encode($destinations);
} else {
    // Return empty array if source is not set
    header('Content-Type: application/json');
    echo json_encode(array());
}
?>

