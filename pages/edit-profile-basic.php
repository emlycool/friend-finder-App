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
	
<!-- Mirrored from mythemestore.com/friend-finder/edit-profile-basic.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:45:21 GMT -->
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Edit Profile | Edit Profile Page</title>

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
              	<li class="active"><i class="icon ion-ios-information-outline"></i><a href="edit-profile-basic.php">Basic Information</a></li>
              	<li><i class="icon ion-ios-briefcase-outline"></i><a href="edit-profile-work-edu.php">Education and Work</a></li>
              	<li><i class="icon ion-ios-heart-outline"></i><a href="edit-profile-interests.php">My Interests</a></li>
                <li><i class="icon ion-ios-settings"></i><a href="edit-profile-settings.php">Account Settings</a></li>
              	<li><i class="icon ion-ios-locked-outline"></i><a href="edit-profile-password.php">Change Password</a></li>
              </ul>
            </div>
            <div class="col-md-7">
              <?php
              $queryuser = "SELECT * FROM users WHERE id = {$_SESSION['user_id']}";
              $userexe = mysqli_query($mycon, $queryuser);
              $userinfo = mysqli_fetch_array($userexe);
              $dob = explode("-" , $userinfo['DOB']);
              $queryuser_i = "SELECT * FROM u_info WHERE user_id = {$_SESSION['user_id']}";
                        $userexe2 = mysqli_query($mycon, $queryuser_i);
                        $user_pi = mysqli_fetch_array($userexe2);
              ?>
              <!-- Basic Information
              ================================================= -->
              <div class="edit-profile-container">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i>Edit basic information</h4>
                  <div class="line"></div>
                  <p>Edit personal information here</p>
                  <div class="line"></div>
                </div>
                <div class="edit-block">
                  <form id="basic-info" class="form-inline" method="post">
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="firstname">First name</label>
                        <input id="firstname" readonly class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name" value="<?php echo $userinfo['firstname']; ?>" />
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="lastname" class="">Last name</label>
                        <input id="lastname"readonly class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name" value="<?php echo $userinfo['lastname']; ?>" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="email">My email</label>
                        <input id="email" class="form-control input-group-lg" type="text" name="update_email" readonly title="Enter Email" placeholder="My Email" value="<?php echo $userinfo['email']; ?>" />
                      </div>
                    </div>
                    <div class="row">
                      <p class="custom-label"><strong>Date of Birth</strong></p>
                      <div class="form-group col-sm-3 col-xs-6">
                        <label for="month" class="sr-only"></label>
                        <select class="form-control" id="day" name="dob_day_edit">
                          
                            <?php
                            
                              $day = 1;
                              for ($day = 1 ; $day <= 31 ; $day++) { 
                                if ($day == $dob['0']) {
                            ?>
                            <option value="<?php echo $day;  ?>" selected><?php echo $day; ?></option>
                            <?php
                                }else{
                              ?>      
                          <option value="<?php echo $day;  ?>"><?php echo $day; ?></option>
                            <?php   
                                } 
                            }
                            $mnth = array('Jan'=>'January', 'Feb'=>'Febuary', 'Mar'=>'March', 'Apr'=>'April', 'May'=>'May', 'June'=>'June', 'July'=>'July', 'Aug'=>'August', 'Sep'=>'September', 'Oct'=>'October', 'Nov'=>'November', 'Dec'=>'December');
                            

                            ?>                           
                        </select>
                      </div>
                      <div class="form-group col-sm-3 col-xs-6">
                        <label for="month" class="sr-only"></label>
                        <select class="form-control" id="month" name="dob_month_edit">
                          <?php 
                          foreach( $mnth as $key => $value ){
                            if ($value == $dob['1']) {

                          ?>
                          <option value="<?php echo $value; ?>"  selected><?php echo $key; ?></option>
                          
                          <?php 
                            }else{
                          ?>
                          <option value="<?php echo $value; ?>" ><?php echo $key; ?></option>
                          <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-6 col-xs-12">
                        <label for="year" class="sr-only"></label>
                        <select class="form-control" id="year" name="dob_year_edit">                          
                            <?php
                              $leastyear = 2005;
                              for ($leastyear = 2005 ; $leastyear >= 1960 ; $leastyear--){ 
                                if ($leastyear == $dob['2']) {
                            ?>
                            <option selected><?php echo $leastyear; ?></option>
                            <?php
                                }else{
                              ?>      
                          <option><?php echo $leastyear; ?></option>
                            <?php   
                                } 
                               
                                                        }
                              ?>     
                      </select>
                      </div>
                    </div>
                    <div class="form-group gender">
                      <span class="custom-label"><strong>I am a: </strong></span>
                      <label class="radio-inline">
                        <input type="radio" name="optradio" checked><?php if ($userinfo['gender'] == 'M') {
                          echo "Male";
                        }else{ echo "Female";} ?>

                      </label>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="city"> My city</label>
                        <input id="city" class="form-control input-group-lg" type="text" name="city_edit" title="Enter city" placeholder="Your city" value="<?php echo $userinfo['city']; ?>"/>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="country">My country</label>
                        <select class="form-control" id="country">
                          <?php 

                          ?>
                          <option value="<?php echo $userinfo['country']; ?>"><?php echo $userinfo['country']; ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="email">Address</label>
                        <input id="email" class="form-control input-group-lg" type="text" name="address" title="Enter Residential Address." placeholder="My Address" value="<?php echo $user_pi['r_address']; ?>" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-info">About me</label>
                        <?php 
                        if (empty($user_pi['BIO'])) {
                          echo "<div class='alert alert-info'>You are yet to fill in about yourself.</div>";
                        }
                        ?>
                        <textarea id="my-info" name="bio" class="form-control" placeholder="Some texts about me" rows="4" cols="400"><?php echo $user_pi['BIO']; ?></textarea>
                      </div>
                    </div>
                    <input type='submit' class='btn btn-primary' id="profile-btn" value='Save Changes' >
                      <div id="error"></div>
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
    <script type="text/javascript">
      $(document).ready(function(){
                        $("#basic-info").submit(function(e){
                                e.preventDefault();
                              
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/insert.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                      $("#error").fadeOut();
                                      document.getElementById("profile-btn").disabled = true;
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                      
                                   },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(html){
                                                                         
                                   

                                     if(html == "done"){
                                      swal({
                                        text: "Updated",
                                        icon:"success",
                                        timer: 1000,
                                        button: false,
                                      });
                                                                               
                                     }else{
                                      $("#error").fadeIn(1000, function(){                        
                                                $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+html+' !</div>');
                                                
                                      });
                                     }
                                     document.getElementById("profile-btn").disabled = false;
                                    }
                                });
                                return false;
                            });
                          }); 
    </script>
    
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/edit-profile-basic.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:45:21 GMT -->
</html>
