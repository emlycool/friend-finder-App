<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location:../index.php");
      exit;
}
include_once("../engine/database.php");
$user = $_SESSION['user_id'];
$friend_id = $_GET['id'];
 ?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="shortcut icon" type="image/png" href="../images/fav.png"/>	</head>
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
            <div id="chat-block">
              <div class="title">Chat online</div>
              <ul class="online-users list-inline">
                <li><a href="newsfeed-messages.php" title="Linda Lohan"><img src="images/users/user-2.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="Sophia Lee"><img src="images/users/user-3.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="John Doe"><img src="images/users/user-4.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="Alexis Clark"><img src="images/users/user-5.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="James Carter"><img src="images/users/user-6.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="Robert Cook"><img src="images/users/user-7.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="Richard Bell"><img src="images/users/user-8.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="Anna Young"><img src="images/users/user-9.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <li><a href="newsfeed-messages.php" title="Julia Cox"><img src="images/users/user-10.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
              </ul>
            </div><!--chat block ends-->
          </div>
    			<div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->
           <!-- Post Create Box End -->

            <!-- Chat Room
            ================================================= -->
            <div class="chat-room">
              <div  class="row">
                <div class="col-md-5">

                   <?php
                               
                                $query = "SELECT * FROM users WHERE id = $friend_id";
                                $queryexe = mysqli_query($mycon,$query);
                                $resultquery = mysqli_fetch_array($queryexe);
 
                                ?>
                  <!-- Contact List in Left-->
                  <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">
                        <?php

                  $current_user = $_SESSION['user_id'];

                 $username = $_GET['username'];
                 

                  ?>
                    <li class="active">
                      <a href="#contact-<?php echo $friend_id; ?>">
                        <div class="contact">
                        	<img src="images/users/user-2.jpg" alt="" class="profile-photo-sm pull-left"/>
                        	<div class="msg-preview">
                        		<h6><?php echo $username;?></h6>
                        		<p class="text-muted">Hi there, how are you</p>
                            <small class="text-muted">a min ago</small>
                            <div class="chat-alert">1</div>
                        	</div>
                        </div>
                      </a>
                    </li>
                     
                    
                  </ul><!--Contact List in Left End-->

                </div>
                <div class="col-md-7">

                  <!--Chat Messages in Right-->
                  <div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
                    <div class="tab-pane active" >
                      <div class="chat-body" id="refresh">
                      	<ul class="chat-message">
                          <?php
                            $current_user = $_SESSION['user_id'];
                            $querychat = "SELECT * FROM chat WHERE receiver_id = $friend_id AND sender_id= $current_user OR sender_id = $friend_id AND receiver_id = $current_user";
                            $chatexe = mysqli_query($mycon,$querychat);
                            while($chatresult = mysqli_fetch_array($chatexe)) {
                              
                            $querysender = "SELECT * FROM users WHERE id = $current_user";
                            $senderexe = mysqli_query($mycon,$querysender);
                            $result_sender = mysqli_fetch_array($senderexe);
                            if ($chatresult['sender_id'] == $current_user ) {
                              $class= "right";
                              $user=  $result_sender['lastname']." ".$result_sender['firstname'];
                            }
                            else{
                              $class = "left";
                              $user = $resultquery['lastname']." ".$resultquery['firstname'];
                            }


                          ?>
                      	
                          <li class="<?php echo $class;  ?>" id="contact-<?php echo $friend_id;?>">
                      			<img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-<?php echo $class; ?>" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5><?php echo $user; ?></h5>
                              	<small class="text-muted">3 days ago</small>
                              </div>
                              <p><?php echo $chatresult['message'] ?></p>
                            </div>
                      		</li>
                          <?php
                        }
                          ?>
                         
                      	</ul>
                      </div>
                    </div>
                  </div><!--Chat Messages in Right End-->

                  <div class="send-message">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Type your message" id="message" value="">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onClick="send_text();">Send</button>
                      </span>
                    </div>
                  </div>
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


     <script>
      
      function send_text(){

      
        if (window.XMLHttpRequest){
             xmlhttp=new XMLHttpRequest();
                }

                else{
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                var text = document.getElementById('message').value;
                var receiver_id ='<?php echo $friend_id; ?>';
                xmlhttp.open("POST","engine/insert.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send("message="+text + "&receiver_id="+receiver_id);
               // alert('Friend Request Sent');
                $("#refresh").load(" #refresh");
                
               
               // $("#"+id).load(" #"+id);
               
      }


</script>

  </body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed-messages.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:16 GMT -->
</html>
