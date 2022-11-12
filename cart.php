<?php

session_start();
if(isset($_POST['add_to_cart']))
{
  //daca useru a mai adaugat alt produs in cos
  if(isset($_SESSION['cart'])){
    $ids_arr_produse=array_column($_SESSION['cart'],"id_produs");
    //daca produsul a fost deja adaugat sau nu
    if(!in_array($_POST['id_produs'], $ids_arr_produse))
    {
      $id_produs = $_POST['id_produs'];

      $arr_produs=array(
        'id_produs'=>$_POST['id_produs'],
        'nume_produs'=>$_POST['nume_produs'],
        'pret_produs'=>$_POST['pret_produs'],
        'img_produs'=>$_POST['img_produs'],
        'cantitate_produs'=>$_POST['cantitate_produs']
      );

      $_SESSION['cart'][$id_produs]=$arr_produs;


    //daca produsul a fost deja adaugat
    }else{
      echo '<script>alert("Produsul a fost deja adaugat in cos");</script>';

    }


    //daca este primul produs
  }else{
    $id_produs=$_POST['id_produs'];
    $nume_produs=$_POST['nume_produs'];
    $pret_produs=$_POST['pret_produs'];
    $img_produs=$_POST['img_produs'];
    $cantitate_produs=$_POST['cantitate_produs'];

    $arr_produs=array(
      'id_produs'=>$id_produs,
      'nume_produs'=>$nume_produs,
      'pret_produs'=>$pret_produs,
      'img_produs'=>$img_produs,
      'cantitate_produs'=>$cantitate_produs
    );

    $_SESSION['cart'][$id_produs]=$arr_produs;
    // [ 2=>[] , 3=>[] , 5=>[] ]


  }

  //calculeaza total
  pretTotalCos();

//sterge produs din cos
}else if(isset($_POST['remove_product'])){

  $id_produs=$_POST['id_produs'];
  unset($_SESSION['cart'][$id_produs]);

  //calcul total
  pretTotalCos();


}else if(isset($_POST['edit_cantitate']) ){

  //luam id si cantitate din form
  $id_produs=$_POST['id_produs'];
  $cantitate_produs=$_POST['cantitate_produs'];

  //luam vectoru de produs din session
  $arr_produs=$_SESSION['cart'][$id_produs];

  //updatam cantitate
  $arr_produs['cantitate_produs']=$cantitate_produs;

  //returnam vectoru inapoi in sesiune
  $_SESSION['cart'][$id_produs]=$arr_produs;


  //calcul total
  pretTotalCos();


}else{
  //header('location: index.php');
}

function pretTotalCos(){

  $total =0;

  foreach($_SESSION['cart'] as $key => $value){

    $produs = $_SESSION['cart'][$key];

    $pret = $produs['pret_produs'];
    $cantitate = $produs['cantitate_produs'];

    $total = $total + ($pret * $cantitate);
  }

  $_SESSION['total']=$total;
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
    <title>Cosul dumneavoastra</title>
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

    <!-- CART -->
    <section class="cart container my-5 py-5">
      <div class="container mt-5">
        <h2 class="font-weight-bold">Cosul dumneavoastra</h2>
        <hr />
      </div>
      <table class="mt-5 pt-5">
        <tr>
          <th>Produse</th>
          <th>Cantitate</th>
          <th>Subtotal</th>
        </tr>


        <?php foreach($_SESSION['cart'] as $key => $value){ ?>

        <tr>
          <td>
            <div class="product-info">
              <img src="assets/imgs/<?php echo $value['img_produs']; ?>"/>
              <div>
                <p><?php echo $value['nume_produs']; ?></p>
                <small><?php echo $value['pret_produs']; ?><span> RON</span></small>
                <br />
                <form method="POST" action="cart.php">
                  <input type="hidden" name="id_produs" value="<?php echo $value['id_produs']; ?>"/>
                  <input type="submit" name="remove_product" class="remove-btn" value="Sterge" />
                </form>

              </div>
            </div>
          </td>
          <td>

            <form method="POST" action="cart.php">
              <input type="hidden" name="id_produs" value="<?php echo $value['id_produs']; ?>"/>
              <input type="number" name="cantitate_produs" value="<?php echo $value['cantitate_produs']; ?>" />
              <input type="submit" class="edit-btn" value="Edit" name="edit_cantitate"/>
            </form>

          </td>
          <td>
            <span class="product-price"><?php echo $value['cantitate_produs']* $value['pret_produs']; ?></span>
            <span> RON</span>
          </td>
        </tr>

        <?php } ?>

      </table>

      <div class="cart-total">
        <table>
          <tr>
            <td>Total</td>
            <td><?php echo $_SESSION['total']; ?> RON</td>
          </tr>
        </table>
      </div>

      <div class="checkout-container">
        <form method= "POST" action="checkout.php">
          <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout"/>
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
