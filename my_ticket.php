<?php
session_start();
include 'includes/config.php';

if (!isset($_SESSION['email'])) {
    echo "<script>
        alert('Please login first');
        window.location.href='login.php';
    </script>";
    exit;
}
$email = $_SESSION['email'];
// Fetch tickets securely

// $bID= $row["ID"];
// $sql_book ="select * from tblbookings where BoatID = $bID";

$sql_book ="SELECT t.*,b.* FROM ticket t,tblbookings b WHERE b.BookingNumber=t.booking_id AND t.login_email = '$email' and t.cancel_status = '0'";
$result = mysqli_query($con,$sql_book);

// $row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="css/comfirm.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
    <link rel="stylesheet" href="css/custon.css">
    <style>
    
</style>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
        <?php include_once("nav.php"); ?>
    <div class="container confirmation-container">
        <div class="confirmation-header">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="index.php" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
                <h1 class="confirmation-title">Booking Confirmation</h1>
            </div>
        </div>

        <div class="card main-card">
            <div class="card-body">
                <?php
                
                
                
                if ($result && $result->num_rows > 0): ?>
                    <?php while ($ticket = $result->fetch_assoc()): ?>



                        <div class="booking-details mb-4">
                            <div class="confirmation-status">
                                <div class="status-icon">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <h2 class="status-text">Booking Confirmed!</h2>
                            </div>

                            <div class="reference-number">
                                <span>Booking Reference:</span>
                                <strong><?php echo htmlspecialchars($ticket['booking_id']); ?></strong>
                            </div>

                            <div class="details-grid">
                                <div class="detail-item">
                                    <label>Passenger Name</label>
                                    <span><?php echo htmlspecialchars($ticket['passenger_name']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <label>Ticket Number</label>
                                    <span><?php echo htmlspecialchars($ticket['ticket_number']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <label>Class</label>
                                    <span><?php echo htmlspecialchars($ticket['class']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <label>Boat Number</label>
                                    <span><?php echo htmlspecialchars($ticket['boat_id']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <label>Number of Passengers</label>
                                    <span><?php echo htmlspecialchars($ticket['number_of_passengers']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <label>Price</label>
                                    <span class="price">₹<?php echo htmlspecialchars($ticket['price']); ?></span>
                                </div>
                                <?php 
                                $BID= $ticket['BoatID'];
                                $sql="select * from tblboat where ID =$BID ";
                                $boat_result = mysqli_query($con,$sql) or die($con->error);
                                $row = mysqli_fetch_assoc($boat_result);
                                ?>
                                <div class="detail-item">
                                    <label>Arrival Date & Time</label>
                                    <span ><?php echo htmlspecialchars($row['arrival_time']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <label>Departure Date & TIme</label>
                                    <span ><?php echo htmlspecialchars($row['departure_time']); ?></span>
                                </div>
                            </div>


                            <div class="action-buttons mt-4">
                                <!-- <button class="btn btn-primary" onclick="window.print()">
                                    <i class="fas fa-print"></i> Print
                                </button> -->
                                <a href="cancel_ticket.php?id=<?php echo $ticket['booking_id']; ?>" class="btn btn-success">
                                    <i class="fas fa-file-pdf"></i> Cancel Ticket
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No bookings found.
                    </div>
                <?php endif; ?>
            </div>
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
    <?php include "includes/footer.php" ?>

    <!-- JS Libraries --> <script src="js/jquery-3.3.1.min.js"></script>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-code.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="assets/js/confirmation.js"></script>
    <script>
        // Handle PDF export functionality
function exportToPDF() {
    const element = document.querySelector('.booking-details');
    const opt = {
        margin:1,
        filename: 'booking-confirmation.pdf',
        image: { type: 'jpeg', quality: 2},
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // Remove action buttons before generating PDF
    const actionButtons = element.querySelector('.action-buttons');
    actionButtons.style.display = 'none';

    html2pdf().set(opt).from(element).save().then(() => {
        // Restore action buttons after PDF generation
        actionButtons.style.display = 'flex';
    });
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Add loading state to buttons
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        this.disabled = true;

        setTimeout(() => {
            this.innerHTML = originalText;
            this.disabled = false;
        }, 2000);
    });
});

// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

    </script>
    
</body>
</html>
