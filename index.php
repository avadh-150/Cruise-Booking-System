

<?php 
// session_start();
error_reporting(0);
// Database Connection
include 'includes/config.php';

// Get available sources
$sourceQuery = "SELECT DISTINCT source FROM tblboat";
$sourceResult = mysqli_query($con, $sourceQuery);
$sources = [];
if (mysqli_num_rows($sourceResult) > 0) {
  while($row = mysqli_fetch_assoc($sourceResult)) {
    $sources[] = $row;
  }
}

// Get available destinations
$destQuery = "SELECT DISTINCT destination FROM tblboat";
$destResult = mysqli_query($con, $destQuery);
$destinations = [];
if (mysqli_num_rows($destResult) > 0) {
  while($row = mysqli_fetch_assoc($destResult)) {
    $destinations[] = $row;
  }
}

// Get featured boats
$featuredQuery = "SELECT b.*, r.rating as rating, r.review_text as review_text 
                 FROM tblboat b 
                 LEFT JOIN tblreviews r ON b.ID = r.boat_id 
                 ORDER BY r.rating DESC 
                 LIMIT 6";
$featuredResult = mysqli_query($con, $featuredQuery);
$featuredBoats = [];
if (mysqli_num_rows($featuredResult) > 0) {
  while($row = mysqli_fetch_assoc($featuredResult)) {
    $featuredBoats[] = $row;
  }
}

// Get statistics
$statsQuery = "SELECT 
              (SELECT COUNT(*) FROM tblboat) as total_cruises,
              (SELECT COUNT(*) FROM tblbookings) as total_customers";
          
$statsResult = mysqli_query($con, $statsQuery);
$stats = mysqli_fetch_assoc($statsResult);
?>
<?php session_start();
// Database Connection
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">
<link rel="stylesheet" href="css/slider.css">





