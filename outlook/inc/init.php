<?php
// init.php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    session_set_cookie_params([
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict' // veya 'Lax', uygulamanıza göre değişir.
    ]);
} else {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Strict' // veya 'Lax', uygulamanıza göre değişir.
    ]);
}

session_name('outlook');
session_start();
?>