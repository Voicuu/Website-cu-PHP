<?php

include('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM produse LIMIT 4");

$stmt->execute();

$produse_feat = $stmt->get_result();
?>