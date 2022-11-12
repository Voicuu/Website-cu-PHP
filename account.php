<?php

session_start();
include('server/connection.php');

if(!isset($_SESSION['logat']))
{
  header('location: login.php');
  exit;
}

if(isset($_GET['logout']))
{
  if(isset($_SESSION['logat']))
  {
    unset($_SESSION['logat']);
    unset($_SESSION['nume_user']);
    unset($_SESSION['email_user']);
    header('location: login.php');
    exit;
  }
}


if(isset($_POST['schimba_parola'])){

  $parola = $_POST['parola'];
  $confirma_parola = $_POST['confirma_parola'];
  $email_user = $_SESSION['email_user'];

  if($parola!==$confirma_parola){
    header('location: account.php?error=Parolele difera');

  //verificam daca parola are mai putin de 6 carac
  }else if(strlen($parola) < 6){
    header('location: account.php?error=Parola trebuie sa aibe minim 6 caractere');

  }else{
    //nu sunt erori
    $stmt = $conn->prepare("UPDATE useri SET parola_user=? WHERE email_user=?");
    $stmt->bind_param('ss',md5($parola),$email_user);

    if($stmt->execute()){
      header('location: account.php?message=Parola a fost schimbata cu succes!');
    }
    else{
      header('location: account.php?error=Parola nu a putut fi schimbata!');
    }
  }
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
    <title>Home</title>
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
              <a href="account.html"><i class="fas fa-user"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- CONT -->
    <section class="my-5 py-5">
      <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12 formu">
        <p class="text-center" style="color: green"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];} ?></p>
        <p class="text-center" style="color: green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>
        <h3 class="font-weight-bold">Informatii despre cont</h3>
          <hr class="mx-auto" />
          <div class="account-info">
            <p>Nume: <span><?php if(isset($_SESSION['nume_user'])){echo $_SESSION['nume_user']; }?></span></p>
            <p>Email: <span><?php if(isset($_SESSION['email_user'])){ echo $_SESSION['email_user']; }?></span></p>
            <p><a href="" id="orders-btn">Comenzile tale</a></p>
            <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
          <form id="account-form" method="POST" action="account.php">
            <p class="text-center" style="color: red"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
            <p class="text-center" style="color: green"><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></p>
            <h3>Schimba parola</h3>
            <hr class="mx-auto" />
            <div class="form-group">
              <label>Parola</label>
              <input
                type="password"
                class="form-control"
                id="account-password"
                name="parola"
                placeholder="Parola"
                required
              />
            </div>
            <div class="form-group">
              <label>Confirma Parola</label>
              <input
                type="password"
                class="form-control"
                id="account-password-confirm"
                name="confirma_parola"
                placeholder="Parola"
                required
              />
            </div>
            <div class="form-group">
              <input
                type="submit"
                value="Schimba Parola"
                class="btn"
                name="schimba_parola"
                id="change-pass-btn"
              />
            </div>
          </form>
        </div>
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
