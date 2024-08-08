<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1); // Show errors

include("inc/vt.php"); // Database connection

if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | New York Pedicab Services</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP"></script>
    <script src="assets/js/sweetalert.min.js"></script>
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
            width: 100%;
            max-width: 500px;
        }
        .card-body {
            padding: 2rem;
        }
        .form-outline {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-control:focus::placeholder {
            color: transparent;
        }
        .form-control::placeholder {
            transition: all 0.3s;
        }
        .form-control:focus::placeholder {
            font-size: 12px;
            transform: translateY(-20px);
            color: #007bff;
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
        .phone-container {
            display: flex;
            align-items: center;
        }
        .prefix {
            background: #e9ecef;
            border: 1px solid #ced4da;
            color: #495057;
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-right: -1px;
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        input[type="tel"] {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }
        .flag-img {
            width: 20px;
            margin-right: 5px;
        }
        .sign-in-button {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 0.9em;
            padding: 5px 10px;
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
                <a href="login.php" class="btn btn-secondary sign-in-button"><- Sign In</a>
                <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" style="width: 200px; height: 90px;" alt="logo">
                <h3 class="mt-1 mb-5 pb-1">Create Pedicab Driver Account</h3>
            </div>
            <form id="registerForm" method="post">
                <div class="form-outline mb-4">
                    <input type="text" name="name" id="form2Example11" class="form-control" placeholder="Name" aria-label="Name" required/>
                </div>
                <div class="form-outline mb-4">
                    <input type="text" name="surname" id="form2Example12" class="form-control" placeholder="Surname" aria-label="Surname" required/>
                </div>
                <div class="form-outline mb-4">
                    <input type="text" name="user" id="form2Example13" class="form-control" placeholder="Username" aria-label="Username" required/>
                </div>
                <div class="form-outline mb-4">
                    <input type="password" name="pass" id="form2Example14" class="form-control" placeholder="Password" aria-label="Password" required/>
                </div>
                <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example15" class="form-control" placeholder="Email" aria-label="Email" required/>
                </div>
                <div class="form-outline mb-4">
                    <div class="phone-container">
                        <div class="input-group-text prefix">
                            <img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" class="flag-img" alt="USA Flag">
                            +1
                        </div>
                        <input type="tel" id="phoneNumber" name="number" class="form-control" placeholder="Your Phone Number" aria-label="Phone Number" required/>
                    </div>
                </div>
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" value="Create Account"/>
            </form>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user = $_POST['user'];
                $email = $_POST['email'];
                $number = $_POST['number'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $pass = $_POST['pass'];
                $captcha = $_POST['g-recaptcha-response'];

                // reCAPTCHA validation
                $secretKey = '6Le19xYqAAAAAKxktOYvrDul78IjwIxXlgOxwIRq';
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
                $responseKeys = json_decode($response, true);

                if ($responseKeys["success"] !== true || $responseKeys["score"] < 0.5) {
                    echo '<script>swal("Error","Please complete the CAPTCHA","error");</script>';
                } else {
                    // Variable to check if the registration should proceed
                    $is_valid = true;

                    // Check if name and surname contain only letters and no special characters
                    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
                        echo '<script>swal("Error", "Name can only contain letters.", "error").then((value)=>{ window.location.href = "register.php"});</script>';
                        $is_valid = false;
                    }
                    if (!preg_match("/^[a-zA-Z]+$/", $surname)) {
                        echo '<script>swal("Error", "Surname can only contain letters.", "error").then((value)=>{ window.location.href = "register.php"});</script>';
                        $is_valid = false;
                    }
                    
                    // Check if username is at least 5 characters and does not contain special characters
                    if (strlen($user) < 5 || preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $user)) {
                        echo '<script>swal("Error", "Username must be at least 5 characters long and cannot contain special characters.", "error").then((value)=>{ window.location.href = "register.php"});</script>';
                        $is_valid = false;
                    }

                    // Check if password is at least 8 characters long, contains at least one letter and one number, and does not contain special characters
                    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $pass) || preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $pass)) {
                        echo '<script>swal("Error", "Password must be at least 8 characters long, contain at least one letter and one number, and cannot contain special characters.", "error").then((value)=>{ window.location.href = "register.php"});</script>';
                        $is_valid = false;
                    }

                    // Check if phone number is at least 10 digits long
                    if (strlen($number) < 10) {
                        echo '<script>swal("Error", "Phone number must be at least 10 digits long.", "error").then((value)=>{ window.location.href = "register.php"});</script>';
                        $is_valid = false;
                    }

                    // Validate email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match("/[\'^£$%&*()}{#~?><>,|=_+¬-]/", $email)) {
                        echo '<script>swal("Error", "Invalid email address.", "error").then((value)=>{ window.location.href = "register.php"});</script>';
                        $is_valid = false;
                    }

                    // Check username
                    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
                    $sorgu->execute(['user' => $user]);
                    if ($sorgu->rowCount() > 0) {
                        echo '<script>swal("Error","This username is already in use!","error").then((value)=>{ window.location.href = "register.php"});</script>';
                        $is_valid = false;
                    }

                    if ($is_valid) {
                        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                        $satir = [
                            'user' => $user,
                            'pass' => $hashed_password,
                            'name' => $name,
                            'surname' => $surname,
                            'email' => $email,
                            'number' => $number
                        ];

                        $sql = "INSERT INTO users_temporary (user, pass, name, surname, email, number) VALUES (:user, :pass, :name, :surname, :email, :number)";
                        $stmt = $baglanti->prepare($sql);
                        
                        try {
                            $durum = $stmt->execute($satir);
                            if ($durum) {
                                echo '<script>swal("Successful","Registration successful. Please contact the administrator to activate your driver account.","success").then((value)=>{ window.location.href = "login.php"});</script>';
                            } else {
                                echo "SQL Error: " . implode(", ", $stmt->errorInfo()) . "<br>";
                            }
                        } catch (PDOException $e) {
                            echo "PDO Exception: " . $e->getMessage() . "<br>";
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const phoneNumberInput = document.getElementById('phoneNumber');

        phoneNumberInput.addEventListener('input', function (event) {
            let input = event.target.value.replace(/[^\d]/g, ''); // Only accept digits
            if (input.length > 10) {
                input = input.substr(0, 10); // Maximum 10 digits
            }

            let formattedInput = '';
            if (input.length > 6) {
                formattedInput = `(${input.substr(0, 3)}) ${input.substr(3, 3)}-${input.substr(6)}`;
            } else if (input.length > 3) {
                formattedInput = `(${input.substr(0, 3)}) ${input.substr(3)}`;
            } else {
                formattedInput = input;
            }

            event.target.value = formattedInput; // Formatted value
        });

        const form = phoneNumberInput.closest('form');

        form.addEventListener('submit', function (e) {
            const rawNumber = phoneNumberInput.value.replace(/\D/g, '');
            phoneNumberInput.value = rawNumber;
        });

        grecaptcha.ready(function() {
            document.getElementById('registerForm').addEventListener('submit', function(event) {
                event.preventDefault();
                grecaptcha.execute('6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP', {action: 'register'}).then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    document.getElementById('registerForm').submit();
                });
            });
        });
    </script>
</body>
</html>
<?php ob_flush(); ?>
