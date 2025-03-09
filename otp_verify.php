<?php
session_start();

// Include database connection
require 'includes/config.php'; // Replace with your database connection file

// reCAPTCHA keys
// $siteKey = 'AASRV3dl6LdNQu4qAAAAA_Yxi4Lmrzxgz5SdC8Awb';
$siteKey = 'YOUR_SITE_KEY_HERE';
// $secretKey = '6LdNDMFBFwd3eJxymF6hi8hsOe9tdfpgd';
$secretKey = 'YOUR_SECRET_KEY_HERE';

$msg = "";
if(isset($_GET['email']))
{
    $encoded_email = $_GET['email'];

    $email = base64_decode($encoded_email); // Decode OTP from URL
    $msg = "<div class='alert alert-success'>An OTP has been sent to your email address.
    </div>";

    if (isset($_REQUEST['verify_otp']) && $_POST['g-recaptcha-response']) {
        $otp = trim($_POST['otp']);
        $gRecaptchaResponse = $_POST['g-recaptcha-response'];

        // Validate OTP
        if (empty($otp)) {
            $msg = "<div class='alert alert-danger'>Please enter the OTP.</div>";
        } else {
            // Validate reCAPTCHA
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $gRecaptchaResponse);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                // Check if the OTP exists in the database
                $query = "SELECT * FROM users WHERE otp = ? AND email = ? ";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "ss", $otp,$email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    // OTP is valid
                    $encoded_otp = base64_encode($otp); // Encode OTP for URL
                    $encoded_email = base64_encode($email); // Encode email for URL

                    header("Location: forget.php?code=$encoded_otp&&email=$encoded_email"); // Redirect to password reset page
                    exit();
                } else {
                    // OTP is invalid
                    $msg = "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Invalid reCAPTCHA. Please try again.</div>";
            }
        }
    }
    else
    {
        echo "<script>alert('reCAPTCHA ERROR');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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

        input[type="text"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
        }

        input[type="text"]:focus {
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
    </style>
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <?php echo $msg; ?>
        <form action="" method="post">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
            <button type="submit" name="verify_otp">Verify OTP</button>
        </form>
    </div>
</body>
</html>
