<?php
ob_start();
		session_start(); 
error_reporting(E_ALL);
ini_set("display_errors", 0);
include("inc/vt.php"); //veri tabanına bağlandık 

//eğer mevcut oturum varsa sayfayı yönlendiriyoruz.
if (isset($_SESSION["Oturumondemand"]) && $_SESSION["Oturumondemand"] == "6789ondemand") {
    header("location:index.php");
} //eğer önceden beni hatırla işaretlenmiş ise oturum oluşturup sayfayı yönlendiriyoruz.
else if (isset($_COOKIE["cerezondemand"])) {
    //Kullanıcı adlarını çeken sorgumuz
	
	 $sorgu = $baglanti->prepare("select user from users");
    $sorgu->execute();

   

    //Kullanıcı adlarını döngü yardımı ile tek tek elde ediyoruz
    while ($sonuc = $sorgu->fetch()) {
        //eğer bizim belirlediğimiz yapıya uygun kullanıcı var mı diye bakıyoruz.
        if ($_COOKIE["cerezondemand"] == md5("aaondemand" . $sonuc['user'] . "bbondemand")) {

            //oturum oluşturma buradaki değerleri güvenlik açısından
            //farklı değerler yapabilirsiniz
            //aynı zamanda kullanıcı adınıda burada tuttum
            $_SESSION["Oturumondemand"] = "6789ondemand";
            $_SESSION["user"] = $sonuc['user'];

            //sonrasında index sayfasına yönlendiriyorum
            header("location:index.php");
        }
    }
}
//Giriş formu doldurulmuşsa kontrol ediyoruz
if ($_POST) {
    $user = $_POST["user"]; //Kullanıcı adını değişkene atadık
    $pass = $_POST["pass"]; //Parolayı değişkene atadık
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
                <form method="post" role="form">
                  <div class="form-outline mb-4">
                    <input type="text" name="user" id="form2Example11" class="form-control" placeholder="Username" />
                    <label class="form-label" for="form2Example11">Username</label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" name="pass" id="form2Example22" class="form-control" />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>
                  <div class="form-check d-flex justify-content-start mb-4">
                    <input class="form-check-input" type="checkbox" id="rememberMeondemand" checked="">
                    <label class="form-check-label" for="rememberMeondemand"> Remember me </label>
                  </div>
				  <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" ID="btnGiris" value="Sign in"/>
                </form>
											   <?php
                        //Post varsa yani submit yapılmışsa veri tabanından kontrolü yapıyoruz.
                        if ($_POST) {
                            //sorguda kullanıcı adını alıp ona karşılık parola var mı diye bakıyoruz.
                            $sorgu = $baglanti->prepare("select pass from users where user=:user");
                            $sorgu->execute(array('user' => htmlspecialchars($user)));
                            $sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor


                            //parolaları md5 ile şifreledim ve başına sonuna kendimce eklemeler yaptım.
                            if (md5("56" . $pass . "23") == $sonuc["pass"]) {
                                $_SESSION["Oturumondemand"] = "6789ondemand"; //oturum oluşturma
                                $_SESSION["user"] = $user;

                                //eğer beni hatırla seçilmiş ise cookie oluşturuyoruz.
                                //cookie de şifreleyerek kullanıcı adından oluşturdum
                                if (isset($_POST["rememberMeondemand"])) {
                                    setcookie("cerezondemand", md5("aaondemand" . $user . "bbondemand"), time() + (60 * 60 * 24 * 7));
                                }
                                header("location:index.php"); //sayfa yönlendirme
                            } else {
                                //eğer kullanıcı adı ve parola doğru girilmemiş ise
                                //hata mesajı verdiriyoruz
                                echo "<font color='red'><strong>The username or password is wrong!</strong></font> ";
                            }
                        }
                        ?>

              </div>
			  <a href="register.php" class="btn btn-primary" > Sign Up</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
  <? ob_flush(); ?> 