 <?php
session_start();

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload and database connection
require 'vendor/autoload.php'; // Ensure you have PHPMailer installed via Composer
include 'includes/config.php'; // Replace with your database connection file

$msg = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);

    // Validate email
    if (empty($email)) {
        $msg = "<div class='alert alert-danger'>Please enter your email address.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger'>Invalid email format.</div>";
    } else {
        // Check if the email exists in the database
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Generate a random 6-digit OTP
            $otp = rand(100000, 999999);

            // Save the OTP in the database
            $update_query = "UPDATE users SET otp = ? WHERE email = ?";
            $stmt = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt, "is", $otp, $email);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Send OTP via email using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output for production
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com'; // SMTP server
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '@gmail.com'; // Your Gmail address
                    $mail->Password   = '';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
                    $mail->Port       = 465; // TCP port

                    // Recipients
                    $mail->setFrom('@gmail.com', 'form cruisebooks.org');
                    $mail->addAddress($email);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'OTP for Password Reset';
                    $mail->Body    = "Your OTP for password reset is: <b>$otp</b>";

                    $mail->send();

                    $encoded_email = base64_encode($email); // Encode OTP for URL

                    $msg = "<div class='alert alert-success'>An OTP has been sent to your email address.
                    </div>";
                    header("Location: otp_verify.php?email=$encoded_email");

                } catch (Exception $e) {
                    $msg = "<div class='alert alert-danger'>Failed to send OTP. Please try again later.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Failed to update OTP. Please try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email address not found.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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

        input[type="email"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
        }

        input[type="email"]:focus {
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
        <h2>Forgot Password</h2>
        <?php echo $msg; ?>
        <form action="" method="post">
            <input type="email" name="email" placeholder="Enter Your Email" required>
            <button type="submit" name="submit">Send OTP</button>
        </form>
    </div>
</body>
</html>