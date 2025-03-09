<?php
session_start();
error_reporting(0);
include('includes/config.php');
// error_reporting(0);

if (!isset($_GET['bid'])) {
  die("Cruise ID is missing.");
}

$bid = intval($_GET['bid']); // Sanitize input

// Check if review form was submitted
if (isset($_POST['submit_review'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $rating = intval($_POST['rating']);
  $review_text = mysqli_real_escape_string($con, $_POST['review_text']);
  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

  // Validate rating (1-5)
  if ($rating < 1 || $rating > 5) {
    $rating = 5; // Default to 5 if invalid
  }

  $query = "INSERT INTO tblreviews (boat_id, user_id, username, rating, review_text) 
            VALUES ('$bid', '$user_id', '$username', '$rating', '$review_text')";

  if (mysqli_query($con, $query)) {
    $msg = "Review submitted successfully";
  } else {
    $error = "Something went wrong. Please try again";
  }
}

// Fetch cruise details
$query = mysqli_query($con, "SELECT * FROM tblboat WHERE ID='$bid'");
if (!$query) {
  die("Error fetching cruise details: " . mysqli_error($con));
}
$boat = mysqli_fetch_assoc($query);

if (!$boat) {
  die("Cruise not found.");
}

// Fetch reviews for the cruise
$reviews_query = mysqli_query($con, "SELECT tblreviews.*, users.username 
                                     FROM tblreviews 
                                     JOIN users ON tblreviews.user_id = users.id
                                     WHERE boat_id='$bid' 
                                     ORDER BY created_at DESC");
if (!$reviews_query) {
  die("Error fetching reviews: " . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custon.css">



  <style>
    .star-rating {
      color: #ffc107;
      font-size: 24px;
      margin-bottom: 15px;
    }
    .review-item {
      border-bottom: 1px solid #eee;
      padding: 15px 0;
    }
    .review-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    .review-date {
      color: #888;
      font-size: 14px;
    }
    .rating-input label {
      cursor: pointer;
      font-size: 24px;
      color: #ddd;
    }
    .rating-input input {
      display: none;
    }
    .rating-input label:hover,
    .rating-input label:hover ~ label,
    .rating-input input:checked ~ label {
      color: #ffc107;
    }
    .rating-input {
      display: flex;
      flex-direction: row-reverse;
      justify-content: flex-end;
    }
    .alert {
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 4px;
    }
    .alert-success {
      background-color: #d4edda;
      color: #155724;
    }
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
    }
    .cruise-description {
      margin-top: 20px;
      background: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .inside-images-section {
      background: #f5f5f5;
      padding: 40px 0;
      margin: 30px 0;
    }
    .inside-image {
      margin-bottom: 20px;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16);
      height: 200px;
    }
    .inside-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    .inside-image:hover img {
      transform: scale(1.05);
    }
    .section-title {
      position: relative;
      margin-bottom: 30px;
      padding-bottom: 15px;
    }
    .section-title:after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: #007bff;
    }
  </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  <div class="site-wrap">
    <?php include_once("includes/navbar.php"); ?>

    <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
            <h1>Cruise Details</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <p><img src="admin/images/<?php echo htmlspecialchars($boat['Image']); ?>" alt="Cruise Image" class="img-fluid"></p>
          </div>
          <div class="col-md-5">
            <h3 class="heading-92913 text-black">Cruise Details</h3>
            <p><strong>Cruise Name:</strong> <?php echo htmlspecialchars($boat['BoatName']); ?></p>
            <p><strong>Size:</strong> <?php echo htmlspecialchars($boat['Size']); ?></p>
            <p><strong>Capacity:</strong> <?php echo htmlspecialchars($boat['Capacity']); ?> persons</p>
            <p><strong>Source:</strong> <?php echo htmlspecialchars($boat['Source']); ?></p>
            <p><strong>Destination:</strong> <?php echo htmlspecialchars($boat['Destination']); ?></p>
            <p><strong>Arrival Date/Time:</strong> <?php echo htmlspecialchars($boat['arrival_time']); ?></p>
            <p><strong>Departure date/Time:</strong> <?php echo htmlspecialchars($boat['departure_time']); ?></p>
            <p><strong>Route:</strong> <?php echo htmlspecialchars($boat['Route']); ?></p>
            <p><strong>Price:</strong> <?php echo htmlspecialchars($boat['Price']); ?> (per head)</p>
            <div class="form-group col-md-12">
              <a href="get_detail.php?id=<?php echo $boat['ID']; ?>" class="btn btn-primary py-3 px-5">Book Now</a>
            </div>
          </div>
        </div>

        <!-- Description Section -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="cruise-description">
              <h4 class="section-title text-black">Cruise Staff Detains</h4>
              <?php 
              $sql_sa = "SELECT * from staff where boat_id=$bid";
              $result_sa = mysqli_query($con, $sql_sa);
              $row_sa = mysqli_fetch_assoc($result_sa);
              ?>
              <p><strong>Captain Name:</strong> <?php echo htmlspecialchars($row_sa['captain_name']); ?></p>
              <p><strong>Manager By:</strong> <?php echo htmlspecialchars($row_sa['manager']); ?></p>
              <p><strong>Total Crew Members:</strong> <?php echo htmlspecialchars($row_sa['members']); ?></p>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="cruise-description">
              <h4 class="section-title text-black">Description</h4>
              <p><?php echo htmlspecialchars($boat['Description']); ?></p>
            </div>
          </div>
        </div>

        <!-- Inside Images Section -->
        <div class="inside-images-section">
          <div class="container">
            <div class="row">
              <div class="col-12 mb-4">
                <h3 class="section-title text-black">Inside The Cruise</h3>
              </div>
              <?php
              // Fetch inside images from the database
              $inside_images = [$boat['image1'], $boat['image2'], $boat['image3']]; // Add more if needed
              foreach ($inside_images as $image) {
                if (!empty($image)) {
                  echo '<div class="col-md-4 col-sm-6">
                          <div class="inside-image">
                            <a href="admin/images/' . htmlspecialchars($image) . '" data-fancybox="gallery">
                              <img src="admin/images/' . htmlspecialchars($image) . '" alt="Inside View" class="img-fluid">
                            </a>
                          </div>
                        </div>';
                }
              }
              ?>
            </div>
          </div>
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5">
          <div class="col-12">
            <h3 class="section-title text-black">Customer Reviews</h3>
            
            <?php
            // Calculate average rating
            $avgRatingQuery = mysqli_query($con, "SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews 
                                                  FROM tblreviews WHERE boat_id='$bid'");
            $avgRatingData = mysqli_fetch_assoc($avgRatingQuery);
            $avgRating = round($avgRatingData['avg_rating'], 1);
            $totalReviews = $avgRatingData['total_reviews'];
            
            if ($totalReviews > 0) {
            ?>
            <div class="mb-4">
              <div class="star-rating">
                <?php
                $fullStars = floor($avgRating);
                $halfStar = $avgRating - $fullStars >= 0.5;
                
                for ($i = 1; $i <= 5; $i++) {
                  if ($i <= $fullStars) {
                    echo '<i class="fas fa-star"></i>';
                  } elseif ($i == $fullStars + 1 && $halfStar) {
                    echo '<i class="fas fa-star-half-alt"></i>';
                  } else {
                    echo '<i class="far fa-star"></i>';
                  }
                }
                ?>
                <span class="ml-2"><?php echo $avgRating; ?> out of 5 (<?php echo $totalReviews; ?> reviews)</span>
              </div>
            </div>
            <?php } else { ?>
              <p>No reviews yet. Be the first to review!</p>
            <?php } ?>
            
            <!-- Display Reviews -->
            <?php
            if (mysqli_num_rows($reviews_query) > 0) {
              while ($review = mysqli_fetch_assoc($reviews_query)) {
            ?>
            <div class="review-item">
              <div class="review-header">
                <div>
                  <strong><?php echo htmlspecialchars($review['username']); ?></strong>
                  <div class="star-rating" style="font-size: 16px;">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                      if ($i <= $review['rating']) {
                        echo '<i class="fas fa-star"></i>';
                      } else {
                        echo '<i class="far fa-star"></i>';
                      }
                    }
                    ?>
                  </div>
                </div>
                <div class="review-date">
                  <?php echo date('F j, Y', strtotime($review['review_date'])); ?>
                </div>
              </div>
              <p><?php echo nl2br(htmlspecialchars($review['review_text'])); ?></p>
            </div>
            <?php
              }
            }
            ?>
            

            <!-- Review Form -->
            <div class="mt-5">
              <h4 class="section-title">Write a Review</h4>
              
              <?php if (isset($msg)) { ?>
              <div class="alert alert-success"><?php echo $msg; ?></div>
              <?php } ?>
              <?php if (isset($error)) { ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php } ?>
              
              <form method="post" action="">
                <div class="form-group">
                  <label for="username">Your Name</label>
                  <input type="text" class="form-control" id="username" name="username" 
                    value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                  <label>Your Rating</label>
                  <div class="rating-input">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1"><i class="fas fa-star"></i></label>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="review_text">Your Review</label>
                  <textarea class="form-control" id="review_text" name="review_text" rows="5" required></textarea>
                </div>
                
                <button type="submit" name="submit_review" class="btn btn-primary py-2 px-4">Submit Review</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include_once("includes/footer.php"); ?>
  </div>

  <!-- Scripts -->
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