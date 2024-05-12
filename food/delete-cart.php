<?php require "../config/config.php"; ?>
<?php require "../libs/App.php"; ?>
<?php require "../includes/header.php"; ?>
<?php 


    $id = $_GET['id'];

    $query = "DELETE FROM cart WHERE id = '$_SESSION[user_id]'";
    $app = new App;

    $path = "cart.php";
    $cartItems = $app -> delete($query,$path);
 


?>
