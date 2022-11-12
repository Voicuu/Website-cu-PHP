<?php

session_start();

include('server/connection.php');

//daca useru e deja logat
if(isset($_SESSION['logat']))
{
  header('location: account.php');
  exit;
}

if(isset($_POST['register']))
{
  $nume = $_POST['nume'];
  $email = $_POST['email'];
  $parola = $_POST['parola'];
  $confirma_parola=$_POST['confirma_parola'];

  //verificam daca parolele difera
  if($parola!==$confirma_parola){
    header('location: register.php?error=Parolele difera');

  //verificam daca parola are mai putin de 6 carac
  }else if(strlen($parola) < 6){
    header('location: register.php?error=Parola trebuie sa aibe minim 6 caractere');


  //daca nu sunt erori
  }else{
        //verificam daca este un user cu acelasi email
        $stmt1 = $conn->prepare("SELECT count(*) FROM useri where email_user=?");
        $stmt1->bind_param('s',$email);
        $stmt1->execute();
        $stmt1->bind_result($nr_linii);
        $stmt1->store_result();
        $stmt1->fetch();

        //daca exista un user cu acelasi email
        if($nr_linii != 0){
          header('location: register.php?error=Acest user deja exista');
        }

        else{
          //creare user
          $stmt = $conn->prepare("INSERT INTO useri (nume_user,email_user,parola_user)
          VALUES (?,?,?);");

          $stmt->bind_param('sss',$nume,$email,md5($parola));

          //daca contul s-a creat cu succces
          if($stmt->execute()){
            $_SESSION['email_user']=$email;
            $_SESSION['nume_user']=$nume;
            $_SESSION['logat']=true;
            header('location: account.php?register_success=V-ati inregistrat cu succes!');
          }else{
            header('location: register.php?error=Nu s-a putut crea contul.');
          }
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
    <title>Inregistrare</title>
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

    <!-- Inregistrare -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Inregistrare</h2>
        <hr class="mx-auto" />
      </div>
      <div class="mx-auto container">
        <form id="register-form" method="POST" action="register.php">
        <p style="color: red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <div class="form-group">
            <label>Name</label>
            <input
              id="register-name"
              class="form-control"
              type="text"
              name="nume"
              placeholder="Nume"
              required
            />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input
              id="register-email"
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
              id="register-password"
              class="form-control"
              type="password"
              name="parola"
              placeholder="Parola"
              required
            />
          </div>
          <div class="form-group">
            <label>Confirmare Parola</label>
            <input
              id="register-confirm-password"
              class="form-control"
              type="password"
              name="confirma_parola"
              placeholder="Reintroduceti parola"
              required
            />
          </div>
          <div class="form-group">
            <input
              id="register-btn"
              class="btn"
              type="submit"
              name="register"
              value="Inregistreaza-te"
            />
          </div>
          <div class="form-group">
            <a id="login-url" class="btn" href="login.php"
              >Ai deja cont? Conecteaza-te</a
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
