<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location:../index.php");
      exit;
}
include_once("../engine/database.php");
 ?>

<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from mythemestore.com/friend-finder/newsfeed-messages.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:16 GMT -->
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Chatroom | Send and Receive Messages</title>

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
    <link rel="shortcut icon" type="image/png" href="../images/fav.png"/> </head>
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
            <?php include_once ("left-bar-social.php"); ?><!--news-feed links ends-->
            
          </div>
    			<div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->
            <!-- Post Create Box End -->

            <!-- Chat Room
            ================================================= -->
            <div class="chat-room">
              <div  class="row">
                <div class="col-md-12">
                  <!-- Contact List in Left-->
                  <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">
                     <?php

                  $current_user = $_SESSION['user_id'];

                 
                  $querychat_list = "SELECT DISTINCT receiver_id FROM chat  WHERE sender_id = $current_user";
                  $querychat_result = mysqli_query($mycon,$querychat_list);
                  if (mysqli_num_rows($querychat_result)==0) {
                  echo "<div class='jumbotron '><p class='bg-info text-center'><b>No chats</b></p></div>";
                }
                  while ($fetch_chatlist = mysqli_fetch_array($querychat_result) ) {
                     $friend_id = $fetch_chatlist['receiver_id'];
                     
                     
                  $querycontact = "SELECT * FROM users WHERE id = $friend_id";
                            $contact = mysqli_query($mycon,$querycontact);
                            $result_contact = mysqli_fetch_array($contact);
                            $username = $result_contact['lastname']." ".$result_contact['firstname'];
                  $querymsg = "SELECT message FROM chat WHERE receiver_id = $friend_id AND sender_id = $current_user OR receiver_id = $current_user AND sender_id = $friend_id ORDER BY id DESC";
                  $result_msg = mysqli_query($mycon, $querymsg);
                  $array_msg = mysqli_fetch_array($result_msg);
                  $msg = $array_msg['message'];
                  ?>

                    <li class="">
                      <a href="newsfeed-messages.php?id=<?php echo $friend_id; ?>&username=<?php echo $username; ?>" >
                        <div class="contact">
                        	<img src="../<?php echo $result_contact['profile_pic']; ?>" alt="" class="profile-photo-sm pull-left"/>
                        	<div class="msg-preview">
                        		<h6><?php echo $username; ?></h6>
                        		<p class="text-muted"><?php echo $msg; ?></p>
                            <small class="text-muted">a min ago</small>
                            <div class="chat-alert">1</div>
                        	</div>
                        </div>
                      </a>
                    </li>
                    <?php
                      } 
                    ?>
                    
                  </ul><!--Contact List in Left End-->

                </div>
                
                <div class="clearfix"></div>
              </div>
            </div>
          </div>

    			<!-- Newsfeed Common Side Bar Right
          ================================================= -->
    			<?php include_once('right-social-bar.php'); ?>

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
              <a href="#"><img src="../images/logo-black.png" alt="" class="footer-logo" /></a>
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
    <!-- Scripts
    ================================================= -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&amp;callback=initMap"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.sticky-kit.min.js"></script>
    <script src="../js/jquery.scrollbar.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>-->
    <script src="../js/script.js"></script>
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>

  </body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed-messages.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:16 GMT -->
</html>
