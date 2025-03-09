<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <?php session_start(); ?>


    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <div class="header-top bg-light">
        <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-1 d-lg-block" role="banner">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="col-6 col-lg-1">
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
                                    <a href="status.php" class="nav-link text-left">Book Status</a>
                                </li>
                                <li><a href="services.php" class="nav-link text-left">Cruise</a></li>

                                <li><a href="contact.php" class="nav-link text-left">Contact</a></li>
                                <li><a href="gallery.php" class="nav-link text-left">Gallery</a></li>
                                <li><a href="blogs.php" class="nav-link text-left">Blogs</a></li>
                                
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
                                            <li><a class="dropdown-item" href="pay_history.php"><i class="fa-solid fa-money-check-dollar"></i>My Payment</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                <li><a href="register.php" class="nav-link text-left">Register</a></li>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Make sure you're using Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
