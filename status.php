<?php
//  session_start();
// Database Connection
include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">



<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">





    <?php include_once("includes/navbar.php"); ?>

    <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
            <h1>Booking Status</h1>
            <!-- <p><a href="contact.php" class="btn btn-primary py-3 px-5">Contact</a></p> -->
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">

          <div class="col-md-6">
            <h3 class="heading-92913 text-black">Check Booking Status</h3>
            <p>please check your booking status here</p>
            <form action="#" class="row" method="post">





              <div class="form-group col-md-6">
                <label for="input-6">Email Address</label>
                <input type="text" class="form-control" name="emailid" required="true">
              </div>

              <div class="form-group col-md-6">
                <label for="input-7">Phone Number</label>
                <input type="text" class="form-control" name="phonenumber" maxlength="10" pattern="[0-9]+" required="true">
              </div>


              <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary py-3 px-5" value="Check Now">
              </div>

            </form>
          </div>


          <?php
          if (isset($_POST['submit'])) {
            $emailid = $_POST['emailid'];
            $phonenumber = $_POST['phonenumber'];
          ?>
            <div class="col-md-10">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Bookings No</th>
                    <th>Name</th>
                    <th>Email Id</th>
                    <th>Passenger</th>
                    <th>Price</th>
                    <th>Booking Date/Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM tblbookings WHERE PhoneNumber='$phonenumber' AND EmailId='$emailid'";
                  $query = mysqli_query($con, $sql);
                  $cnt = 1;

                  if ($query && mysqli_num_rows($query) > 0) {
                    while ($result = mysqli_fetch_array($query)) {
                  ?>
                      <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $result['BookingNumber']; ?></td>
                        <td><?php echo $result['FullName']; ?></td>
                        <td><?php echo $result['EmailId']; ?></td>
                        <td><?php echo $result['NumnerofPeople']; ?></td>
                        <td><?php echo $result['price']; ?></td>
                        <td><?php echo $result['postingDate']; ?></td>
                        <td>
                          <?php if ($result['BookingStatus'] == ''): ?>
                            <span class="badge bg-warning text-dark">Not Processed Yet</span>
                          <?php elseif ($result['BookingStatus'] == 'Accepted'): ?>
                            <span class="badge bg-success">Accepted</span>
                          <?php elseif ($result['BookingStatus'] == 'Rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                          <?php endif; ?>
                        </td>
                        <?php
                        if ($result['BookingStatus'] == 'Accepted') {
                        ?>
  <td>
                            <a href="my_ticket.php" class="btn btn-primary btn-sm">completed</a>
                          </td>
                          <?php 
                        }else{
                          if($_SESSION['email'])
                          {
                          ?>
                          <td>
                            <a href="booking-details.php?bid=<?php echo base64_encode($result['ID']); ?>&eml=<?php echo base64_encode($result['EmailId']); ?>&pno=<?php echo base64_encode($result['PhoneNumber']); ?>" title="View Details" class="btn btn-primary btn-sm">View & Pay</a>
                          </td>
                          
                        <?php
                          }else{
                            echo "<script>alert('Please login to view or pay for the booking');
                            window.location.href='login.php';
                            </script>";
                          }
                        }

                        ?>

                      </tr>
                  <?php
                      $cnt++;
                    }
                  } else {
                    echo "<tr><td colspan='10' class='text-center'>No bookings found for this Email or Mobile Number</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          <?php
          }
          ?>


        </div>
      </div>
    </div>


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
  <!-- .site-wrap -->


  <!-- loader -->
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
<script type="text/javascript">
  $(".datepicker").datepicker({
    format: "yyyy-mm-dd",
  });
</script>

</html>