<?php
session_start();
// Database Connection
error_reporting(0);
include('includes/config.php');
$user_id = $_SESSION['user_id'];

// Handle form submission
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['uname']);
    $email = mysqli_real_escape_string($con, $_POST['emailid']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $city = mysqli_real_escape_string($con, $_POST['city']);

    // Fetch existing user data
    // Fetch existing profile image
    $query = mysqli_query($con, "SELECT image FROM users WHERE id='$user_id'");
    $row = mysqli_fetch_assoc($query);
    $profileImage = $row['profile_image']; // Retain existing image by default

    // Handle profile image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "admin/uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES['profile_image']['name']);
        $target_file = $target_dir . $file_name;
        $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_types)) {
            $_SESSION['error'] = "Invalid image format. Allowed: JPG, JPEG, PNG, GIF.";
            header("Location: profile.php");
            exit();
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $profileImage = $file_name; // Update image if upload succeeds
        } else {
            $_SESSION['error'] = "Failed to upload profile image.";
            header("Location: profile.php");
            exit();
        }
    }

    // Update user details without affecting image if not uploaded
    $update_sql = "UPDATE users SET username='$username', email='$email', phone='$mobile', city='$city'";

    // Append profile image update only if a new image was uploaded
    if (!empty($_FILES['profile_image']['name'])) {
        $update_sql .= ", image='$profileImage'";
    }

    $update_sql .= " WHERE id=$user_id";

    if (mysqli_query($con, $update_sql)) {
        $_SESSION['success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating profile: " . mysqli_error($con);
    }

    header("Location: profile.php");
    exit();


    //     // Update user details in the database
    //     $update_sql = "UPDATE users SET username='$username', email='$email', phone='$mobile', city='$city', image='$profileImage' WHERE id='$user_id'";
    //     if (mysqli_query($con, $update_sql)) {
    //         $_SESSION['success'] = "Profile updated successfully!";
    //     } else {
    //         $_SESSION['error'] = "Error updating profile: " . mysqli_error($con);
    //     }

    //     header("Location: profile.php");
    //     exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Cruise Booking System || Booking Status</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <!-- Bootstrap 5 CSS -->
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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/custon.css">
    <style>

    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
           <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <div class="header-top bg-light">
        <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="col-6 col-lg-3">
                        <a href="index.php">
                            <img src="images/logo.png" alt="Image" class="img-fluid">
                        </a>
                    </div>
                    <div class="mx-auto">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
                                <li class="active">
                                    <a href="index.php" class="nav-link text-left">Home</a>
                                </li>
                                <li><a href="about.php" class="nav-link text-left">About Us</a></li>

                                <li>
                                    <a href="status.php" class="nav-link text-left">Booking Status</a>
                                </li>
                                <li><a href="services.php" class="nav-link text-left">Cruise Services</a></li>

                                <li><a href="contact.php" class="nav-link text-left">Contact</a></li>

                                <?php if (isset($_SESSION['username'])): ?>
                                    <!-- User Dropdown when logged in -->
                                    <li class="nav-item dropdown ms-lg-3">
                                        <a class="nav-link dropdown-toggle btn btn-outline-primary rounded-pill px-3" href="#"
                                            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['username']; ?>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                                            <li><a class="dropdown-item" href="my_ticket.php"><i class="fas fa-ticket-alt me-2"></i>My Tickets</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <!-- Login Button when not logged in -->
                                    <li class="nav-item ms-lg-3">
                                        <a class="nav-link btn btn-primary text-white rounded-pill px-3" href="login.php">
                                            <i class="fas fa-sign-in-alt me-1"></i> Login
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- Add Font Awesome for icons if not already included -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->

<!-- Make sure you're using Bootstrap 5 JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

<!-- Mobile Menu Script -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle functionality
    const mobileMenuToggle = document.querySelector('.navbar-toggler');
    const mobileMenu = document.querySelector('.site-mobile-menu');
    const mobileMenuClose = document.querySelector('.site-mobile-menu-close');
    
    if (mobileMenuToggle && mobileMenu && mobileMenuClose) {
      mobileMenuToggle.addEventListener('click', function() {
        mobileMenu.classList.add('show');
        document.body.style.overflow = 'hidden';
      });
      
      mobileMenuClose.addEventListener('click', function() {
        mobileMenu.classList.remove('show');
        document.body.style.overflow = '';
      });
    }
    
    // Clone navigation for mobile menu
    const navItems = document.querySelectorAll('.navbar-nav > .nav-item');
    const mobileMenuBody = document.querySelector('.site-mobile-menu-body');
    
    if (navItems.length > 0 && mobileMenuBody) {
      const mobileNav = document.createElement('ul');
      mobileNav.className = 'nav flex-column';
      
      navItems.forEach(item => {
        const clone = item.cloneNode(true);
        mobileNav.appendChild(clone);
      });
      
      mobileMenuBody.appendChild(mobileNav);
    }
  });
