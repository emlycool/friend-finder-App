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
<php lang="en">
<head>
		<meta http-equiv="content-type" content="text/php; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network php5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Friend List | Your Friend List</title>

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
            <?php include_once ("left-bar-social.php"); ?><!--news-feed links ends-->
            
          </div>
    			<div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->
            <div class="create-post">
            	<div class="row">
            		<div class="col-md-7 col-sm-7">
                  <div class="form-group">
                    <img src="images/users/user-1.jpg" alt="" class="profile-photo-md" />
                    <textarea name="texts" id="exampleTextarea" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                  </div>
                </div>
            		<div class="col-md-5 col-sm-5">
                  <div class="tools">
                    <ul class="publishing-tools list-inline">
                      <li><a href="#"><i class="ion-compose"></i></a></li>
                      <li><a href="#"><i class="ion-images"></i></a></li>
                      <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
                      <li><a href="#"><i class="ion-map"></i></a></li>
                    </ul>
                    <button class="btn btn-primary pull-right">Publish</button>
                  </div>
                </div>
            	</div>
            </div><!-- Post Create Box End -->

            <!-- Friend List
            ================================================= -->
            <div class="friend-list">
            	<div class="row">
                <?php
                $currentuser = $_SESSION['user_id']; 
                $query = " SELECT * FROM userfriends WHERE user_id = $currentuser OR friend_id = $currentuser";
                $qexe = mysqli_query($mycon, $query);
                while ($fetch = mysqli_fetch_array($qexe) ) {
                  $friend_id = $fetch['friend_id'];
                  if ($currentuser==$fetch['user_id']) {
                  $usertocheck = $fetch['friend_id'];
                  }else{
                    $usertocheck = $fetch['user_id'];
                  }
                  
                  $queryfriend = "SELECT * FROM users WHERE id = $usertocheck";
                  $queryfriendexe = mysqli_query($mycon, $queryfriend);
                  $queryfriendresult = mysqli_fetch_array($queryfriendexe);
                ?>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                    <img src="../images/covers/4.jpg" alt="profile-cover" class="img-responsive cover" />
                    <div class="card-info">
                      <img src="../images/users/user-10.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="newsfeed-messager.php?id=<?php echo $usertocheck; ?>" class="pull-right text-green"><button class="btn btn-primary btn-sm"><i class="icon ion-chatboxes"></i></button></a>
                        <h5><a href="#" class="profile-link"><?php echo $queryfriendresult['firstname']." ".$queryfriendresult['lastname']; ?></a></h5>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>

            	
                <?php 
              
            }
                ?>
            	
            	</div>
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
    
   

    <!-- Scripts
    ================================================= -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.sticky-kit.min.js"></script>
    <script src="../js/jquery.scrollbar.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>-->
    <script src="../js/script.js"></script>
    <script type="text/javascript" src="../js/bootstrap-swipe-carousel.js"></script>
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>
    
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed-friends.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:16 GMT -->
</html>
