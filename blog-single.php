<?php
// Database connection
include "includes/config.php"; // Assuming you have a config file with database connection

// Check if blog ID is provided
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: blogs.php");
    exit();
}

$blog_id = (int)$_GET['id'];

// Query to get the specific blog
$query = "SELECT id, title, content, image_path, created_at from gym_blogs WHERE id = $blog_id";
$result = mysqli_query($con, $query);

// Check if blog exists
if(mysqli_num_rows($result) == 0) {
    header("Location: blogs.php");
    exit();
}

$blog = mysqli_fetch_assoc($result);

// Query to get related blogs (excluding current blog)
$related_query = "SELECT id, title, image_path from gym_blogs WHERE id != $blog_id ORDER BY created_at DESC LIMIT 3";
$related_result = mysqli_query($con, $related_query);
?>

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
              <h1>Enjoy Reading Blogs</h1>
            </div>
          </div>
        </div>
    </div>

    <!-- Blog Single Section -->
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="blog-single-content" data-aos="fade-up">
                        <h1 class="blog-title mb-4"><?php echo $blog['title']; ?></h1>
                        <div class="blog-meta mb-4">
                            <span><i class="far fa-calendar-alt"></i> <?php echo date('F d, Y', strtotime($blog['created_at'])); ?></span>
                        </div>
                        
                        <?php if(!empty($blog['image_path'])): ?>
                        <div class="blog-featured-image mb-4">
                            <img src="admin/uploads/blogs/<?php echo $blog['image_path']; ?>" alt="<?php echo $blog['title']; ?>" class="img-fluid rounded">
                        </div>
                        <?php endif; ?>
                        
                        <div class="blog-content">
                            <?php echo $blog['content']; ?>
                        </div>
                        
                        <div class="blog-share mt-5">
                            <h5>Share This Post:</h5>
                            <div class="social-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fab fa-facebook-f"></i> Facebook</a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($blog['title']); ?>" target="_blank" class="btn btn-info btn-sm"><i class="fab fa-twitter"></i> Twitter</a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-secondary btn-sm"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                            </div>
                        </div>
                        
                        <div class="blog-navigation mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <?php
                                    // Get previous blog
                                    $prev_query = "SELECT id, title from gym_blogs WHERE id < $blog_id ORDER BY id DESC LIMIT 1";
                                    $prev_result = mysqli_query($con, $prev_query);
                                    if(mysqli_num_rows($prev_result) > 0) {
                                        $prev_blog = mysqli_fetch_assoc($prev_result);
                                        echo '<a href="blog-single.php?id=' . $prev_blog['id'] . '" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Previous Post</a>';
                                    }
                                    ?>
                                </div>
                                <div class="col-6 text-right">
                                    <?php
                                    // Get next blog
                                    $next_query = "SELECT id, title from gym_blogs WHERE id > $blog_id ORDER BY id ASC LIMIT 1";
                                    $next_result = mysqli_query($con, $next_query);
                                    if(mysqli_num_rows($next_result) > 0) {
                                        $next_blog = mysqli_fetch_assoc($next_result);
                                        echo '<a href="blog-single.php?id=' . $next_blog['id'] . '" class="btn btn-outline-primary">Next Post <i class="fas fa-arrow-right"></i></a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 pl-lg-5">
                    <div class="sidebar">
                        <!-- Back to Blogs Button -->
                        <div class="sidebar-box mb-4" data-aos="fade-up">
                            <a href="blogs.php" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i> Back to All Blogs</a>
                        </div>
                        
                        <!-- Related Posts -->
                        <div class="sidebar-box" data-aos="fade-up">
                            <h3 class="sidebar-title">Related Posts</h3>
                            <?php
                            if(mysqli_num_rows($related_result) > 0) {
                                while($related = mysqli_fetch_assoc($related_result)) {
                            ?>
                            <div class="related-post mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="admin/uploads/blogs/<?php echo $related['image_path']; ?>" alt="<?php echo $related['title']; ?>" class="img-fluid rounded">
                                    </div>
                                    <div class="col-8">
                                        <h6><a href="blog-single.php?id=<?php echo $related['id']; ?>"><?php echo $related['title']; ?></a></h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            } else {
                                echo '<p>No related posts found.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Blog Single Section -->
    
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