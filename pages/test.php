<!DOCTYPE html>
<html>
<body onload="myFunction()">

<h1>Hello World!</h1>
<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<script>
//function myFunction() {
    //swal("Page is loaded","ms", "success");
//}
</script>
<?php 
session_start();
include_once("../engine/database.php");
include_once '../processes/my-functions.php';



$product_id = 1;
  
    $wishlist_sql = "SELECT * FROM wishlist WHERE user_id={$_SESSION['user_id']} AND product_id = $product_id ";
    $wishlist_exe = $mycon2->query($wishlist_sql);
    
    echo mysqli_num_rows($wishlist_exe);
    if (mysqli_num_rows($wishlist_exe) > 0) {
    }else{
      echo "string";
      $wish_ins = "INSERT INTO wishlist VALUES(NULL, $product_id, {$_SESSION['user_id']})";
      $wish_ini = $mycon2->query($wish_ins);
     
    }



//Hp 15 laptop, 4gb RAM, 2.2GHz intel i5, 500gb ROM 
 
//include_once("../processes/active-users.php");
 //activeU($newtime, $mycon);
?>
<!--<div class="form-group col-sm-3 col-xs-6">
                        <label for="month" class="sr-only"></label>
                        <select class="form-control" id="month" name="dob_month">
                          <option value="month" >Month</option>
                          <option value="January">Jan</option>
                          <option value="Febuary">Feb</option>
                          <option value="March" disabled selected>Mar</option>
                          <option value="April">Apr</option>
                          <option value="May">May</option>
                          <option value="June">Jun</option>
                          <option value="July">Jul</option>
                          <option value="August">Aug</option>
                          <option value="September">Sep</option>
                          <option value="October">Oct</option>
                          <option value="November">Nov</option>
                          <option value="December">Dec</option>
                        </select>
                      </div>
                    -->
</body>

<!-- Mirrored from www.w3schools.com/jsref/tryit.asp?filename=tryjsref_onload by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jan 2015 08:29:36 GMT -->
</html>
