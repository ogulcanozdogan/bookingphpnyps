<?php
ob_start();
session_start();
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <style>
        .gradient-custom-2 {
            background: #fccb90;
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
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
                                <a href="login.php" class="btn btn-secondary sign-in-button"><- Sign In</a>
                                <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" style="width: 150px; height: 90px;" alt="logo">
                                <h3 class="mt-1 mb-5 pb-1">Create Pedicab Driver Account</h3>
                            </div>
                            <form method="post">
                                <div class="form-outline mb-4">
                                    <input type="text" name="name" id="form2Example11" class="form-control" placeholder="Name" required/>
                                    <label class="form-label" for="form2Example11">Name</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" name="surname" id="form2Example11" class="form-control" placeholder="Surname" required/>
                                    <label class="form-label" for="form2Example11">Surname</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" name="user" id="form2Example11" class="form-control" placeholder="Username" required/>
                                    <label class="form-label" for="form2Example11">Username</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" name="pass" id="form2Example33" class="form-control" required/>
                                    <label class="form-label" for="form2Example33">Password</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="form2Example22" class="form-control" placeholder="Email" required/>
                                    <label class="form-label" for="form2Example22">Email</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <div class="phone-container">
                                        <div class="input-group-text prefix">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" class="flag-img" alt="USA Flag">
                                            +1
                                        </div>
                                        <input type="tel" id="phoneNumber" name="number" class="form-control" placeholder="Your Phone Number" required/>
                                    </div>
                                    <label for="phoneNumber">Phone Number</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <div class="g-recaptcha" data-sitekey="6LfNEPApAAAAAAp5__6ariG_9U5PoK89QtRZH72_"></div>
                                </div>
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
                                $secretKey = '6LfNEPApAAAAAANAmX6Vfoy1sKP-a_-e8SAXK7T9';
                                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
                                $responseKeys = json_decode($response, true);

                                if(intval($responseKeys["success"]) !== 1) {
                                    echo '<script>swal("Error","Please complete the CAPTCHA","error");</script>';
                                } else {
                                    // Variable to check if registration is allowed
                                    $is_valid = true;

                                    // Check username
                                    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
                                    $sorgu->execute(['user' => $user]);
                                    if ($sorgu->rowCount() > 0) {
                                        echo '<script>swal("Error","This username is already in use!","error");</script>';
                                        $is_valid = false; // Stop registration if there's an error
                                    }

                                    // Check email
                                    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE email=:email");
                                    $sorgu->execute(['email' => $email]);
                                    if ($sorgu->rowCount() > 0) {
                                        echo '<script>swal("Error","This email address is already in use!","error");</script>';
                                        $is_valid = false; // Stop registration if there's an error
                                    }

                                    // Check phone number
                                    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE number=:number");
                                    $sorgu->execute(['number' => $number]);
                                    if ($sorgu->rowCount() > 0) {
                                        echo '<script>swal("Error","This phone number is already in use!","error");</script>';
                                        $is_valid = false; // Stop registration if there's an error
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
                </div>
            </div>
        </div>
    </section>
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
    </script>
</body>
</html>
<?php ob_flush(); ?>
