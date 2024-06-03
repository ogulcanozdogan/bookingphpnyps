<?php
ob_start();
session_start(); 
error_reporting(E_ALL);
ini_set("display_errors", 1); // Hataları göster

include("inc/vt.php"); // Veritabanı bağlantısı

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
    <title>Register | New York Pedicab Services</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
            background: #e9ecef; /* Bootstrap input background rengi */
            border: 1px solid #ced4da; /* Bootstrap input border rengi */
            color: #495057; /* Bootstrap input text rengi */
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem; /* Bootstrap input paddingi */
            margin-right: -1px; /* İki alan arasındaki çizgiyi kaldırır */
            border-top-left-radius: 0.25rem; /* Sol üst köşeyi yuvarlak yapar */
            border-bottom-left-radius: 0.25rem; /* Sol alt köşeyi yuvarlak yapar */
        }
        input[type="tel"] {
            border-top-right-radius: 0.25rem; /* Sağ üst köşeyi yuvarlak yapar */
            border-bottom-right-radius: 0.25rem; /* Sağ alt köşeyi yuvarlak yapar */
        }
        .flag-img {
            width: 20px; /* Bayrak genişliği */
            margin-right: 5px; /* Bayrak ve +1 arasındaki boşluk */
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
                                <h3 class="mt-1 mb-5 pb-1">Register Pedicab Driver Account</h3>
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
                                <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" value="Register"/>
                            </form>
                            <?php 
                            if ($_POST) {
                                $user = $_POST['user'];					
                                $email = $_POST['email'];	
                                $number = $_POST['number'];	
                                $name = $_POST['name'];	
                                $surname = $_POST['surname'];	
                                $pass = $_POST['pass'];	

                                // Kayıt yapılıp yapılmayacağını kontrol etmek için bir değişken
                                $is_valid = true;

                                // Kullanıcı adı kontrolü
                                $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
                                $sorgu->execute(['user' => $user]);
                                if ($sorgu->rowCount() > 0) {
                                    echo "<font color='red'><strong>Error: This username is already in use!</strong></font>";
                                    $is_valid = false; // Hata varsa kayıt durdurulur
                                }

                                // Email kontrolü
                                $sorgu = $baglanti->prepare("SELECT * FROM users WHERE email=:email");
                                $sorgu->execute(['email' => $email]);
                                if ($sorgu->rowCount() > 0) {
                                    echo "<font color='red'><strong>Error: This email address is already in use!</strong></font>";
                                    $is_valid = false; // Hata varsa kayıt durdurulur
                                }

                                // Telefon numarası kontrolü
                                $sorgu = $baglanti->prepare("SELECT * FROM users WHERE number=:number");
                                $sorgu->execute(['number' => $number]);
                                if ($sorgu->rowCount() > 0) {
                                    echo "<font color='red'><strong>Error: This phone number is already in use!</strong></font>";
                                    $is_valid = false; // Hata varsa kayıt durdurulur
                                }

                                if ($is_valid){
                                    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                                    $satir = [
                                        'user' => $user,
                                        'pass' => $hashed_pass,
                                        'name' => $name,
                                        'surname' => $surname,
                                        'email' => $email,
                                        'number' => $number
                                    ];

                                    $sql = "INSERT INTO users (user, pass, name, surname, email, number) VALUES (:user, :pass, :name, :surname, :email, :number)";
                                    $stmt = $baglanti->prepare($sql);
                                    try {
                                        $durum = $stmt->execute($satir);
                                        if ($durum) {
                                            echo '<script>swal("Successful","Registration successful.","success").then((value)=>{ window.location.href = "login.php"});</script>';
                                        } else {
                                            echo "SQL Error: " . implode(", ", $stmt->errorInfo()) . "<br>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "PDO Exception: " . $e->getMessage() . "<br>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        <a href="login.php" class="btn btn-primary">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const phoneNumberInput = document.getElementById('phoneNumber');

        phoneNumberInput.addEventListener('input', function (event) {
            let input = event.target.value.replace(/[^\d]/g, ''); // Sadece rakamları kabul et
            if (input.length > 10) {
                input = input.substr(0, 10); // Maksimum 10 rakam
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
