<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location:../index.php");
      exit;
}
include_once("../engine/database.php");
$user = $_SESSION['user_id'];
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is social network html5 template available in themeforest......" />
    <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
    <meta name="robots" content="index, follow" />
    <title>News Feed | Check what your friends are doing</title>

    <!-- Stylesheets
    ================================================= -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/ionicons.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link href="../css/emoji.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/images-grid.css">
    
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="../images/fav.png"/>
  </head>
  <body>

    <!-- Header
    ================================================= -->
    <?php
    include_once("social_header.php");
    ?>
    <!--Header End-->

    <div id="page-contents">
    	<div class="container">
    		<div class="row">

    			<!-- Newsfeed Common Side Bar Left
          ================================================= -->
    			<div class="col-md-3 static">
            <?php include_once ("left-bar-social.php"); ?>
            
          </div>
    			<div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->
            <!-- Post Create Box End -->

            <!-- Nearby People List
            ================================================= -->
            <div  class="people-nearby" id="request-div">
             
           <?php
              
		      $currentuser = $_SESSION['user_id'];
              $query = "SELECT * FROM addfriend_list WHERE friend_id = $currentuser";
              $qexe = mysqli_query($mycon, $query);
              if (mysqli_num_rows($qexe) < 1) {
                echo "<div class'container'><h4>No friend requests</h4></div>";
              }
              while ($fetch = mysqli_fetch_array($qexe) ) {
              $request_user = $fetch['request_user'];
              $user_info = "SELECT * FROM users WHERE id = $request_user";
              $qexe_info = mysqli_query($mycon, $user_info); 
              $user_array = mysqli_fetch_array($qexe_info); 
              
           ?>
              <div  class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="images/users/user-15.jpg" alt="user" class="profile-photo-lg" />
                  </div>
                  <div class="col-md-5 col-sm-5">
                    <h5><a href="#" class="profile-link"><?php echo $user_array['lastname']." ".$user_array['firstname']; ?> </a></h5>
                    <p><?php echo $user_array['city']; ?></p>
                    <p class="text-muted">BIO</p>
                  </div>
                  <div class="col-md-5 col-sm-5">
                    <button  id="<?php echo $user_array['id']; ?>" onClick="confirm_friend(<?php echo $user_array['id']; ?>);" type="submit" class="btn btn-primary pull-right">Confirm <i class="fa fa-user-plus"></i></button>
                  <button style="margin-right: 3px;"id="<?php echo $user_array['id']; ?>" onClick="delete_friend(<?php echo $user_array['id']; ?>);" type="submit" class="btn btn-danger pull-right">Delete <i class="fa fa-minus-circle"></i></button>
                  </div>
                </div>
              </div>
              <?php
            }
              ?>
            </div>
          </div>

          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
    			<div class="col-md-2 static">
            <div class="suggestions" id="sticky-sidebar">
              <h4 class="grey">Who to Follow</h4>
              <div class="follow-user">
                <img src="images/users/user-11.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.php">Diana Amber</a></h5>
                  <a href="#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-12.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.php">Cris Haris</a></h5>
                  <a href="#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-13.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.php">Brian Walton</a></h5>
                  <a href="#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-14.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.php">Olivia Steward</a></h5>
                  <a href="#" class="text-green">Add friend</a>
                </div>
              </div>
              <div class="follow-user">
                <img src="images/users/user-15.jpg" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.php">Sophia Page</a></h5>
                  <a href="#" class="text-green">Add friend</a>
                </div>
              </div>
            </div>
          </div>
    		</div>
    	</div>
    </div>

    <!-- Footer
    ================================================= -->
    <footer id="footer">
      <div class="container">
      	<div class="row">
          <div class="footer-wrapper">
            <div class="col-md-3 col-sm-3">
              <a href="#"><img src="images/logo-black.png" alt="" class="footer-logo" /></a>
              <ul class="list-inline social-icons">
              	<li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>For individuals</h5>
              <ul class="footer-links">
                <li><a href="#">Signup</a></li>
                <li><a href="#">login</a></li>
                <li><a href="#">Explore</a></li>
                <li><a href="#">Finder app</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Language settings</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>For businesses</h5>
              <ul class="footer-links">
                <li><a href="#">Business signup</a></li>
                <li><a href="#">Business login</a></li>
                <li><a href="#">Benefits</a></li>
                <li><a href="#">Resources</a></li>
                <li><a href="#">Advertise</a></li>
                <li><a href="#">Setup</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>About</h5>
              <ul class="footer-links">
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-3">
              <h5>Contact Us</h5>
              <ul class="contact">
                <li><i class="icon ion-ios-telephone-outline"></i>+1 (234) 222 0754</li>
                <li><i class="icon ion-ios-email-outline"></i>info@thunder-team.com</li>
                <li><i class="icon ion-ios-location-outline"></i>228 Park Ave S NY, USA</li>
              </ul>
            </div>
          </div>
      	</div>
      </div>
      <div class="copyright">
        <p>Thunder Team © 2016. All rights reserved</p>
      </div>
		</footer>
    
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    
    <!--Buy button-->
    <a href="https://themeforest.net/cart/add_items?item_ids=18711273&amp;ref=thunder-team" target="_blank" class="btn btn-buy"><span class="italy">Buy with:</span><img src="images/envato_logo.png" alt="" /><span class="price">Only $20!</span></a>

    <!-- Scripts
    ================================================= -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&amp;callback=initMap"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.sticky-kit.min.js"></script>
    <script src="../js/jquery.scrollbar.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>-->
    <script src="../js/script.js"></script>
    <script type="text/javascript" src="../js/bootstrap-swipe-carousel.js"></script>
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>

    <script>

    	function confirm_friend(id){
                $("#request-div").load("../engine/insert.php",{confirm_friend_id : id})              
               // $("#"+id).load(" #"+id);
               
    	}

      function delete_friend(id){

              if (window.XMLHttpRequest){
                   xmlhttp=new XMLHttpRequest();
                      }

                      else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                          }

                      xmlhttp.open("POST","../engine/insert.php",true);
                      xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                      xmlhttp.send("delete_friend_id="+id);
                     // alert('Friend Request Sent');
                      var checkBtn = document.getElementById(id).innerHTML;
                      if(checkBtn == "Delete"){
                      document.getElementById(id).innerHTML = "Deleted";
                      }
                     $("#refresh").load(" #refresh")
                     
                     // $("#"+id).load(" #"+id);
                     
            }

</script>
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed-people-nearby.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:14 GMT -->
</html>
