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
	
<!-- Mirrored from mythemestore.com/friend-finder/timeline-friends.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:45:16 GMT -->
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>My Friends | Friend Finder Friend List</title>

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
                <li><a href="p-timeline-about.php?o_user=<?php echo $o_user; ?>">About</a></li>
                <li><a href="p-timeline-album.php?o_user=<?php echo $o_user; ?>">Album</a></li>
                <li><a href="p-timeline-friends.php?o_user=<?php echo $o_user; ?>" class="active">Friends</a></li>
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

              <!-- Friend List
              ================================================= -->
              <div class="friend-list">
                <div class="row">
                <?php
                  $currentuser = $o_user; 
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
                      <img src="../images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
                      <div class="card-info">
                        <img src="../<?php echo $userinfo['profile_pic']; ?>" alt="user" class="profile-photo-lg" />
                        <div class="friend-info">
                          <p class="pull-right text-green">My Friend</p>
                          <h5><a href="p-timeline.php?o_user=<?php echo $usertocheck; ?>" class="profile-link"><?php echo $queryfriendresult['firstname']." ".$queryfriendresult['lastname']; ?></a></h5>
                          <p></p>
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
    <script type="text/javascript" src="../js/my-functions.js"></script>
    
    <script src="../js/upload.js"></script>
    
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/timeline-friends.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:45:16 GMT -->
</html>
