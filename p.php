<?php
error_reporting(0);
session_start();
include('includes/config.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['uname']);
    $email = mysqli_real_escape_string($con, $_POST['emailid']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $user_id = $_SESSION['user_id'];

    // Image Upload Handling
    $profileImage = $row['profile_image']; // Default to existing image
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if not exists
        }

        $profileImage = time() . "_" . basename($_FILES['profile_image']['name']);
        $target_file = $target_dir . $profileImage;
        $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_types)) {
            $_SESSION['error'] = "Invalid image format. Allowed: JPG, JPEG, PNG, GIF.";
            header("Location: profile.php");
            exit();
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $_SESSION['error'] = "Failed to upload profile image.";
            header("Location: profile.php");
            exit();
        }
    }

    // Update user details in the database
    $update_sql = "UPDATE users SET username='$username', email='$email', phone='$mobile', city='$city', profile_image='$profileImage' WHERE id=$user_id";
    if (mysqli_query($con, $update_sql)) {
        $_SESSION['success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating profile: " . mysqli_error($con);
    }

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Boat Booking System || Booking Status</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Include all your CSS and JS files here -->
    <style>
        /* Your CSS styles here */
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
        <?php include_once("includes/navbar.php"); ?>

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
                                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
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
                                                <img src="uploads/<?php echo $row['profile_image']; ?>" alt="Profile Image" class="rounded-circle" width="120" height="120">
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
                                                    <input type="text" class="form-control" name="mobile" value="<?php echo $row['phone']; ?>" pattern="[0-9]{10}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- City Field -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                                    <input type="text" class="form-control" name="city" value="<?php echo $row['city']; ?>">
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

        <?php include_once("includes/footer.php"); ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/profile.js"></script>
</body>

</html>