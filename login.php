<?php
session_start();
include('server/connection.php');

if(isset($_SESSION['logat'])){
  header('location: account.php');
}

if(isset($_POST['login-btn'])){

  $email=$_POST['email'];
  $parola=md5($_POST['parola']);

  $stmt = $conn->prepare("SELECT id_user,nume_user,email_user,parola_user FROM useri
                  WHERE email_user = ? AND parola_user = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$parola);
  if($stmt->execute()){
    $stmt->bind_result($id_user,$nume_user,$email_user,$parola_user);
    $stmt->store_result();

    if($stmt->num_rows()==1){
      $stmt->fetch();
      $_SESSION['id_user']=$id_user;
      $_SESSION['nume_user']=$nume_user;
      $_SESSION['email_user']=$email_user;
      $_SESSION['logat']=true;

      header('location: account.php?login_success=V-ati logat cu succes!');

    }else{
      header('location: login.php?error=Email sau parola gresite!');
    }

  }else{
    //eroare
    header('location: login.php?error=Ceva nu a functionat!');
  }

}else{
  $x = "you are hay";
  echo $x;
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Login</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light py-3 fixed-top">
      <div class="container">
        <a href="index.php"
          ><img
            class="logo"
            src="assets/imgs/facebook_cover_photo_1.png"
            alt=""
        /></a>
        <!-- <h2 class="brand">PAI</h2> -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse nav-buttons"
          id="navbarSupportedContent"
        >
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Acasa</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="shop.html">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contacteaza-ne</a>
            </li>

            <li class="nav-item">
              <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
              <a href="login.html"><i class="fas fa-user"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- LOGIN -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto" />
      </div>
      <div class="mx-auto container">
        <form id="login-form" action="login.php" method="POST">
          <p style="color: red" class="text-center"><?php if(isset($_GET['error'])){echo $_GET['error']; } ?></p>
          <div class="form-group">
            <label>Email</label>
            <input
              id="login-email"
              class="form-control"
              type="email"
              name="email"
              placeholder="Email"
              required
            />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input
              id="login-password"
              class="form-control"
              type="password"
              name="parola"
              placeholder="Password"
              required
            />
          </div>
          <div class="form-group">
            <input id="login-btn" class="btn" type="submit" value="Login" name="login-btn"/>
          </div>
          <div class="form-group">
            <a id="register-url" class="btn" href="register.php"
              >Nu ai cont? Inregistreaza-te</a
            >
          </div>
        </form>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="mt-5 py-5">
      <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm12">
          <img class="logo" src="assets/imgs/logo_transparent.png" alt="" />
          <p class="pt-3">Oferim cele mai bune produse, calitate garantata!</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Produse</h5>
          <ul class="text-uppercase">
            <li><a href="#"></a>Nutritie</li>
            <li><a href="#"></a>Imbracaminte si accesorii</li>
            <li><a href="#"></a>Grupe de alergeni</li>
            <li><a href="#"></a>Obiectivele tale</li>
            <li><a href="#"></a>Articole si sfaturi</li>
          </ul>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Contacteaza-ne</h5>
          <div>
            <h6 class="text-uppercase">Adresa</h6>
            <p>1234 Vasile Parvan, Timisoara</p>
          </div>
          <div>
            <h6 class="text-uppercase">Telefon</h6>
            <p>0734123123</p>
          </div>
          <div>
            <h6 class="text-uppercase">Email</h6>
            <p>pai@yahoo.com</p>
          </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Instagram</h5>
          <div class="row">
            <img
              src="assets/imgs/featured1.jpg"
              class="img-fluid w-25 h-100 m-2"
              alt=""
            />
            <img
              src="assets/imgs/featured2.jpg"
              class="img-fluid w-25 h-100 m-2"
              alt=""
            />
            <img
              src="assets/imgs/featured3.jpg"
              class="img-fluid w-25 h-100 m-2"
              alt=""
            />
            <img
              src="assets/imgs/featured4.jpg"
              class="img-fluid w-25 h-100 m-2"
              alt=""
            />
            <img
              src="assets/imgs/supliment1.jpeg"
              class="img-fluid w-25 h-100 m-2"
              alt=""
            />
          </div>
        </div>
      </div>

      <div class="copyright mt-5">
        <div class="row container mx-auto">
          <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
            <img src="assets/imgs/payment.png" alt="" />
          </div>
          <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
            <p><b>Magazin virtual @ 2022 Toate Drepturile Rezervate</b></p>
          </div>
          <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
