<?php 
// session_start();
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

   <?php include_once("includes/navbar.php");?>
    

      <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
              <h1>Our Services</h1>
       
              <!-- <p><a href="#" class="btn btn-primary py-3 px-5">Contact</a></p> -->
            </div>
          </div>
        </div>
      </div>

    
<?php

// Get featured boats with pagination
$resultsPerPage = 9; // Number of boats per page
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($currentPage - 1) * $resultsPerPage;

// Count total boats for pagination
$countQuery = "SELECT COUNT(*) as total FROM tblboat";
$countResult = mysqli_query($con, $countQuery);
$totalBoats = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalBoats / $resultsPerPage);

// Get featured boats with pagination
$featuredQuery = "SELECT b.*, r.rating as rating, r.review_text as review_text 
                 FROM tblboat b 
                 LEFT JOIN tblreviews r ON b.ID = r.boat_id 
                 ORDER BY r.rating DESC 
                 LIMIT $offset, $resultsPerPage";
$featuredResult = mysqli_query($con, $featuredQuery);
$featuredBoats = [];
if (mysqli_num_rows($featuredResult) > 0) {
  while($row = mysqli_fetch_assoc($featuredResult)) {
    $featuredBoats[] = $row;
  }
}?>

<div class="py-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
      <span class="section-subtitle">Popular Routes</span>
          <h2 class="section-title text-dark">Our Top Destinations</h2>
          <p class="section-description">Discover our most popular cruise routes and destinations</p>
      </div>
    </div>
       <!-- Destinations Section -->
       <section class="destinations-section">
      <div class="container">        
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
        
        <!-- Pagination Links -->
        <?php if($totalPages > 1): ?>
        <div class="row mt-5">
          <div class="col-12">
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php if($currentPage > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
                
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                  <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>
                
                <?php if($currentPage < $totalPages): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </section>
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