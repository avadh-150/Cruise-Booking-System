<?php 
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">



<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <?php include_once("includes/navbar.php"); ?>

    <div class="intro-section site-blocks-cover innerpage" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row align-items-center text-center border">
          <div class="col-lg-12 mt-5" data-aos="fade-up">
            <h1>Get In Touch</h1>
            <p class="text-white text-center">
              <a href="index.php">Home</a>
              <span class="mx-2">/</span>
              <span>Contact Us</span>
            </p>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>

    <section class="contact-section">
      <div class="container">
        <div class="row">
          <!-- Left Side: Contact Details -->
          <div class="col-md-5">
            <div class="contact-details">
              <h4>Contact Details</h4>
              <p class="d-flex">
                <span class="ion-ios-location icon mr-3"></span>
                <span>Hazira Gam
                ,Surat, Gujarat 394270.</span>
              </p>
              <p class="d-flex">
                <span class="ion-ios-telephone icon mr-3"></span>
                <span>+91 7567992211</span>
              </p>
              <p class="d-flex">
                <span class="ion-android-mail icon mr-3"></span>
                <span>cruiseride@gmail.com</span>
              </p>

              <div class="map-embed">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d23474.688044874478!2d72.64717451112217!3d21.098376829911576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1739602083951!5m2!1sen!2sin" width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>

          <!-- Right Side: Contact Form -->
          <div class="col-md-7">
            <div class="contact-form">
              <h4 class="mb-4">Send Us a Message</h4>
              <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
              <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>

              <form method="POST" action="">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                  <label for="message">Message:</label>
                  <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <br>
    <br>
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
    <?php include "footer.php"; ?>
</body>

</html>

<?php
// Include database connection file
include 'includes/config.php'; // Update this with your actual connection file

// Initialize success and error messages
$success = "";
$error = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Collect and sanitize form data
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $phone = isset($_POST['phone']) ? mysqli_real_escape_string($con, $_POST['phone']) : NULL;
  $message = mysqli_real_escape_string($con, $_POST['message']);

  // Insert data into the database
  $sql = "INSERT INTO contact (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

  if (mysqli_query($con, $sql)) {
    // Notify admin via email

    $success = "Your query has been submitted successfully. We will get back to you soon.";
    echo "<script>
            alert('$success');
            </script>";
  } else {
    $error = "Your query was submitted, but we couldn't notify the admin.";
  }
} else {
  $error = "There was an error submitting your query. Please try again later.";
}

?>