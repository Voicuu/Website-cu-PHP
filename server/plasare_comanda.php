<?php

session_start();

include('connection.php');

if(isset($_POST['place_order']))
{
    //luam informatiile utilizatorului si le stocam in bd
    $nume = $_POST['nume'];
    $email=$_POST['email'];
    $telefon=$_POST['telefon'];
    $oras=$_POST['oras'];
    $adresa=$_POST['adresa'];
    $cost_comanda=$_SESSION['total'];
    $status_comanda="on_hold";
    $id_user=$_SESSION['id_user'];
    $data_comanda=date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO comenzi (cost_comanda,status_comanda,id_user,telefon_user,oras_user,adresa_user,data_comanda)
                    VALUES (?,?,?,?,?,?,?); ");

    $stmt->bind_param('isiisss',$cost_comanda,$status_comanda,$id_user,$telefon,$oras,$adresa,$data_comanda);

    $stmt->execute();



    $id_comanda = $stmt->insert_id;


    //luam produsele din cos(din session)
    foreach($_SESSION['cart'] as $key => $value){
        $produs = $_SESSION['cart'][$key]; // []
        $id_produs = $produs['id_produs'];
        $nume_produs = $produs['nume_produs'];
        $pret_produs = $produs['pret_produs'];
        $img_produs = $produs['img_produs'];
        $cantitate_produs = $produs['cantitate_produs'];

        $stmt1 = $conn->prepare('INSERT INTO iteme_comenzi (id_comanda,id_produs,nume_produs,img_produs,pret_produs,cantitate_produs,id_user,data_comanda)
                        VALUES (?,?,?,?,?,?,?,?); ');

        $stmt1->bind_param('iissiiis',$id_comanda,$id_produs,$nume_produs,$img_produs,$pret_produs,$cantitate_produs,$id_user,$data_comanda);

        $stmt1->execute();
    }
    //emitem comandan noua si stocam informatiile comenzii in bd


    //stocam fiecare item in iteme_comenzi


    //stergem tot din cos


    //informam useru daca totu e ok sau nu
}else{
    echo "Esti gay";
}











?>