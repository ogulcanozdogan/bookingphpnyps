<?php
include('inc/db.php'); // Veritabanı bağlantısını dahil ediyoruz

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    // Şifreyi hash'le
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Kullanıcıyı veritabanına ekleyelim
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $baglanti->prepare($sql);
    
    // Parametreleri bağlayalım
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $message = "Kullanıcı başarıyla kaydedildi!";
    } else {
        $message = "Bir hata oluştu: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center">Register</h3>
            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?= $message ?>
                </div>
            <?php endif; ?>
             <!-- <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form> -->
        </div>
    </div>
</div>
</body>
</html>