</script>

        <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>User Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="profile-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="profile-card">
                            <div class="profile-header">
                                <h3><i class="fas fa-user-circle me-2"></i>User Profile</h3>
                                <div class="profile-status">
                                    Active Member
                                </div>
                            </div>

                            <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['success'];
                                    unset($_SESSION['success']); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['error'];
                                    unset($_SESSION['error']); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php
                            $u_name = $_SESSION['username'];
                            $sql = "SELECT * FROM users WHERE username='$u_name'";
                            $result = mysqli_query($con, $sql);
                            if ($row = mysqli_fetch_assoc($result)):
                            ?>
                                <form method="post" class="needs-validation" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <!-- Profile Image Upload -->
                                        <div class="col-12 text-center">
                                            <label class="form-label">Profile Picture</label>
                                            <div class="mb-3">
                                                <img src="admin/uploads/<?php echo $row['image']; ?>" alt="Profile Image" class="rounded-circle" width="120" height="120">
                                            </div>
                                            <input type="file" class="form-control" name="profile_image" accept="image/*">
                                        </div>

                                        <!-- Username Field -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" class="form-control" name="uname" value="<?php echo $row['username']; ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email Field -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    <input type="email" class="form-control" name="emailid" value="<?php echo $row['email']; ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mobile Number Field -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Mobile Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    <input type="text" class="form-control" name="mobile" value="<?php if ($row['phone']) {
                                                                                                                        echo $row['phone'];
                                                                                                                    } ?>" placeholder="Enter Mobile umber" pattern="[0-9]{10}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- City Field -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                                    <input type="text" class="form-control" name="city" value="<?php if ($row['city']) {
                                                                                                                        echo $row['city'];
                                                                                                                    } ?>" placeholder="Enter City">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="col-12 mt-4">
                                            <div class="d-flex gap-3">
                                                <button type="submit" name="submit" class="btn btn-update text-white">
                                                    <i class="fas fa-save me-2"></i>Update Profile
                                                </button>
                                                <a href="change-password.php" class="btn btn-password text-white">
                                                    <i class="fas fa-key me-2"></i>Change Password
                                                </a>
                                                <a href="my_ticket.php" class="btn btn-password text-white">
                                                <i class="fa-solid fa-ticket"></i>View all Booking
                                                </a>
                                                <a href="pay_history.php" class="btn btn-password text-white">
                                                    <i class="fa-solid fa-money-bill"></i>Payments
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
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



        <!-- Loading Overlay -->
        <div class="loading-overlay">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <?php include_once("includes/footer.php"); ?>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/profile.js"></script>


        <?php include_once("includes/footer.php"); ?>


    </div>
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
    $(document).ready(function() {
        // Form validation
        const validateForm = () => {
            let isValid = true;
            const email = $('input[name="emailid"]').val();
            const username = $('input[name="uname"]').val();

            // Email validation
            if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                showError('Please enter a valid email address');
                isValid = false;
            }

            // Username validation
            if (username.length < 3) {
                showError('Username must be at least 3 characters long');
                isValid = false;
            }

            return isValid;
        };

        // Show error message
        const showError = (message) => {
            const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
            $('.profile-card').prepend(alertHtml);
        };

        // Show success message
        const showSuccess = (message) => {
            const alertHtml = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
            $('.profile-card').prepend(alertHtml);
        };

        // Loading overlay
        const showLoading = () => {
            $('.loading-overlay').addClass('active');
        };

        const hideLoading = () => {
            $('.loading-overlay').removeClass('active');
        };

        // Form submission

    });
</script>

</html>