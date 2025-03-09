<?php
session_start();

// Include database connection
require 'includes/config.php'; // Replace with your database connection file

$msg = "";

if(isset($_GET['email']))
{
    $encoded_email = $_GET['email'];

    $email = base64_decode($encoded_email); // Decode OTP from URL
    $msg = "<div class='alert alert-success'>An OTP has been sent to your email address.
    </div>";


if (isset($_POST['verify_otp'])) {
    $otp = trim($_POST['otp']);

    // Validate OTP
    if (empty($otp)) {
        $msg = "<div class='alert alert-danger'>Please enter the OTP.</div>";
    } else {
        // Check if the OTP exists in the database
        $query = "SELECT * FROM tbladmin WHERE otp = ? AND Email = ? ";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ss", $otp, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
            $_SESSION['aid'] = $row['ID'];
            $_SESSION['uname'] = $row['AdminuserName'];
            $_SESSION['emaiID'] = $row['Email'];
            $_SESSION['utype'] = $row['UserType'];
            // header("Location: dashboard.php"); // Redirect to password reset page
            echo "<script>alert('Login is Successfully.');
            document.location='dashboard.php';
            </script>";  
        }
        // exit();
        } else {
            // OTP is invalid
            $msg = "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
        }
    }
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
            <button type="submit" name="verify_otp">Verify OTP</button>
        </form>
    </div>
</body>

</html>