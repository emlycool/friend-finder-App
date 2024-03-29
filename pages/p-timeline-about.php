<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location:index.php");
      exit;
}
include_once("../engine/database.php");
$user = $_SESSION['user_id'];
$o_user = $_GET['o_user'];
?>
<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from mythemestore.com/friend-finder/timeline-about.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:44:18 GMT -->
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>About Me | Learn Detail About Me</title>

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

    <div class="container">

      <!-- Timeline
      ================================================= -->
      <div class="timeline">
        <div class="timeline-cover">
          <?php
          
          $queryuser = "SELECT * FROM users WHERE id = $o_user";
          $userexe = mysqli_query($mycon, $queryuser);
          $userinfo = mysqli_fetch_array($userexe);
          include_once('../processes/my-functions.php');
          $total_friends_sql = "SELECT COUNT(*) FROM userfriends WHERE user_id = $o_user OR friend_id = $o_user";
          $result_f = mysqli_query($mycon, $total_friends_sql);
          $total_friends = mysqli_fetch_array($result_f)[0];
                                        
          $query_usercheck =" SELECT * FROM addfriend_list WHERE request_user = {$_SESSION['user_id']} AND  friend_id = $o_user";
          $qini=mysqli_query($mycon, $query_usercheck);
            if (mysqli_num_rows($qini) > 0) {

              $request_state = "Request Sent";
            }else{
              $request_state = "Add Friend";
            }
              
          
          ?>
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                  <img src="../<?php echo $userinfo['profile_pic']; ?>" alt="" class="img-responsive profile-photo" />
                  <h3><?php echo $userinfo['firstname']. " ". $userinfo['lastname']; ?></h3>
                  <p class="text-muted"></p>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="p-timeline.php?o_user=<?php echo $o_user; ?>">Timeline</a></li>
                <li><a href="p-timeline-about.php?o_user=<?php echo $o_user; ?>" class="active">About</a></li>
                <li><a href="p-timeline-album.php?o_user=<?php echo $o_user; ?>">Album</a></li>
                <li><a href="p-timeline-friends.php?o_user=<?php echo $o_user; ?>">Friends</a></li>
                </ul>
                <ul class="follow-me list-inline">
                  <li><?php echo restyle_text($total_friends); ?>&nbspfriend(s).</li>
                  <?php
                    $query = " SELECT * FROM userfriends WHERE user_id = {$_SESSION['user_id']} AND friend_id = $o_user OR friend_id = {$_SESSION['user_id']} AND user_id = $o_user";
                    $qexe = mysqli_query($mycon, $query);

                    if (mysqli_num_rows($qexe) < 1) {
                  ?>
                  <li><button id="<?php echo $o_user; ?>" onClick="add_friend(<?php echo $o_user; ?>);" class="btn-primary"><?php echo $request_state; ?></button></li>
                  <?php
                   } 
                  ?>
                </ul>
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              <img src="../<?php echo $userinfo['profile_pic']; ?>" alt="" class="img-responsive profile-photo" />
                  <h3><?php echo $userinfo['firstname']. " ". $userinfo['lastname']; ?></h3>
              <p class="text-muted"><?php echo restyle_text($total_friends); ?>&nbspfriend(s).</p>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                <li><a href="p-timeline.php?o_user=<?php echo $o_user; ?>" class="active">Timeline</a></li>
                <li><a href="p-timeline-about.php?o_user=<?php echo $o_user; ?>">About</a></li>
                <li><a href="p-timeline-album.php?o_user=<?php echo $o_user; ?>">Album</a></li>
                <li><a href="p-timeline-friends.php?o_user=<?php echo $o_user; ?>">Friends</a></li>

              </ul>
              <?php if (mysqli_num_rows($qexe) < 1) {?><li><button id="<?php echo $o_user; ?>" onClick="add_friend(<?php echo $o_user; ?>);" class="btn-primary"><?php echo $request_state ?></button></li><?php } ?>
            </div>
          </div><!--Timeline Menu for Small Screens End-->

        </div>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-7">
              <?php
              $queryuser_i = "SELECT * FROM u_info WHERE user_id = $o_user";
                        $userexe2 = mysqli_query($mycon, $queryuser_i);
                        $user_pi = mysqli_fetch_array($userexe2);
              ?>
              <!-- About
              ================================================= -->
              <div class="about-profile">
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-information-outline icon-in-title"></i>Personal Information</h4>
                  <p><?php echo $user_pi['BIO']; ?></p>
                </div>
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Work Experiences</h4>
                  <div class="organization">
                    <img src="images/envato.png" alt="" class="pull-left img-org" />
                    <div class="work-info">
                      <h5>Envato</h5>
                      <p>Seller - <span class="text-grey">1 February 2013 to present</span></p>
                    </div>
                  </div>
                </div>
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-location-outline icon-in-title"></i><?php echo $userinfo['country']; ?></h4>
                  <p><?php echo $user_pi['r_address']; ?></p>
                  <div class="google-maps">
                    <div id="map" class="map"></div>
                  </div>
                </div>
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-heart-outline icon-in-title"></i>Interests</h4>
                  <ul class="interests list-inline">
                    <li><span class="int-icons" title="Bycycle riding"><i class="icon ion-android-bicycle"></i></span></li>
                    <li><span class="int-icons" title="Photography"><i class="icon ion-ios-camera"></i></span></li>
                    <li><span class="int-icons" title="Shopping"><i class="icon ion-android-cart"></i></span></li>
                    <li><span class="int-icons" title="Traveling"><i class="icon ion-android-plane"></i></span></li>
                    <li><span class="int-icons" title="Eating"><i class="icon ion-android-restaurant"></i></span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-2 static">
              <div id="sticky-sidebar">
                <h4 class="grey">Sarah's activity</h4>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Commended on a Photo</p>
                    <p class="text-muted">5 mins ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Has posted a photo</p>
                    <p class="text-muted">an hour ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> Liked her friend's post</p>
                    <p class="text-muted">4 hours ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><a href="#" class="profile-link">Sarah</a> has shared an album</p>
                    <p class="text-muted">a day ago</p>
                  </div>
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&amp;callback=initMap"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.sticky-kit.min.js"></script>
    <script src="../js/jquery.scrollbar.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>-->
    <script src="../js/script.js"></script>
    <script type="text/javascript" src="../js/bootstrap-swipe-carousel.js"></script>
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>

    
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/timeline-about.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:44:39 GMT -->
</html>
