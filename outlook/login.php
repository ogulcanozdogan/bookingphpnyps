<?php
session_start();
include('inc/db.php'); // Veritabanı bağlantısı dosyasını dahil ediyoruz

$message = '';
$captcha_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $captcha = $_POST['g-recaptcha-response']; // reCAPTCHA yanıtını al
    
    // reCAPTCHA doğrulama
    $secretKey = '6Le19xYqAAAAAKxktOYvrDul78IjwIxXlgOxwIRq';
    $url = "https://www.google.com/recaptcha/api/siteverify";
    
    // cURL ile reCAPTCHA doğrulaması
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'secret' => $secretKey,
        'response' => $captcha
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $responseKeys = json_decode($response, true);

    // reCAPTCHA doğrulama başarısızsa hata döndür
    if (!$responseKeys["success"] || (isset($responseKeys["score"]) && $responseKeys["score"] < 0.5)) {
        $captcha_error = "Lütfen CAPTCHA'yı tamamlayın.";
    } else {
        // Kullanıcıyı veritabanından sorgula
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $baglanti->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Şifreyi doğrula
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                
                // Kullanıcı izinlerine göre yönlendirme
                if ($user['perm'] === 'driver') {
                    header("Location: driver/index.php");
                    exit();
                }
                header("Location: index.php");
                exit();
            } else {
                $message = "Wrong password!";
            }
        } else {
            $message = "Wrong username!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://www.google.com/recaptcha/api.js?render=6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP"></script>
    <style>
        /* Body & background settings */
        body {
            background-color: #000;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
			animation: fadeIn 0.5s ease-in;
        }
		/* Fade-in animasyon tanımı */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Modal arka planı için animasyon */
.modal-backdrop {
    animation: fadeIn 0.3s ease-in-out;
}

/* Modal içeriği için büyüme efekti */
.modal-content {
    animation: scaleIn 0.3s ease-in-out;
}

/* Fade-in ve scale-in animasyon tanımları */
@keyframes scaleIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Genel geçiş efektleri */
* {
    transition: all 0.3s ease;
}


/* Butonlar için animasyon */
.btn {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

/* Tıklama efekti */
.btn:active {
    transform: scale(0.95);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Hover efekti */
.btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        /* Form container styling */
        .card {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 30px;
            padding: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-center h3 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            border-radius: 20px;
            padding: 15px;
        }
		    .grecaptcha-badge {
        visibility: visible !important;
        position: fixed;
        bottom: 10px;
        right: 10px;
        z-index: 1000;
    }
    </style>
</head>
<body>

<!-- Matrix Background -->
<canvas id="matrix"></canvas>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Login</h3>
                    </div>
                    <?php if ($message): ?>
                        <div class="alert alert-danger text-center">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>
                    <form id="loginForm" method="post">
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
						 <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var canvas = document.getElementById('matrix');
    var ctx = canvas.getContext('2d');

    // Canvas full screen
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // Characters for Matrix effect
    var letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    letters = letters.split('');

    var fontSize = 16;
    var columns = canvas.width / fontSize; // Number of columns for the rain
    var drops = [];

    // x-coordinate of drops
    for (var x = 0; x < columns; x++)
        drops[x] = 1; 

    // Drawing the characters
    function draw() {
        ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = '#00ff00'; // Green color for characters
        ctx.font = fontSize + 'px monospace';

        // Looping over the drops
        for (var i = 0; i < drops.length; i++) {
            var text = letters[Math.floor(Math.random() * letters.length)];
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);

            // Sending drop back to the top after it has reached the bottom
            if (drops[i] * fontSize > canvas.height && Math.random() > 0.975)
                drops[i] = 0;

            // Incrementing y-coordinate
            drops[i]++;
        }
    }

    setInterval(draw, 1);
</script>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
