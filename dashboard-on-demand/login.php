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
    $secretKey = '6LfNEPApAAAAAANAmX6Vfoy1sKP-a_-e8SAXK7T9';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .gradient-custom-2 {
            background: #fccb90;
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }
        @media (max-width: 767px) {
            .gradient-form {
                padding: 15px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" style="width: 150px; height: 90px;" alt="logo">
                                <h3 class="mt-1 mb-5 pb-1">Login to Your Account</h3>
                            </div>
                            <?php
                            if (!empty($captcha_error)) {
                                echo "<div class='alert alert-danger' role='alert'>$captcha_error</div>";
                            }
                            ?>
                            <form method="post" role="form">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example11">Username</label>
                                    <input type="text" name="user" id="form2Example11" class="form-control" placeholder="Username" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example22">Password</label>
                                    <input type="password" name="pass" id="form2Example22" class="form-control"  placeholder="Password"/>
                                </div>
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" id="rememberMeondemand" checked="">
                                    <label class="form-check-label" for="rememberMeondemand"> Remember me </label>
                                </div>
                                <div class="form-outline mb-4">
                                    <div class="g-recaptcha" data-sitekey="6LfNEPApAAAAAAp5__6ariG_9U5PoK89QtRZH72_"></div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" ID="btnGiris" value="Sign in"/>
                            </form>
                        </div>
                        <a href="register.php" class="btn btn-primary">Create Driver Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php ob_flush(); ?>
