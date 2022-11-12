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
              <a href="login.php"><i class="fas fa-user"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- HOME -->
    <section id="home">
      <div class="container">
        <h5>ARTICOLE NOI</h5>
        <h1><span>45%</span> reduceri la gustari</h1>
        <p>+30% REDUCERE la aproape tot restul produselor | COD: RO30</p>
        <a href="#featured"><button class="btn btn-outline-primary">Cumpara acum</button></a>
      </div>
    </section>

    <!-- BRAND -->
    <section id="brand" class="container">
      <div class="row">
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12"
        src="assets/imgs/brand1.png""> <img class="img-fluid col-lg-3 col-md-6
        col-sm-12" src="assets/imgs/brand2.jpg""> <img class="img-fluid col-lg-3
        col-md-6 col-sm-12" src="assets/imgs/brand3.jpg""> <img class="img-fluid
        col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.png"">
      </div>
    </section>

    <!-- NEW -->
    <section id="new" class="w-100">
      <div class="row p-0 m-0">
        <!-- ONE -->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/imgs/1.jpeg" alt="" />
          <div class="details">
            <h2>PROTEINE</h2>
            <button class="text-uppercase btn btn-outline-primary">
              Cumpara
            </button>
          </div>
        </div>
        <!-- TWO -->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/imgs/2.png" alt="" />
          <div class="details">
            <h2>IMBRACAMINTE</h2>
            <button class="text-uppercase btn btn-outline-primary">
              Cumpara
            </button>
          </div>
        </div>

        <!-- THREE -->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/imgs/3.jpg" alt="" />
          <div class="details">
            <h2>CREATINA</h2>
            <button class="text-uppercase btn btn-outline-primary">
              Cumpara
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURED -->
    <section id="featured" class="my-5 pb5">
      <div class="container text-center mt-5 py-5">
        <h3>Cele mai vandute</h3>
        <hr />
        <p>Aici puteti vedea produsele favorite de clienti</p>
      </div>

      <div class="row mx-auto container-fluid">

        <?php include('server/get_produse.php'); ?>
        <?php while($row = $produse_feat->fetch_assoc()){ ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['img_produs']; ?>" alt="" />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['nume_produs'];?></h5>
          <h4 class="p-price"><?php echo $row['pret_produs'];?> RON</h4>
          <a href="<?php echo "single_product.php?id_produs=". $row['id_produs']; ?>"><button class="buy-btn btn btn-outline-primary">CUMPARA</button></a>
        </div>


      <?php }?>
      </div>
    </section>

    <!-- BANNER -->
    <section id="banner" class="my-5 py-5">
      <div class="container">
        <img src="assets/imgs/" alt="" />
        <h4>REDUCERI DE TOAMNA</h4>
        <h1>Colectia de toamna<br />PANA LA 30% REDUCERE</h1>
        <button class="text-uppercase btn btn-outline-primary">CAUTA</button>
      </div>
    </section>

    <!-- SUPLIMENTE -->
    <section id="featured" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Suplimente</h3>
        <hr />
        <p>Aici puteti vizualiza suplimentele noastre</p>
      </div>
      <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img
            class="img-fluid mb-3"
            src="assets/imgs/supliment1.jpeg"
            alt=""
          />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">
            Optimum Nutrition Gold Standard 100% Whey Double Rich Chocolate
            Flavour
          </h5>
          <h4 class="p-price">149.99 RON</h4>
          <button class="buy-btn btn btn-outline-primary">CUMPARA</button>
        </div>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img
            class="img-fluid mb-3"
            src="assets/imgs/supliment2.jpeg"
            alt=""
          />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">Myvitamins Daily Vitamins Multi Vitamin</h5>
          <h4 class="p-price">24.99 RON</h4>
          <button class="buy-btn btn btn-outline-primary">CUMPARA</button>
        </div>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img
            class="img-fluid mb-3"
            src="assets/imgs/supliment3.jpeg"
            alt=""
          />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">
            Gatorade Recover Whey Protein Bar, Chocolate Chip, 20g Protein
          </h5>
          <h4 class="p-price">69.99 RON</h4>
          <button class="buy-btn btn btn-outline-primary">CUMPARA</button>
        </div>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img
            class="img-fluid mb-3"
            src="assets/imgs/supliment4.jpeg"
            alt=""
          />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">Capsule Esentiale Omega-3</h5>
          <h4 class="p-price">34.99 RON</h4>
          <button class="buy-btn btn btn-outline-primary">CUMPARA</button>
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
