<?php
// session_start();
// Database Connection
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/custom.css">

<style>
    /* Gallery Styling */
    .gallery-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Explicit 3-column layout on desktop */
        gap: 1.5rem;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .gallery-item {
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
        display: block;
    }

    /* Responsive Adjustments */
    @media (max-width: 1024px) {
        .gallery-container {
            grid-template-columns: repeat(2, 1fr); /* 2 columns on tablets */
        }
    }

    @media (max-width: 768px) {
        .gallery-container {
            grid-template-columns: 1fr; /* 1 column on mobile */
        }

        .gallery-item img {
            height: 200px; /* Reduce height on mobile */
        }
    }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <?php include_once("includes/navbar.php"); ?>

        <div class="intro-section" style="background-image: url('images/hero_2.jpg');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>Gallery</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <!-- Gallery Section -->
                    <div class="col-12 text-center mb-5" data-aos="fade-up">
                        <h2>Explore Our Cruise Gallery</h2>
                        <p>Discover stunning views and luxurious experiences aboard our cruises.</p>
                    </div>

                    <div class="gallery-container">
                        <?php 
                            // Fetch all images from the gallery folder
                            $images = glob("gallery/*.jpg"); // You can also include other formats like *.png, *.jpeg
                            if (!empty($images)) {
                                foreach ($images as $image) {
                                    $imageName = basename($image); // Get the filename for alt text
                                    ?>
                                    <a href="<?php echo htmlspecialchars($image); ?>" data-fancybox="gallery" class="gallery-item">
                                        <img src="<?php echo htmlspecialchars($image); ?>" alt="Cruise Image - <?php echo htmlspecialchars($imageName); ?>">
                                    </a>
                                <?php 
                                }
                            } else {
                                echo "<p>No images found in the gallery folder.</p>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once("includes/footer.php"); ?>
    

    </div>
    <!-- .site-wrap -->

    <!-- loader -->
    <div id="loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15" />
        </svg>
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
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox({
                loop: true,
                buttons: ["zoom", "slideShow", "fullScreen", "close"]
            });
        });
    </script>

</body>
</html>