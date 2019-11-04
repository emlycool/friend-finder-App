<?php
session_start();
include_once("database.php");
include_once("../processes/functions.php");
require_once('ImageManipulator.php');
include_once('../processes/my-functions.php');

if (isset($_POST['p'])) {
    $product_id = $_POST['p'];
	  $wishlist_sql = "SELECT * FROM wishlist WHERE user_id={$_SESSION['user_id']} AND product_id = $product_id ";
    $wishlist_exe = $mycon2->query($wishlist_sql);
    
    echo mysqli_num_rows($wishlist_exe);
    if (mysqli_num_rows($wishlist_exe) > 0) {
      
      $wishlist_sql = "DELETE FROM wishlist WHERE user_id={$_SESSION['user_id']} AND product_id = $product_id ";
      $wishlist_exe = $mycon2->query($wishlist_sql);
    }else{
      echo "string";
      $wish_ins = "INSERT INTO wishlist VALUES(NULL, $product_id, {$_SESSION['user_id']})";
      $wish_ini = $mycon2->query($wish_ins);
     
    }
}
if (isset($_POST['remove_wishlist'])) {
    $product_id = $_POST['remove_wishlist'];
    $wishlist_sql = "DELETE FROM wishlist WHERE user_id={$_SESSION['user_id']} AND product_id = $product_id ";
    $wishlist_exe = $mycon2->query($wishlist_sql);
}
?>