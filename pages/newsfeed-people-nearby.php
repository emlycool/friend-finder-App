<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location:index.php");
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

            <!-- Nearby People List
            ================================================= -->
            <div  class="people-nearby">
             
           <?php
          $currentuser = $_SESSION['user_id']; 
           if (isset($_POST['find'])) {
                $input = $_POST['find'];
                $search = "SELECT * FROM users WHERE firstname LIKE '%$input%' OR lastname LIKE  '%$input%'";
                $searchexe = mysqli_query($mycon, $search);
                if (mysqli_num_rows($searchexe)==0) {
                  echo "<b>nothing found<b>";
                }
              while ($fetchsearch = mysqli_fetch_array($searchexe) ) {
                if ($fetchsearch['id']!= $currentuser) {
                
        
                ?>
                <div id="" class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="../<?php echo $fetchsearch['profile_pic']; ?>" alt="user" class="profile-photo-lg" />
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="p-timeline.php?o_user=<?php echo $fetchsearch['id']; ?>" class="profile-link"><?php echo $fetchsearch['firstname']." ".$fetchsearch['lastname']; ?> </a></h5>
                    <p><?php echo $fetchsearch['city']; ?></p>
                    <p class="text-muted">500m away</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    </div>
                </div>
              </div>

                <?php

                }
              }
            }
            else{ //normal newsfeed

            
                
              
              

                


          $currentuser = $_SESSION['user_id']; 
              $query = " SELECT * FROM users";
              $qexe = mysqli_query($mycon, $query);
              while ($fetch = mysqli_fetch_array($qexe) ) {
                if ($fetch['id']!= $currentuser) {
                  $friend_id = $fetch['id'];
                  $querynonrepeat = "SELECT * FROM userfriends WHERE user_id = $currentuser AND friend_id =$friend_id OR user_id= $friend_id AND friend_id= $currentuser";
                  $querynonrepeatexe= mysqli_query($mycon, $querynonrepeat);
                  if (mysqli_num_rows($querynonrepeatexe)==1) {
                      }    
                    else{
                                
              
           ?>
              <div id="" class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="../<?php echo $fetch['profile_pic']; ?>" alt="user" class="profile-photo-lg" />
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="p-timeline.php?o_user=<?php echo $friend_id; ?>" class="profile-link"><?php echo $fetch['firstname']." ".$fetch['lastname']; ?> </a></h5>
                    <p><?php echo $fetch['city']; ?></p>
                    <p class="text-muted">BIO</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                         <?php             

      		$currentuser = $_SESSION['user_id'];
      		$query_usercheck =" SELECT * FROM addfriend_list WHERE request_user = $currentuser AND  friend_id = $friend_id";
      		$qini=mysqli_query($mycon, $query_usercheck);
      		if (mysqli_num_rows($qini) > 0) {

      	         $request_state = "Request Sent";
      		}else{
                   $request_state = "Add Friend";
      		}



 
                         ?>
                         <button id="<?php echo $fetch['id']; ?>" onClick="add_friend(<?php echo $fetch['id']; ?>);" type="submit" class="btn btn-primary pull-right"><?php echo $request_state; ?></button>
                  
                  </div>
                </div>
              </div>
              <?php
              }
            }
            }
          }
              ?>
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
    <script type="text/javascript">
    	

     // document.forms["search"].submit();
      $(document).ready(function(){
                        $("#search").submit(function(e){
                                e.preventDefault();
                              
                                $.ajax({
                                    type: "POST",
                                    url: "search.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                     
                                   },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(html){
                                                                           
                                   

                                   if(html == "done"){


                                       alert("Boss")
                                   }
                                    }
                                });
                                return false;
                            });
                        });


</script>
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed-people-nearby.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:14 GMT -->
</html>
