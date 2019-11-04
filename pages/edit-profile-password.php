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
	
<!-- Mirrored from mythemestore.com/friend-finder/edit-profile-password.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:54:48 GMT -->
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Edit Profile | Change My Password</title>

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
        <?php include_once('timeline-cover.php') ?>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3">
              
              <!--Edit Profile Menu-->
              <ul class="edit-menu">
              	<li><i class="icon ion-ios-information-outline"></i><a href="edit-profile-basic.php">Basic Information</a></li>
              	<li><i class="icon ion-ios-briefcase-outline"></i><a href="edit-profile-work-edu.php">Education and Work</a></li>
              	<li><i class="icon ion-ios-heart-outline"></i><a href="edit-profile-interests.php">My Interests</a></li>
                <li><i class="icon ion-ios-settings"></i><a href="edit-profile-settings.php">Account Settings</a></li>
              	<li class="active"><i class="icon ion-ios-locked-outline"></i><a href="edit-profile-password.php">Change Password</a></li>
              </ul>
            </div>
            <div class="col-md-7">

              <!-- Change Password
              ================================================= -->
              <div class="edit-profile-container">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-ios-locked-outline"></i>Change Password</h4>
                  <div class="line"></div>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
                  <div class="line"></div>
                </div>
                <div class="edit-block">
                  <form method="post" id="password-change" class="form-inline">
                    <div id="error" style="margin-top: 10px;"></div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-password">Old password</label>
                        <input id="my-password" class="form-control input-group-lg" type="password" name="old_password" title="Enter password" placeholder="Old password"/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label>New password</label>
                        <input class="form-control input-group-lg" type="password" name="new_password" title="Enter password" placeholder="New password"/>
                      </div>
                      <div class="form-group col-xs-6">
                        <label>Confirm password</label>
                        <input class="form-control input-group-lg" type="password" name="confirm_password" title="Enter password" placeholder="Confirm password"/>
                      </div>
                    </div>
                    <p><a href="#">Forgot Password?</a></p>
                    <button type="submit" class="btn btn-primary" id="password-btn">Update Password</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-2 static">
              
              <!--Sticky Timeline Activity Sidebar-->
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
        <p>Thunder Team ?2016. All rights reserved</p>
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
    <script type="text/javascript">
      $(document).ready(function(){
                        $("#password-change").submit(function(e){
                                e.preventDefault();
                              
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/update.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                      $("#error").fadeOut();
                                      document.getElementById("password-btn").disabled = true;
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                      
                                   },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(html){
                                                                         
                                   

                                     if(html == "password"){
                                      swal({
                                        text: "Password Changed",
                                        icon:"success",
                                        timer: 1000,
                                        button: false,
                                      });
                                                                               
                                     }else{
                                      $("#error").fadeIn(1000, function(){                        
                                                $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+html+' !</div>');
                                                
                                      });
                                     }
                                     document.getElementById("password-btn").disabled = false;
                                    }
                                });
                                return false;
                            });
                          }); 
    </script>
    
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/edit-profile-password.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:54:48 GMT -->
</html>
