<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <div class="site-wrap">
      <?php include_once("includes/navbar.php");?>
    
    

      <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
              <h1>About</h1>
        
              <!-- <p><a href="contact.php" class="btn btn-primary py-3 px-5">Contact</a></p> -->
            </div>
          </div>
        </div>
      </div>

    

   <!-- About Section -->
   <section class="about-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="about-image">
          <video class="img-fluid rounded" autoplay loop muted playsinline>
            <source src="images/about-video.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <div class="experience-badge">
            <span class="years">30+</span>
            <span class="text">Years of Experience</span>
          </div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <div class="about-content">
          <span class="section-subtitle">About Us</span>
          <h2 class="section-title text-dark">India's Premier Cruise Experience</h2>
          <p class="about-text">
            Indigoseaways Pvt. Ltd under the brand name of SGR Sea Connect - A Sea Group Roro Ferry Company is India's first Roll On-Roll Off Ferry Service provider- the unique & fastest Passenger cum Cargo service in partnership with Gujarat Maritime Board in Gulf of Cambay.
          </p>
          <p class="about-text">
            DG Sea Connect is one such dream seen by our Hon. Prime Minister Shri Narendra Modi to bring India's first ROPAX Ferry into existence which connects two crucial points of Gujarat.
          </p>
          <div class="about-features">
            <div class="feature">
              <i class="fas fa-ship"></i>
              <span>Modern Fleet</span>
            </div>
            <div class="feature">
              <i class="fas fa-user-tie"></i>
              <span>Expert Crew</span>
            </div>
            <div class="feature">
              <i class="fas fa-star"></i>
              <span>5-Star Service</span>
            </div>
          </div>
          <!-- <a href="about.php" class="btn btn-outline-primary">Learn More</a> -->
        </div>
      </div>
    </div>
  </div>
</section>
 <!-- END About Section -->
 <!-- Services Section -->
 <section class="services-section">
      <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
          <span class="section-subtitle">Our Services</span>
          <h2 class="section-title text-dark">What We Offer</h2>
          <p class="section-description">Experience the best in cruise travel with our premium services</p>
        </div>
        
        <div class="row">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-ship"></i>
              </div>
              <h3 class="service-title">Luxury Cruises</h3>
              <p class="service-description">
                Experience unparalleled luxury with our premium cruise packages, featuring spacious cabins and world-class amenities.
              </p>
            </div>
          </div>
          
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-utensils"></i>
              </div>
              <h3 class="service-title">Fine Dining</h3>
              <p class="service-description">
                Enjoy exquisite cuisine prepared by our expert chefs, offering both local and international dishes.
              </p>
            </div>
          </div>
          
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-glass-cheers"></i>
              </div>
              <h3 class="service-title">Entertainment</h3>
              <p class="service-description">
                From live music to cultural performances, our entertainment options ensure you're never bored.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    
     <!-- CTA Section -->
     <section class="cta-section" style="background-image: url('images/hero_2.jpg');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center" data-aos="fade-up">
            <h2 class="cta-title">Ready to Start Your Journey?</h2>
            <p class="cta-text">Book your dream cruise vacation today and create memories that will last a lifetime.</p>
            <div class="cta-buttons">
              <a href="#booking-section" class="btn btn-primary btn-lg">Book Now</a>
              <a href="contact.php" class="btn btn-outline-light btn-lg">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END CTA Section -->


    <?php include_once("includes/footer.php");?>
    

  </div>
  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

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

</html>