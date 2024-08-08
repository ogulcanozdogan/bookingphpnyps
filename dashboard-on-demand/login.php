<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1); // Display errors

include("inc/vt.php"); // Database connection

// If there's an existing session, redirect to the index page
if (isset($_SESSION["Oturumondemand"]) && $_SESSION["Oturumondemand"] == "6789ondemand") {
    header("location:available.php");
    exit();
} 
// If "remember me" was previously selected, create a session and redirect
else if (isset($_COOKIE["cerezondemand"])) {
    // Query to fetch usernames
    $sorgu = $baglanti->prepare("SELECT user FROM users");
    $sorgu->execute();

    // Loop through the usernames
    while ($sonuc = $sorgu->fetch()) {
        // Check if the user matches the stored cookie
        if ($_COOKIE["cerezondemand"] == md5("aaondemand" . $sonuc['user'] . "bbondemand")) {
            // Create session
            $_SESSION["Oturumondemand"] = "6789ondemand";
            $_SESSION["user"] = $sonuc['user'];

            // Redirect to the index page
            header("location:available.php");
            exit();
        }
    }
}

// Check if the login form is submitted
$captcha_error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST["user"]; // Store the username in a variable
    $pass = $_POST["pass"]; // Store the password in a variable
    $captcha = $_POST['g-recaptcha-response']; // Get the reCAPTCHA response

    // reCAPTCHA validation
    $secretKey = '6Le19xYqAAAAAKxktOYvrDul78IjwIxXlgOxwIRq';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"] !== true || $responseKeys["score"] < 0.5) {
        $captcha_error = "Please complete the CAPTCHA.";
    } else {
        // Query to fetch the password for the given username
        $sorgu = $baglanti->prepare("SELECT pass FROM users WHERE user=:user");
        $sorgu->execute(['user' => htmlspecialchars($user)]);
        $sonuc = $sorgu->fetch(); // Execute the query and fetch the result

        // Verify the password
        if ($sonuc && password_verify($pass, $sonuc["pass"])) {
            $_SESSION["Oturumondemand"] = "6789ondemand"; // Create session
            $_SESSION["user"] = $user;

            // If "remember me" is selected, create a cookie
            if (isset($_POST["rememberMeondemand"])) {
                setcookie("cerezondemand", md5("aaondemand" . $user . "bbondemand"), time() + (60 * 60 * 24 * 7));
            }
            header("location:available.php"); // Redirect to the index page
            exit();
        } else {
            // If the username or password is incorrect, display an error message
            $captcha_error = "The username or password is wrong!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | New York Pedicab Services</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP"></script>
    <style>
        body {
            background: linear-gradient(to right, #0062E6, #33AEFF);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .form-outline {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-outline label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            background: white;
            padding: 0 5px;
            color: #999;
            transition: all 0.3s;
        }
        .form-control:focus + label,
        .form-control:not(:placeholder-shown) + label {
            top: -5px;
            left: 10px;
            font-size: 12px;
            color: #007bff;
        }
        .form-check-label {
            margin-left: 5px;
        }
        .btn-primary {
            background: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .gradient-custom-2 {
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            color: white;
            border: none;
        }
        .gradient-custom-2:hover {
            background: linear-gradient(to right, #d8363a, #ee7724, #b44593, #dd3675);
        }
        @media (max-width: 767px) {
            .card {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" style="width: 200px; height: 90px;" alt="logo">
                <h3 class="mt-1 mb-5 pb-1">Login to Your Account</h3>
            </div>
            <?php
            if (!empty($captcha_error)) {
                echo "<div class='alert alert-danger' role='alert'>$captcha_error</div>";
            }
            ?>
            <form id="loginForm" method="post" role="form">
                <div class="form-outline">
                    <input type="text" name="user" id="form2Example11" class="form-control" placeholder=" " required />
                    <label class="form-label" for="form2Example11">Username</label>
                </div>
                <div class="form-outline">
                    <input type="password" name="pass" id="form2Example22" class="form-control" placeholder=" " required />
                    <label class="form-label" for="form2Example22">Password</label>
                </div>
                <div class="form-check d-flex justify-content-start mb-4">
                    <input class="form-check-input" type="checkbox" name="rememberMeondemand" id="rememberMeondemand">
                    <label class="form-check-label" for="rememberMeondemand"> Remember me </label>
                </div>
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <button type="submit" class="btn btn-primary btn-block gradient-custom-2 mb-3" id="btnGiris">Sign in</button>
            </form>
            <a href="register.php" class="btn btn-primary">Create Driver Account</a>
        </div>
    </div>
    <script>
        grecaptcha.ready(function() {
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                event.preventDefault();
                grecaptcha.execute('6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP', {action: 'login'}).then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    document.getElementById('loginForm').submit();
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
