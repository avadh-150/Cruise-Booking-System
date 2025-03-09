<?php session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');
include "configuration.php";

?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">


  <style>
    input {
      width: 140px;
      border: none;
      outline: none;
    }
  </style>




<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">





    <?php include_once("includes/navbar.php"); ?>

    <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
            <h1>Booking Details</h1>
            <!-- <p><a href="contact.php" class="btn btn-primary py-3 px-5">Contact</a></p> -->
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">





          <div class="col-md-12">
            <form action="payment.php" method="POST">
            <table id="example1" class="table table-bordered table-striped">

              <tbody>
                <?php $bid = base64_decode($_GET['bid']);
                $eml = base64_decode($_GET['eml']);
                $pno = base64_decode($_GET['pno']);
                $sql = "select tblbookings.*, tblboat.* from tblbookings join tblboat on tblboat.ID=tblbookings.BoatID  where tblbookings.ID='$bid' and tblbookings.EmailId='$eml' and tblbookings.PhoneNumber='$pno'";
                $query = mysqli_query($con, $sql);
                $cnt = 1;
                while ($result = mysqli_fetch_array($query)) {
                ?>


                  <tr>
                    <th>Booking Number</th>
                    <td colspan="3"><input type="text" name="booking_no" value="<?php echo $result['BookingNumber'] ?>" readonly></td>
                  </tr>

                  <tr>
                    <th> Name</th>
                    <td> <input type="text" name="name" value="<?php echo $result['FullName'] ?>" readonly>
                    </td>
                    <th>Email Id</th>
                    <td> <input type="text" name="email" value="<?php echo $result['EmailId'] ?>" readonly>
                    </td>
                  </tr>
                  <tr>
                    <th> Mobile No</th>
                    <td><?php echo $result['PhoneNumber'] ?></td>
                    <th>passengers</th>
                    <td> <input type="text" name="people" value="<?php echo $result['NumnerofPeople'] ?>" readonly>
                    </td>
                  </tr>
                  <tr>
                    <th>Source From </th>
                    <td><?php echo $result['Source'] ?> </td>
                    <th>To Destination</th>
                    <td><?php echo $result['Destination'] ?></td>
                  </tr>
                  <tr>
                    <th>Posting Date</th>
                    <td><?php echo $result['postingDate'] ?></td>
                    <th>Boat Name</th>
                    <td><?php echo $result['BoatName'] ?> <a href='boat-details.php?bid=<?php echo $result['BoatID']; ?>' target="blank"> View Details</a></td>
                  </tr>




                  <tr>
                    <th>Booking Status</th>
                    <td><?php if ($result['BookingStatus'] == ''): ?>
                        <span class="badge bg-warning text-dark">Not Processed Yet</span>
                      <?php elseif ($result['BookingStatus'] == 'Accepted'): ?>
                        <span class="badge bg-success">Accepted</span>
                      <?php elseif ($result['Rejected'] == 'Rejected'): ?>
                        <span class="badge bg-danger">Rejected</span>
                      <?php endif; ?>
                    </td>
                    <th>Updation Date</th>
                    <td><?php echo $result['UpdationDate'] ?></td>
                  </tr>

                  <tr>
                    <th> Price</th>
                    <td> <input type="text" name="price" value="<?php echo $result['price'] ?>" readonly>
                    <th> Payment</th>
                    <td>
                    <input type="hidden" name="boatid" value="<?php echo $result['BoatID'] ?>">
                    <input type="hidden" name="class" value="<?php echo $result['class'] ?>">
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key="<?php echo $Publishable_key ?>"
                          data-amount="<?php echo $result['price'] * 100; ?>"
                          data-name="Cruise Booking"
                          data-description="Booking Number: <?php echo $result['BookingNumber'] ?>"
                          data-currency="inr"
                          data-email="<?php echo $result['EmailId'] ?>">
                        </script>
                      </td>


                  </tr>



                <?php $cnt++;
                } ?>

              </tbody>

            </table>
            </form>
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