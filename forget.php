<?php
session_start();

// Include database connection
require 'includes/config.php'; // Replace with your database connection file

$msg = "";

if (isset($_GET['code']) && $_GET['email']) {
    $encoded_otp = $_GET['code'];
    $encoded_email = $_GET['email'];

    $otp = base64_decode($encoded_otp); // Decode OTP from URL
    $email = base64_decode($encoded_email); // Decode OTP from URL


    // Check if the OTP exists in the database
    $query = "SELECT * FROM users WHERE otp = ? AND email= ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $otp, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // OTP is valid, allow password reset
        $msg = "<div class='alert alert-success'>OTP verified. You can now reset your password.</div>";

        if (isset($_POST['reset_password'])) {
            $new_password = trim($_POST['new_password']);
            $confirm_password = trim($_POST['confirm_password']);

            // Validate passwords
            if (empty($new_password) || empty($confirm_password)) {
                $msg = "<div class='alert alert-danger'>Please fill in all fields.</div>";
            } elseif ($new_password !== $confirm_password) {
                $msg = "<div class='alert alert-danger'>Passwords do not match.</div>";
            } else {
                // Hash the new password for security
                $hashed_password = md5($new_password);

                // Update the password in the database
                $query = "UPDATE users SET password = ?, otp = NULL WHERE otp IS NOT NULL AND email=?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $msg = "<div class='alert alert-success'>Password reset successfully.</div>";
                    header("Location: login.php?msg='verify'");
                } else {
                    $msg = "<div class='alert alert-danger'>Failed to reset password. Please try again.</div>";
                }
            }
        }
    } else {
        // OTP is invalid
        echo "<script>alert('Invalid OTP. Please try again.');
        window.location.href='change_password.php';
        </scrip>";
        // $msg = "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
        // header("Location: otp_verify.php");
    }
} else {
    // Redirect if no OTP code is provided
    header("Location: otp_verify.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 1.8rem;
        }

        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
        }

        input[type="password"]:focus {
            border-color: #6a11cb;
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #2575fc;
        }

        .alert {
            padding: 0.8rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert a {
            color: #155724;
            text-decoration: underline;
        }

        .alert a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <?php echo $msg; ?>
        <form action="" method="post">
            <input type="password" name="new_password" placeholder="Enter New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit" name="reset_password">Reset Password</button>
        </form>
    </div>
</body>

</html>