<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">
    <?php include_once "includes/navbar.php"; ?>

    <div class="hero-slide owl-carousel site-blocks-cover">
      <div class="intro-section" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 ml-auto text-right" data-aos="fade-up">
              <h1>Explore, Discover The Rivers</h1>


            </div>
          </div>
        </div>
      </div>

      <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
              <h1>Enjoy The Cruise Ride With Your Family</h1>


            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- END slider -->
 <!-- Booking Section -->
 <section id="booking-section" class="booking-section">
      <div class="container">
        <div class="booking-container" data-aos="fade-up">
          <div class="booking-header">
            <h2>Find Your Perfect Cruise</h2>
            <p>Search available routes and book your next adventure</p>
          </div>
          <form action="search.php" method="GET" class="booking-form">
            <div class="booking-form-row">
              <div class="booking-form-group">
                <label for="from"><i class="fas fa-map-marker-alt"></i> Departure</label>
                <select name="from" id="from" class="form-control" required style="height: 50px;">
                  <option value="">Select departure port</option>
                  <?php foreach($sources as $source): ?>
                    <option value="<?php echo htmlspecialchars($source['source']); ?>">
                      <?php echo htmlspecialchars($source['source']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              
              <div class="booking-form-group">
                <label for="to"><i class="fas fa-map-marker"></i> Destination</label>
                <select name="to" id="to" class="form-control" required style="height: 50px;">
                  <option value="">Select destination port</option>
                  <?php foreach($destinations as $destination): ?>
                    <option value="<?php echo htmlspecialchars($destination['destination']); ?>">
                      <?php echo htmlspecialchars($destination['destination']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="booking-form-group">
                <label for="departure"><i class="fas fa-calendar-alt"></i> Travel Date</label>
                <input type="date" name="Arrival" id="departure" class="form-control" 
                       min="<?php echo date('Y-m-d'); ?>" required  style="height: 50px;">
              </div>

             

              <div class="booking-form-group booking-submit">
                <button type="submit" class="btn btn-search">
                  <i class="fas fa-search"></i> Find Cruises
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>


   <!-- About Section -->
   <section class="about-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right">
            <div class="about-image">
              <img src="images/ship_520 (5).jpg" alt="Cruise Ship" class="img-fluid rounded">
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
              <a href="about.php" class="btn btn-outline-primary">Learn More</a>
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
    <!-- END Services Section -->

 <!-- Stats Section -->
 <section class="stats-section" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
              <div class="stat-number" data-count="<?php echo $stats['total_cruises']; ?>">120</div>
              <div class="stat-title">Cruise Ships</div>
            </div>
          </div>
          
          <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
              <div class="stat-number" data-count="<?php echo $stats['total_customers']; ?>">7000</div>
              <div class="stat-title">Happy Customers</div>
            </div>
          </div>
          <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card">
              <div class="stat-number">5000</div>
              <div class="stat-title">Staff Members</div>
            </div>
          </div>
          
          <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card">
              <div class="stat-number" id="per">230</div>
              <div class="stat-title">Professional Sailors</div>
            </div>
          </div>
          
          
        </div>
      </div>
    </section>
    <!-- END Stats Section -->
<!-- Captain Slider Section -->



    <!-- Destinations Section -->
    <section class="destinations-section">
      <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
          <span class="section-subtitle">Popular Routes</span>
          <h2 class="section-title text-dark">Our Top Destinations</h2>
          <p class="section-description">Discover our most popular cruise routes and destinations</p>
        </div>
        
        <div class="row">
          <?php foreach($featuredBoats as $boat): ?>
            <div class="col-md-4" data-aos="fade-up">
              <div class="destination-card">
                <div class="destination-image">
                  <img src="admin/images/<?php echo htmlspecialchars($boat['Image']); ?>" alt="<?php echo htmlspecialchars($boat['Source']); ?> to <?php echo htmlspecialchars($boat['Destination']); ?>">
                  <?php if(isset($boat['Price']) && $boat['Price'] > 0): ?>
                    <div class="destination-price">₹<?php echo htmlspecialchars($boat['Price']); ?></div>
                  <?php endif; ?>
                </div>
                <div class="destination-content">
                  <h3 class="destination-title">
                    <i class="fas fa-map-marker-alt"></i> 
                    <?php echo htmlspecialchars($boat['Source']); ?> to <?php echo htmlspecialchars($boat['Destination']); ?>
                  </h3>
                  
                  <?php if(isset($boat['rating']) && $boat['rating'] > 0): ?>
                    <div class="destination-rating">
                      <?php for($i = 1; $i <= 5; $i++): ?>
                        <?php if($i <= $boat['rating']): ?>
                          <i class="fas fa-star"></i>
                        <?php else: ?>
                          <i class="far fa-star"></i>
                        <?php endif; ?>
                      <?php endfor; ?>
                      <span class="rating-text">(<?php echo htmlspecialchars($boat['rating']); ?>/5)</span>
                    </div>
                  <?php endif; ?>
                  
                  <div class="destination-meta">
                    <?php if(isset($boat['Duration'])): ?>
                      <span><i class="far fa-clock"></i> <?php echo htmlspecialchars($boat['Duration']); ?></span>
                    <?php endif; ?>
                    
                    <?php if(isset($boat['Capacity'])): ?>
                      <span><i class="fas fa-users"></i> Up to <?php echo htmlspecialchars($boat['Capacity']); ?> people</span>
                    <?php endif; ?>
                  </div>
                  
                  <a href="boat-details.php?bid=<?php echo $boat['ID']; ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
          <a href="services.php" class="btn btn-primary">View All Destinations</a>
        </div>
      </div>
    </section>
    <!-- END Destinations Section -->


<!-- Captain Slider Section -->
<section class="captain-slider-section">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Our Team</span>
            <h2 class="section-title text-dark">Meet Our Experienced Captains</h2>
            <p class="section-description">Professional and dedicated team leaders ensuring your safe journey</p>
        </div>

        <div class="captain-slider-wrapper" data-aos="fade-up">
            <div class="captain-slider">
                <?php
                // Ensure connection is established before querying
                if ($con) {
                    $captainQuery = "SELECT * FROM staff";
                    $captainResult = mysqli_query($con, $captainQuery);

                    if (mysqli_num_rows($captainResult) > 0) {
                        while ($captain = mysqli_fetch_assoc($captainResult)) {
                            ?>
                            <div class="captain-card">
                                <div class="captain-image">
                                    <?php if (!empty($captain['image'])): ?>
                                        <img src="admin/uploads/team/<?php echo htmlspecialchars($captain['image']); ?>"
                                             alt="Captain" class="img-fluid">
                                    <?php else: ?>
                                        <img src="images/default-captain.jpg" alt="Captain" class="img-fluid">
                                    <?php endif; ?>
                                </div>
                                <div class="captain-info">
                                    <h4><?php echo htmlspecialchars($captain['captain_name']); ?></h4>
                                    <p class="captain-role">Ship Captain</p>
                                    <div class="captain-details">
                                        <p><i class="fas fa-user-tie"></i> Manager: <?php echo htmlspecialchars($captain['manager'] ?? 'Not Specified'); ?></p>
                                        <p><i class="fas fa-users"></i> Crew Members: <?php echo htmlspecialchars($captain['members'] ?? 'Not Specified'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>No captains found.</p>';
                    }
                } else {
                    echo '<p>Failed to connect to the database.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<style>
:root {
    --card-count: <?php echo mysqli_num_rows($captainResult); ?>;
}
</style>




    
    <!-- Testimonials Section -->
    <section class="testimonials-section">
      <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
          <span class="section-subtitle">Testimonials</span>
          <h2 class="section-title text-dark">What Our Customers Say</h2>
        </div>
        
        <div class="testimonials-slider" data-aos="fade-up">
          <?php
          $testimonialsQuery = "SELECT r.*, b.Source, b.Destination 
                              FROM tblreviews r 
                              JOIN tblboat b ON r.boat_id = b.ID 
                              WHERE r.rating >= 3 
                              ORDER BY r.review_date DESC 
                              LIMIT 5";
          $testimonialsResult = mysqli_query($con, $testimonialsQuery);
          if(mysqli_num_rows($testimonialsResult) > 0):
            while($testimonial = mysqli_fetch_assoc($testimonialsResult)):
          ?>
            <div class="testimonial-item">
              <div class="testimonial-content">
                <div class="testimonial-rating">
                  <?php for($i = 1; $i <= 5; $i++): ?>
                    <?php if($i <= $testimonial['rating']): ?>
                      <i class="fas fa-star"></i>
                    <?php else: ?>
                      <i class="far fa-star"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                </div>
                <p class="testimonial-text"><?php echo htmlspecialchars($testimonial['review_text']); ?></p>
                <div class="testimonial-author">
                  <div class="testimonial-author-info">
                    <h4><?php echo htmlspecialchars($testimonial['customer_name'] ?? 'Happy Customer'); ?></h4>
                    <p><?php echo htmlspecialchars($testimonial['Source']); ?> to <?php echo htmlspecialchars($testimonial['Destination']); ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php 
            endwhile;
          else:
          ?>
            <div class="testimonial-item">
              <div class="testimonial-content">
                <div class="testimonial-rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">The cruise experience was absolutely amazing! The staff was friendly and the views were breathtaking. I'll definitely be booking again.</p>
                <div class="testimonial-author">
                  <div class="testimonial-author-info">
                    <h4>Rajesh Kumar</h4>
                    <p>Mumbai to Goa</p>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="testimonial-item">
              <div class="testimonial-content">
                <div class="testimonial-rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">Perfect family vacation! The kids loved the entertainment and we enjoyed the beautiful sunsets. The food was excellent too.</p>
                <div class="testimonial-author">
                  <div class="testimonial-author-info">
                    <h4>Priya Sharma</h4>
                    <p>Kochi to Lakshadweep</p>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <!-- END Testimonials Section -->

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

</html>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script>




;(($) => {
  // Document Ready
  $(document).ready(() => {
    // Initialize AOS animation library
    AOS.init({
      duration: 800,
      easing: "ease",
      once: true,
      offset: 50,
    })


    // Smooth Scroll for Anchor Links
    $('a[href^="#"]').on("click", function (e) {
      e.preventDefault()

      var target = this.hash
      var $target = $(target)

      $("html, body").animate(
        {
          scrollTop: $target.offset().top - 70,
        },
        800,
        "swing",
      )
    })

    // Counter Animation for Stats
    function startCounter() {
      $(".stat-number").each(function () {
        var $this = $(this)
        var countTo = $this.attr("data-count")

        $({ countNum: 5100 }).animate(
          {
            countNum: countTo,
          },
          {
            duration: 2000,
            easing: "swing",
            step: function () {
              $this.text(Math.floor(this.countNum))
            },
            complete: function () {
              $this.text(this.countNum)
            },
          },
        )
      })
      $("#per").each(function () {
        var $this = $(this)
        var countTo = $this.attr("data-count")

        $({ countNum: 2100 }).animate(
          {
            countNum: countTo,
          },
          {
            duration: 2000,
            easing: "swing",
            step: function () {
              $this.text(Math.floor(this.countNum))
            },
            complete: function () {
              $this.text(this.countNum)
            },
          },
        )
      })
    }

    // Start counter when stats section is in viewport
    var statsSection = $(".stats-section")
    var statsSectionTop = statsSection.offset().top
    var windowHeight = $(window).height()
    var counterStarted = false

    $(window).on("scroll", () => {
      var scrollPos = $(window).scrollTop()

      if (!counterStarted && scrollPos > statsSectionTop - windowHeight + 200) {
        startCounter()
        counterStarted = true
      }
    })

    // Interactive Booking Form
    $("#from").on("change", function () {
      var selectedSource = $(this).val()

      // AJAX request to get available destinations based on selected source
      $.ajax({
        url: "get-destinations.php",
        type: "POST",
        data: { source: selectedSource },
        dataType: "json",
        success: (response) => {
          var destinationSelect = $("#to")
          destinationSelect.empty()

          if (response.length > 0) {
            destinationSelect.append('<option value="">Select destination port</option>')

            $.each(response, (index, destination) => {
              destinationSelect.append('<option value="' + destination + '">' + destination + "</option>")
            })
          } else {
            destinationSelect.append('<option value="">No destinations available</option>')
          }
        },
        error: () => {
          console.log("Error fetching destinations")
        },
      })
    })

    // Set minimum date for departure date picker to today
    var today = new Date()
    var dd = String(today.getDate()).padStart(2, "0")
    var mm = String(today.getMonth() + 1).padStart(2, "0")
    var yyyy = today.getFullYear()
    today = yyyy + "-" + mm + "-" + dd
    $("#departure").attr("min", today)

    // Form Validation
    $(".booking-form").on("submit", (e) => {
      var from = $("#from").val()
      var to = $("#to").val()
      var departure = $("#departure").val()
      if (from === to && from !== "" && to !== "") {
        e.preventDefault()
        alert("Source and destination cannot be the same. Please select different ports.")
      }
    })
  })

  // Window Load
  $(window).on("load", () => {
    // Hide Preloader
    setTimeout(() => {
      $("#loader").fadeOut("slow")
    }, 500)
  })
})(jQuery)


</script>