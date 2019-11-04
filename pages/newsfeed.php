<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location:../index.php");
      exit;
}
include_once("../engine/database.php");
$user = $_SESSION['user_id'];
$newtime = time();
include_once("../processes/active-users.php");
 activeU($newtime, $mycon);
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
          <?php include_once("social-modals.php") ?>


            <!-- Post Create Box
            ================================================= -->
            <div class="create-post">
              <div class="row">
                <div class="col-md-7 col-sm-7">
                  <div class="form-group">
                    <img src="../<?php echo $useri['profile_pic']; ?>" alt="" class="profile-photo-md" />
                    <textarea name="texts" data-toggle="modal" data-target="#textModal" maxlength="0" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                    <input type="number" name="poster_id" hidden value="<?php echo $user; ?>">
                  </div>
                </div>
                <div class="col-md-5 col-sm-5">
                  <div class="tools">
                    <ul class="publishing-tools list-inline">
                      <li><a data-toggle="modal" data-target="#textModal"><i class="ion-compose" ></i></a></li>
                      <li><a data-toggle="modal" data-target="#uploadModal"><i class="ion-images"></i></a></li>
                      <li><a data-toggle="modal" data-target="#videoModal"><i class="ion-ios-videocam"></i></a></li>
                    </ul>
                    <button class="btn btn-primary pull-right">Publish</button>
                    <button  id="view-comment-btn" data-toggle="modal" data-target=".modal-1" hidden>modal</button>
                  </div>
                </div>
              </div>
            </div><!-- Post Create Box End-->
            <div id="feed">
            <?php
            $querypost = "SELECT * FROM social_posts ORDER BY id DESC";
            $postini = mysqli_query($mycon, $querypost);
            while ($postresult = mysqli_fetch_array($postini)) {
             $query_f = " SELECT * FROM userfriends WHERE user_id = {$_SESSION['user_id']} AND friend_id = {$postresult['poster_id']} OR friend_id = {$_SESSION['user_id']} AND user_id = {$postresult['poster_id']}";
              $qexe_f = mysqli_query($mycon, $query_f);
              $fetch = mysqli_fetch_array($qexe_f);
              if ($_SESSION['user_id'] == $fetch['user_id']) {
                  $usertocheck = $fetch['friend_id'];
                  }
              else{
                    $usertocheck = $fetch['user_id'];
                  }
              if ($postresult['poster_id'] == $usertocheck OR $postresult['poster_id'] == $_SESSION['user_id']) {
              
             
             $poster= $postresult['poster_id'];
             $post_id = $postresult['id'];
             $queryuser = "SELECT * FROM users WHERE id = $poster";
             $userexe = mysqli_query($mycon, $queryuser);
             $userinfo = mysqli_fetch_array($userexe);
             $loc = $postresult['image_dir'];
             if ($user== $postresult['poster_id']) {
               $a = "you";
             }
             else{
              $a="following";
             }

            ?>
            <!-- Post Content
            ================================================= -->
            <div class="post-content">
              <?php
              if(!empty($postresult['image_dir'])){ 
               $all = explode("||" , $loc);
               $NOimg = count($all) -1;
               if ($NOimg == 1) {
                $ext = strtolower(substr($all[0], strpos($all[0],'.'), strlen($all[0])-1));
                if ($ext != '.mp4' AND $ext !='.mkv') {
                  echo "<img src='../".$all[0]."' alt='post-image' class='img-responsive post-image' />";
                }else{
                ?>
                 <div class="video-wrapper">
                <video class="post-video" controls> <source src="../<?php echo  $all[0]; ?>" type="video/mp4"> </video>
              </div>
              <?php

                }
                 
               }else{
              ?>
              <div id="<?php echo $postresult['id']; ?>" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  
                  <?php
                  $counter = 0;
                  while ( $counter < $NOimg) {
                  ?>
                  <li data-target="#<?php echo $postresult['id']; ?>" data-slide-to="<?php echo $counter; ?>" class="<?php if($counter == 0){ echo "active"; } ?>"></li>
                  <?php
                    $counter++;
                  }
                  ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
              <?php

               
               for($i = 0; $i < count($all) - 1; $i++){
               $ext = strtolower(substr($all[$i], strpos($all[$i],'.'), strlen($all[$i])-1));

               if($ext != '.mp4' AND $ext !='.mkv'){
              ?>
              <!-- used carousel to show mutiple images -->
                  <div class="item <?php if($all[$i] == $all[0]){ echo "active"; } ?>">
                    <img src="../<?php echo $all[$i]; ?>" alt="" class="img-responsive post-image">
                  </div>

              <?php }else{
              ?>
                  <div class="video-wrapper">
                    <video class="post-video" controls> <source src="<?php echo  $all[$i]; ?>" type="video/mp4"> </video>
                  </div>
              <?php

              }}
              ?>
                </div>
              <!-- Left and right controls -->
                <a class="left carousel-control" href="#<?php echo $postresult['id']; ?>" role="button" data-slide="prev" style="background-image:none !important; filter:none !important;">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#<?php echo $postresult['id']; ?>" role="button" data-slide="next" style="background-image:none !important; filter:none !important;">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            
              <?php
              }}?>
              <div id="gallery-<?php echo $postresult['id']; ?>"></div>
              <div class="post-container">
                <img src="../images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="p-timeline.php?o_user=<?php echo $postresult['poster_id']; ?>" class="profile-link"><?php echo $userinfo['firstname']." ".$userinfo['lastname']; ?></a> <span class="following"><?php echo $a; ?></span></h5>
                    <p class="text-muted"><?php echo get_timeago($postresult['date_posted']);
                     ?></p>
                  </div>
                  <div class="reaction" id="viewrs_<?php  echo $postresult['id']; ?>">
                    <?php
                      $total_likes_sql = "SELECT COUNT(*) FROM social_post_likes WHERE post_id = {$postresult['id']}";
                      $result_l = mysqli_query($mycon, $total_likes_sql);
                      $total_likes = mysqli_fetch_array($result_l)[0];
                      $check_like = "SELECT COUNT(*) FROM social_post_likes WHERE post_id = {$postresult['id']} AND user_id = {$_SESSION['user_id']}";
                      $res_chk = mysqli_query($mycon, $check_like);
                      $user_like= mysqli_fetch_array($res_chk)[0];
                      if ($user_like == 1) {
                        $colorchange = "text-green";
                      }else{
                        $colorchange = "text-muted";
                      }
                      $total_dislikes_sql = "SELECT COUNT(*) FROM social_post_dislikes WHERE post_id = {$postresult['id']}";
                      $result_d = mysqli_query($mycon, $total_dislikes_sql);
                      $total_dislikes = mysqli_fetch_array($result_d)[0];
                      $check_dislike = "SELECT COUNT(*) FROM social_post_dislikes WHERE post_id = {$postresult['id']} AND user_id = {$_SESSION['user_id']}";
                      $res_chk2 = mysqli_query($mycon, $check_dislike);
                      $user_dislike= mysqli_fetch_array($res_chk2)[0];
                      $total_comments_sql = "SELECT COUNT(*) FROM social_post_comments WHERE post_id = $post_id";
                                $result = mysqli_query($mycon, $total_comments_sql);
                                $total_comments = mysqli_fetch_array($result)[0];
                      if ($user_dislike == 1) {
                        $colorchange2 = "text-red";
                      }else{
                        $colorchange2 = "text-muted";
                      }
?>
                    <a class="btn <?php echo $colorchange; ?>" onClick="like(<?php echo $postresult['id']; ?>);"><i class="icon ion-thumbsup"></i> <?php echo $total_likes; ?></a>
                    <a class="btn <?php echo $colorchange2; ?>" onClick="dislike(<?php echo $postresult['id']; ?>);"><i class="fa fa-thumbs-down"></i> <?php echo $total_dislikes; ?></a>
                    <a onClick="commentbtn(<?php echo $postresult['id']; ?>);" type="button"><i class="fa fa-comment" aria-hidden="true"></i></a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p><?php echo $postresult['captions']; ?></p>
                  </div>
                  <div class="line-divider"></div>
                  <div id="post-section<?php echo $postresult['id'];  ?>"><!--postsection div open-->
                  <?php
                    $load_count = 2;
                    $comment_checker = " SELECT * FROM social_post_comments WHERE post_id = $post_id  ORDER BY id LIMIT $load_count";
                    $comment_exe = mysqli_query($mycon, $comment_checker);
                    while($retrieve_comment = mysqli_fetch_array($comment_exe) ){
                      $date_commented = date('d M, Y | h:ia', strtotime($retrieve_comment['date_added']));
                        $new_date_commented = str_replace("|", "at", $date_commented);
                        $query_user = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_comment['commenter_id']}";
                        $user_exe = mysqli_query($mycon, $query_user);
                        $user_details = mysqli_fetch_array($user_exe);
                      $friendlist = "SELECT DISTINCT friend_id  FROM userfriends WHERE friend_id = {$retrieve_comment['commenter_id']} AND user_id = {$_SESSION['user_id']} LIMIT $load_count";
                      $friend_exe = mysqli_query($mycon, $friendlist);
                      if (mysqli_num_rows($friend_exe) > 0) {
                        $retrieve_friend = mysqli_fetch_array($friend_exe);
                          if ($retrieve_comment['commenter_id'] == $retrieve_friend['friend_id']) {
                    ?>
                      <div class="post-comment">
                        <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                        <p><a href="p-timeline.php?o_user=<?php echo $retrieve_comment['commenter_id']; ?>" class="profile-link"><?php echo $user_details['firstname']. " ".$user_details['lastname']; ?> </a><?php echo $retrieve_comment['comment']; ?></p>
                      </div>
                  <?php

                          }
                        
                      }elseif ($retrieve_comment['commenter_id'] == $_SESSION['user_id']) {
                  ?>
                    <div class="post-comment">
                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                      <p><a href="p-timeline.php?o_user=<?php echo $retrieve_comment['commenter_id']; ?>" class="profile-link"><?php echo $user_details['firstname']. " ".$user_details['lastname']; ?> </a>&nbsp;<?php echo $retrieve_comment['comment']; ?></p>
                    </div>
                  <?php
                      }else{
                  ?>
                    <div class="post-comment">
                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                      <p><a href="p-timeline.php?o_user=<?php echo $postresult['poster_id']; ?>" class="profile-link"><?php echo $user_details['firstname']. " ".$user_details['lastname']; ?> </a><?php echo $retrieve_comment['comment']; ?></p>
                    </div>
                  <?php
                      }
                    }if ($total_comments > 2) {
                      
                    
                    ?>
                 
                  <a onClick="commentbtn(<?php echo $postresult['id']; ?>);" type="button"  class="pull-right"><i class="fa fa-comment" aria-hidden="true"></i>&nbspView all <?php echo " ".$total_comments; ?> comments</a>
                  <?php
                    }
                  ?>
                  </div><!-- postsection div-->    
                </div>
              </div>
            </div>

            <?php
          }}
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
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>

    <!-- Images grid -->
    <script type="">
      var input = document.getElementById("find");
      input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
         event.preventDefault();
         document.getElementById("mybtn").click();
        }
      });
      
    </script>
    <script type="text/javascript" src="../js/my-functions.js"></script>
    
    <script src="../js/upload.js"></script>
  </body>

<!-- Mirrored from mythemestore.com/friend-finder/newsfeed.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Feb 2019 21:38:13 GMT -->
</html>
