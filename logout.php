<?php
include_once 'Panier.php';
session_start();
$x=$_SESSION['user']; 
$panier=$_SESSION['panier'];
$panier->exporterPanier($x);
session_destroy();
header("location:accueil.php");
?>