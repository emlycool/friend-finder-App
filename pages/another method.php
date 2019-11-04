<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location:index.php");
      exit;
}
include_once("engine/database.php");
$friend_id = $_GET['id'];
 ?>
<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from mythemestore.com/friend-finder/newsfeed-messages.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:16 GMT -->
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Chatroom | Send and Receive Messages</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/jquery.scrollbar.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link href="css/emoji.css" rel="stylesheet">
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
	</head>
  <body>

    <!-- Header
    ================================================= -->
		<header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index-register.php"><img src="images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span><img src="images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu newsfeed-home">
                    <li><a href="index.php">Landing Page 1</a></li>
                    <li><a href="index-register.php">Landing Page 2</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Newsfeed <span><img src="images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu newsfeed-home">
                    <li><a href="newsfeed.php">Newsfeed</a></li>
                    <li><a href="newsfeed-people-nearby.php">Poeple Nearly</a></li>
                    <li><a href="newsfeed-friends.php">My friends</a></li>
                    <li><a href="newsfeed-messages.php">Chatroom</a></li>
                    <li><a href="newsfeed-images.php">Images</a></li>
                    <li><a href="newsfeed-videos.php">Videos</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timeline <span><img src="images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu login">
                  <li><a href="timeline.php">Timeline</a></li>
                  <li><a href="timeline-about.php">Timeline About</a></li>
                  <li><a href="timeline-album.php">Timeline Album</a></li>
                  <li><a href="timeline-friends.php">Timeline Friends</a></li>
                  <li><a href="edit-profile-basic.php">Edit: Basic Info</a></li>
                  <li><a href="edit-profile-work-edu.php">Edit: Work</a></li>
                  <li><a href="edit-profile-interests.php">Edit: Interests</a></li>
                  <li><a href="edit-profile-settings.php">Account Settings</a></li>
                  <li><a href="edit-profile-password.php">Change Password</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle pages" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All Pages <span><img src="images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu page-list">
                  <li><a href="index.php">Landing Page 1</a></li>
                  <li><a href="index-register.php">Landing Page 2</a></li>
                  <li><a href="newsfeed.php">Newsfeed</a></li>
                  <li><a href="newsfeed-people-nearby.php">Poeple Nearly</a></li>
                  <li><a href="newsfeed-friends.php">My friends</a></li>
                  <li><a href="newsfeed-messages.php">Chatroom</a></li>
                  <li><a href="newsfeed-images.php">Images</a></li>
                  <li><a href="newsfeed-videos.php">Videos</a></li>
                  <li><a href="timeline.php">Timeline</a></li>
                  <li><a href="timeline-about.php">Timeline About</a></li>
                  <li><a href="timeline-album.php">Timeline Album</a></li>
                  <li><a href="timeline-friends.php">Timeline Friends</a></li>
                  <li><a href="edit-profile-basic.php">Edit Profile</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                  <li><a href="faq.php">FAQ Page</a></li>
                  <li><a href="404.php">404 Not Found</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="contact.php">Contact</a></li>
            </ul>
            <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search friends, photos, videos">
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->

    <div id="page-contents">
    	<div class="container">
    		<div class="row">

    			<!-- Newsfeed Common Side Bar Left
          ================================================= -->
    			<div class="col-md-3 static">
            <div class="profile-card">
            	<img src="images/users/user-1.jpg" alt="user" class="profile-photo" />
            	<h5><a href="timeline.php" class="text-white">Sarah Cruiz</a></h5>
            	<a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
            </div><!--profile card ends-->
            <ul class="nav-news-feed">
              <li><i class="icon ion-ios-paper"></i><div><a href="newsfeed.php">My Newsfeed</a></div></li>
              <li><i class="icon ion-ios-people"></i><div><a href="newsfeed-people-nearby.php">People Nearby</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="newsfeed-friends.php">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="newsfeed-messages.php">Messages</a></div></li>
              <li><i class="icon ion-images"></i><div><a href="newsfeed-images.php">Images</a></div></li>
              <li><i class="icon ion-ios-videocam"></i><div><a href="newsfeed-videos.php">Videos</a></div></li>
            </ul><!--news-feed links ends-->
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
                <div class="col-md-12">

                   <?php
                               
                                $query = "SELECT * FROM users WHERE id = $friend_id";
                                $queryexe = mysqli_query($mycon,$query);
                                $resultquery = mysqli_fetch_array($queryexe);
 
                                ?>
                  <!-- Contact List in Left-->
                
                        <div class="contact panel panel-info" style="padding: 10px;">
                        	<img style="margin-right: 5px;" src="images/users/user-2.jpg" alt="" class="profile-photo-sm pull-left"/>
                        	<div class="msg-preview">
                        		<h3><?php echo $resultquery['lastname']." ".$resultquery['firstname'];?></h3>
                        		<p class="text-muted"></p>
                            <small class="text-muted"></small>
                            <div class="chat-alert"></div>
                        	</div>
                        </div>
                     <!--Contact List in Left End-->

                </div>
                <div class="col-md-12">

                  <!--Chat Messages in Right-->
                  <div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
                    <div class="tab-pane active" id="contact-1">
                      <div class="chat-body">
                      	<ul class="chat-message">
                          <?php
                            $current_user = $_SESSION['user_id'];
                            $querychat = "SELECT * FROM chat WHERE receiver_id = $friend_id OR sender_id= $friend_id AND receiver_id = $current_user OR sender_id = $current_user";
                            $chatexe = mysqli_query($mycon,$querychat);
                            while($chatresult = mysqli_fetch_array($chatexe)) {
                              if ($chatresult['receiver_id']== $friend_id OR $chatresult['receiver_id']== $current_user) {
                                if ($chatresult['sender_id']== $friend_id OR $chatresult['sender_id']== $current_user) {
                                
                                
                             
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
                      	
                          <li class="<?php echo $class; ?>">
                      			<img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-right" />
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
                        }
                        }
                          ?>
                         
                      	</ul>
                      </div>
                    </div>
                    <div class="tab-pane" id="contact-2">
                      <div class="chat-body">
                      	<ul class="chat-message">
                      		<li class="left">
                      			<img src="images/users/user-10.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Julia Cox</h5>
                              	<small class="text-muted">a day ago</small>
                              </div>
                              <p>Hi</p>
                            </div>
                      		</li>
                          <li class="right">
                      			<img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-right" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Sarah Cruiz</h5>
                              	<small class="text-muted">a day ago</small>
                              </div>
                              <p>hellow</p>
                            </div>
                      		</li>
                          <li class="left">
                      			<img src="images/users/user-10.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Julia Cox</h5>
                              	<small class="text-muted">an hour ago</small>
                              </div>
                              <p>good</p>
                            </div>
                      		</li>
                          <li class="right">
                      			<img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-right" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Sarah Cruiz</h5>
                              	<small class="text-muted">an hour ago</small>
                              </div>
                              <p>see you soon</p>
                            </div>
                      		</li>
                      	</ul>
                      </div>
                    </div>
                    <div class="tab-pane" id="contact-3">
                      <div class="chat-body">
                      	<ul class="chat-message">
                      		<li class="right">
                      			<img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-right" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Sarah</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                      		</li>
                          <li class="left">
                      			<img src="images/users/user-3.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Sophia Lee</h5>
                              	<small class="text-muted">a day ago</small>
                              </div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
                            </div>
                      		</li>
                          <li class="right">
                      			<img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-right" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Sarah  Cruiz</h5>
                              	<small class="text-muted">13 hours ago</small>
                              </div>
                              <p>Okay fine. thank you</p>
                            </div>
                      		</li>
                      	</ul>
                      </div>
                    </div>
                    <div class="tab-pane" id="contact-4">
                      <div class="chat-body">
                      	<ul class="chat-message">
                      		<li class="left">
                      			<img src="images/users/user-4.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>John Doe</h5>
                              	<small class="text-muted">a day ago</small>
                              </div>
                              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>
                            </div>
                      		</li>
                          <li class="left">
                      			<img src="images/users/user-4.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>John Doe</h5>
                              	<small class="text-muted">a day ago</small>
                              </div>
                              <p>hey anybody there</p>
                            </div>
                      		</li>
                      	</ul>
                      </div>
                    </div>
                    <div class="tab-pane" id="contact-5">
                      <div class="chat-body">
                      	<ul class="chat-message">
                      		<li class="left">
                      			<img src="images/users/user-9.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Anna Young</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores</p>
                            </div>
                      		</li>
                          <li class="left">
                      			<img src="images/users/user-9.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Anna Young</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                            </div>
                      		</li>
                          <li class="right">
                      			<img src="images/users/user-1.jpg" alt="" class="profile-photo-sm pull-right" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Sarah Cruiz</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>I gotta go</p>
                            </div>
                      		</li>
                      	</ul>
                      </div>
                    </div>
                    <div class="tab-pane" id="contact-6">
                      <div class="chat-body">
                      	<ul class="chat-message">
                      		<li class="left">
                      			<img src="images/users/user-8.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Richard Bell</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>Hello</p>
                            </div>
                      		</li>
                          <li class="left">
                      			<img src="images/users/user-8.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Richard Bell</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>Hi</p>
                            </div>
                      		</li>
                          <li class="left">
                      			<img src="images/users/user-8.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Richard Bell</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>Hey</p>
                            </div>
                      		</li>
                          <li class="left">
                      			<img src="images/users/user-8.jpg" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>Richard Bell</h5>
                              	<small class="text-muted">2 days ago</small>
                              </div>
                              <p>Hey there</p>
                            </div>
                      		</li>
                      	</ul>
                      </div>
                    </div>
                  </div><!--Chat Messages in Right End-->

                  <div class="send-message" id="refresh">
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
    
   
    
  

    <!-- Scripts
    ================================================= -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky-kit.min.js"></script>
    <script src="js/jquery.scrollbar.min.js"></script>
    <script src="js/script.js"></script>

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
