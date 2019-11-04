<?php
	session_start();
	include_once("../engine/database.php");
  include_once('../processes/my-functions.php');

	$currentuser = $_SESSION['user_id'];
	if (isset($_POST['like_id'])) {
	$post_id = $_POST['like_id'];
		

		$query_usercheck =" SELECT * FROM blog_post_likes WHERE user_id = $currentuser AND  post_id = $post_id";
		$qini=mysqli_query($mycon, $query_usercheck);
		if (mysqli_num_rows($qini) > 0) {

			$query_delete =" DELETE FROM blog_post_likes WHERE user_id = $currentuser AND  post_id = $post_id";
			$qinidel=mysqli_query($mycon, $query_delete);
			//echo "request_canceled";
	
		}else{

		$query_insert=" INSERT INTO blog_post_likes() VALUES(NULL,$post_id,$currentuser)";
				$result_insert= mysqli_query($mycon, $query_insert);
				if ($result_insert) {
					//echo "request_sent";
				}else{
					//echo "error_occured";
				}

	   }
	   if (mysqli_num_rows($qini) > 0 ) {
        	$colorchange = "white";
    	}else{
     		$colorchange = "red";
   		}
    $likes_sql = "SELECT * FROM blog_post_likes WHERE post_id = $post_id";
    $likes_result = mysqli_query($mycon, $likes_sql);
    $total_likes= mysqli_num_rows($likes_result);
	   
?>
		<div class="viewrs" id="viewrs">
            <a  href="#comment"><i class="fa fa-comments"></i>16</a>
          	<a  onClick="like(<?php echo $post_id; ?>);"><i style="color: <?php echo $colorchange; ?>;" class="fa fa-heart" aria-hidden="true"></i><?php echo $total_likes; ?></a>
            <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i>Share</a>
        </div>
<?php      
}
if (isset($_POST['Slike_id'])) {
	$post_id = $_POST['Slike_id'];
		$query_usercheck =" SELECT * FROM social_post_likes WHERE user_id = $currentuser AND  post_id = $post_id";
		$qini=mysqli_query($mycon, $query_usercheck);
		if (mysqli_num_rows($qini) > 0) {

			$query_delete =" DELETE FROM social_post_likes WHERE user_id = $currentuser AND  post_id = $post_id";
			$qinidel=mysqli_query($mycon, $query_delete);
			if ($qinidel) {
				$total_likes_sql = "SELECT COUNT(*) FROM social_post_likes WHERE post_id = $post_id";
                $result_l = mysqli_query($mycon, $total_likes_sql);
                $total_likes = mysqli_fetch_array($result_l)[0];

           	    $total_dislikes_sql = "SELECT COUNT(*) FROM social_post_dislikes WHERE post_id = $post_id";
                $result_d = mysqli_query($mycon, $total_dislikes_sql);
            	$total_dislikes = mysqli_fetch_array($result_d)[0];
?>
				<a class="btn text-muted" onClick="like(<?php echo $post_id; ?>);"><i class="icon ion-thumbsup"></i> <?php echo $total_likes; ?></a>
                <a class="btn text-muted" onClick="dislike(<?php echo $post_id; ?>);"><i class="fa fa-thumbs-down"></i> <?php echo $total_dislikes; ?></a>
                <a onClick="commentbtn(<?php echo $post_id; ?>);" type="button"><i class="fa fa-comment" aria-hidden="true"></i></a>
<?php
			}
	
		}else{

		$query_insert="INSERT INTO social_post_likes() VALUES(NULL,$post_id,$currentuser)";
				$result_insert= mysqli_query($mycon, $query_insert);
				if ($result_insert) {
					$sql_delete =" DELETE FROM social_post_dislikes WHERE user_id = $currentuser AND  post_id = $post_id";
					$sql_ini=mysqli_query($mycon, $sql_delete);
					$total_likes_sql = "SELECT COUNT(*) FROM social_post_likes WHERE post_id = $post_id";
                    $result_l = mysqli_query($mycon, $total_likes_sql);
                    $total_likes = mysqli_fetch_array($result_l)[0];

                    $total_dislikes_sql = "SELECT COUNT(*) FROM social_post_dislikes WHERE post_id = $post_id";
                      $result_d = mysqli_query($mycon, $total_dislikes_sql);
                      $total_dislikes = mysqli_fetch_array($result_d)[0];
?>
                    <a class="btn text-green" onClick="like(<?php echo $post_id; ?>);"><i class="icon ion-thumbsup"></i> <?php echo $total_likes; ?></a>
                    <a class="btn text-muted" onClick="dislike(<?php echo $post_id; ?>);"><i class="fa fa-thumbs-down"></i> <?php echo $total_dislikes; ?></a>
                    <a onClick="commentbtn(<?php echo $post_id; ?>);" type="button"><i class="fa fa-comment" aria-hidden="true"></i></a>
<?php 			
				}else{
					//echo "error_occured";
				}

	   }        
                      /*$check_like = "SELECT COUNT(*) FROM social_post_likes WHERE post_id = $post_id AND user_id = $currentuser";
                      $res_chk = mysqli_query($mycon, $check_like);
                      $user_like= mysqli_fetch_array($res_chk)[0];
                      if ($user_like == 1) {
                      	$colorchange = "text-green";
                      }else{
                      	$colorchange = "text-muted";
                      }*/
}
if (isset($_POST['dislike_id'])) {
		$post_id = $_POST['dislike_id'];
		$query_usercheck2 =" SELECT * FROM social_post_dislikes WHERE user_id = $currentuser AND  post_id = $post_id";
		$qini2 = mysqli_query($mycon, $query_usercheck2);
		if (mysqli_num_rows($qini2) > 0) {

			$query_delete2 =" DELETE FROM social_post_dislikes WHERE user_id = $currentuser AND  post_id = $post_id";
			$qinidel2=mysqli_query($mycon, $query_delete2);
			if ($qinidel2) {
				$total_likes_sql = "SELECT COUNT(*) FROM social_post_likes WHERE post_id = $post_id";
                $result_l = mysqli_query($mycon, $total_likes_sql);
                $total_likes = mysqli_fetch_array($result_l)[0];

           	    $total_dislikes_sql = "SELECT COUNT(*) FROM social_post_dislikes WHERE post_id = $post_id";
                $result_d = mysqli_query($mycon, $total_dislikes_sql);
            	$total_dislikes = mysqli_fetch_array($result_d)[0];
?>
				<a class="btn text-muted" onClick="like(<?php echo $post_id; ?>);"><i class="icon ion-thumbsup"></i> <?php echo $total_likes; ?></a>
                <a class="btn text-muted" onClick="dislike(<?php echo $post_id; ?>);"><i class="fa fa-thumbs-down"></i> <?php echo $total_dislikes; ?></a>
                <a onClick="commentbtn(<?php echo $post_id; ?>);" type="button"><i class="fa fa-comment" aria-hidden="true"></i></a>
<?php 		}
		}else{

		$query_insert="INSERT INTO social_post_dislikes() VALUES(NULL,$post_id,$currentuser)";
				$result_insert= mysqli_query($mycon, $query_insert);
				if ($result_insert) {
					$sql_delete =" DELETE FROM social_post_likes WHERE user_id = $currentuser AND  post_id = $post_id";
					$qexedel=mysqli_query($mycon, $sql_delete);
					
					$total_likes_sql = "SELECT COUNT(*) FROM social_post_likes WHERE post_id = $post_id";
                    $result_l = mysqli_query($mycon, $total_likes_sql);
                    $total_likes = mysqli_fetch_array($result_l)[0];

                    $total_dislikes_sql = "SELECT COUNT(*) FROM social_post_dislikes WHERE post_id = $post_id";
                      $result_d = mysqli_query($mycon, $total_dislikes_sql);
                      $total_dislikes = mysqli_fetch_array($result_d)[0];
?>
                    <a class="btn text-muted" onClick="like(<?php echo $post_id; ?>);"><i class="icon ion-thumbsup"></i> <?php echo $total_likes; ?></a>
                    <a class="btn text-red" onClick="dislike(<?php echo $post_id; ?>);"><i class="fa fa-thumbs-down"></i> <?php echo $total_dislikes; ?></a>
                    <a onClick="commentbtn(<?php echo $post_id; ?>);" type="button"><i class="fa fa-comment" aria-hidden="true"></i></a>
<?php
				}else{
					//echo "error_occured";
				}

	   }
}
if (isset($_POST['friend_id'])) {
	$friend_id = $_POST['friend_id'];
	$currentuser = $_SESSION['user_id']; 
?>
<ul class="chat-message">
                          <?php
                            $current_user = $_SESSION['user_id'];
                            $query = "SELECT * FROM users WHERE id = $friend_id";
                                $queryexe = mysqli_query($mycon,$query);
                                $resultquery = mysqli_fetch_array($queryexe);
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
                      	
                          <li class="<?php echo $class; ?>">
                      			<img src="../images/users/user-1.jpg" alt="" class="profile-photo-sm pull-<?php echo $class; ?>" />
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
<?php
}
if (isset($_POST['modal_img'])) {
  $post_id = $_POST['modal_img'];
    $querypost = "SELECT * FROM social_posts WHERE id = $post_id ORDER by id";
                          $postini = mysqli_query($mycon, $querypost);
                          $postresult = mysqli_fetch_array($postini);
                          $loc = $postresult['image_dir'];
                          $queryuser = "SELECT profile_pic,firstname,lastname FROM users WHERE id = {$postresult['poster_id']}";// to get profile pic
                                   $userexe = mysqli_query($mycon, $queryuser);
                                   $userinfo = mysqli_fetch_array($userexe);
                                   $total_comments_sql = "SELECT COUNT(*) FROM social_post_comments WHERE post_id = $post_id";
                                $result_c = mysqli_query($mycon, $total_comments_sql);
                                $total_comments = mysqli_fetch_array($result_c)[0];
?>
<div class="modal fade modal-1" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="post-content">
                            <?php 
                            $all = explode("||" , $loc);
                             $NOimg = count($all) -1;
                             if ($NOimg == 1) {
                              $ext = strtolower(substr($all[0], strpos($all[0],'.'), strlen($all[0])-1));
                              if ($ext != '.mp4' AND $ext !='.mkv') {
                            ?>
                                <img src='../<?php echo $all[0]; ?>' alt='post-image' class='img-responsive post-image' />
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

                            <?php }}
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
                          }
                            ?>
                            <div class="post-container">
                              <img src="../images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
                              <a href="p-timeline.php?o_user=<?php echo $postresult['poster_id']; ?>" class="profile-link"><?php echo $userinfo['firstname']." ".$userinfo['lastname']; ?></a> 
                              <div class="post-detail">
                                
                                
                                <div class="line-divider"></div>
                                <div class="post-text">
                                  <p><?php echo $postresult['captions']; ?></p>
                                </div>
                                <div class="line-divider"></div>
                                <div id="loadC-section">
<?php                                   
                                
                                $load_count = 4;
                                $comment_checker2 = " SELECT * FROM social_post_comments WHERE post_id = $post_id  ORDER BY id LIMIT $load_count";
                                $comment_exe2 = mysqli_query($mycon, $comment_checker2);
                                while($retrieve_comment2 = mysqli_fetch_array($comment_exe2) ){
                                  $date_commented2 = date('d M, Y | h:ia', strtotime($retrieve_comment2['date_added']));
                                  $new_date_commented2 = str_replace("|", "at", $date_commented2);
                                  $query_user2 = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_comment2['commenter_id']}";
                                  $user_exe2 = mysqli_query($mycon, $query_user2);
                                  $user_details2 = mysqli_fetch_array($user_exe2);
                                ?>
                                    <div class="post-comment">
                                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                                      <p><a href="p-timeline.php?o_user=<?php echo $retrieve_comment2['commenter_id']; ?>" class="profile-link"><?php echo $user_details2['firstname']. " ".$user_details2['lastname']; ?> </a> <?php echo $retrieve_comment2['comment']; ?></p>
                                    </div>
                                <?php
                                }
                                ?>
                                    
                                <div id="user-comment"></div>
                                <?php
                                if (($total_comments > $load_count)) {
                                
                                ?>
                                <div class="text-center">
                                    <input type="text" id="input" value="<?php echo $post_id;  ?>" hidden>
                                    <button class="btn btn-info " id="load-btn" onClick="loadComments(<?php echo $load_count; ?>);">Load more</button>
                                </div>
                            </div>
                                <?php
                                }
                                ?>
                                <div class="post-comment" id="comment-field">
                                  <img src="../images/users/user-1.jpg" alt="" class="profile-photo-sm" />
                                    <input type="text" id="comment-input<?php echo $postresult['id']; ?>" class="form-control comment" placeholder="Post a comment">
                                    <button style="margin-left: 10px;" onClick="comment(<?php echo $postresult['id']; ?>);" class="btn btn-primary" name="comment-btn"  type="button" id="comment-btn-">Send</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!--Popup End-->
<?php
}
if (isset($_POST['modal_vid'])) {
                      $post_id = $_POST['modal_vid'];
    $querypost = "SELECT * FROM social_posts WHERE id = $post_id ORDER by id";
                          $postini = mysqli_query($mycon, $querypost);
                          $postresult = mysqli_fetch_array($postini);
                          $loc = $postresult['image_dir'];
                          $queryuser = "SELECT profile_pic,firstname,lastname FROM users WHERE id = {$postresult['poster_id']}";// to get profile pic
                                   $userexe = mysqli_query($mycon, $queryuser);
                                   $userinfo = mysqli_fetch_array($userexe);
                                   $total_comments_sql = "SELECT COUNT(*) FROM social_post_comments WHERE post_id = $post_id";
                                $result_c = mysqli_query($mycon, $total_comments_sql);
                                $total_comments = mysqli_fetch_array($result_c)[0];
?>
<div class="modal fade modal-1" tabindex="-1" role="dialog" aria-hidden="true" id="vd-modal">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="post-content">
                            <?php 
                            $all = explode("||" , $loc);
                            $ext = strtolower(substr($all[0], strpos($all[0],'.'), strlen($all[0])-1));
                            if ($ext != '.mp4' AND $ext !='.mkv') {
                                
                            }
                               
                             else{                              
                            ?>
                           
                            <video controls>
                              <source src="../<?php echo $all[0]; ?>" type="video/mp4">
                            </video>
                            <div class="post-container">
                              <img src="../images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
                              <a href="p-timeline.php?o_user=<?php echo $postresult['poster_id']; ?>" class="profile-link"><?php echo $userinfo['firstname']." ".$userinfo['lastname']; ?></a> 
                              <div class="post-detail">
                                
                                
                                <div class="line-divider"></div>
                                <div class="post-text">
                                  <p><?php echo $postresult['captions']; ?></p>
                                </div>
                                <div class="line-divider"></div>
                                <div id="loadC-section">
<?php                                   
                                
                                $load_count = 4;
                                $comment_checker2 = " SELECT * FROM social_post_comments WHERE post_id = $post_id  ORDER BY id LIMIT $load_count";
                                $comment_exe2 = mysqli_query($mycon, $comment_checker2);
                                while($retrieve_comment2 = mysqli_fetch_array($comment_exe2) ){
                                  $date_commented2 = date('d M, Y | h:ia', strtotime($retrieve_comment2['date_added']));
                                  $new_date_commented2 = str_replace("|", "at", $date_commented2);
                                  $query_user2 = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_comment2['commenter_id']}";
                                  $user_exe2 = mysqli_query($mycon, $query_user2);
                                  $user_details2 = mysqli_fetch_array($user_exe2);
                                ?>
                                    <div class="post-comment">
                                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                                      <p><a href="p-timeline.php?o_user=<?php echo $retrieve_comment2['commenter_id']; ?>" class="profile-link"><?php echo $user_details2['firstname']. " ".$user_details2['lastname']; ?> </a> <?php echo $retrieve_comment2['comment']; ?></p>
                                    </div>
                                <?php
                                }}
                                ?>
                                    
                                <div id="user-comment"></div>
                                <?php
                                if (($total_comments > $load_count)) {
                                
                                ?>
                                <div class="text-center">
                                    <input type="text" id="input" value="<?php echo $post_id;  ?>" hidden>
                                    <button class="btn btn-info " id="load-btn" onClick="loadComments(<?php echo $load_count; ?>);">Load more</button>
                                </div>
                            </div>
                                <?php
                                }
                                ?>
                                <div class="post-comment" id="comment-field">
                                  <img src="../images/users/user-1.jpg" alt="" class="profile-photo-sm" />
                                    <input type="text" id="comment-input<?php echo $postresult['id']; ?>" class="form-control comment" placeholder="Post a comment">
                                    <button style="margin-left: 10px;" onClick="comment(<?php echo $postresult['id']; ?>);" class="btn btn-primary" name="comment-btn"  type="button" id="comment-btn-">Send</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!--Popup End-->
<?php 
}
if (isset($_POST['unfriend_id'])) {
    $o_user = $_POST['unfriend_id'];
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
    $query_delete ="DELETE FROM userfriends WHERE user_id = {$_SESSION['user_id']} AND friend_id = $o_user OR friend_id = {$_SESSION['user_id']} AND user_id = $o_user";
      $qinidel=mysqli_query($mycon, $query_delete);
      if ($qinidel) {
      ?>
      <li><?php echo restyle_text($total_friends)."&nbspfriends(". mutual_friends($o_user,$mycon).")." ; ?></li>
                  <?php
                    $query = "SELECT * FROM userfriends WHERE user_id = {$_SESSION['user_id']} AND friend_id = $o_user OR friend_id = {$_SESSION['user_id']} AND user_id = $o_user";
                    $qexe = mysqli_query($mycon, $query);

                    if (mysqli_num_rows($qexe) < 1) {
                  ?>
                  <li><button id="<?php echo $o_user; ?>" onClick="add_friend(<?php echo $o_user; ?>);" class="btn-primary"><?php echo $request_state; ?></button></li>
                  <?php
                   }else{
                    ?>
                  <li class="dropdown">
                    <button class="btn-primary" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Friend<span><img src="../images/down-arrow.png" alt="" /></span></button>
                    <ul class="dropdown-menu newsfeed-home">
                      <li><a href="#" onClick="unfriend(<?php echo $o_user; ?>);">Unfriend</a></li>
                      <li><a href="">Block friend</a></li>
                    </ul>
                  </li>
                  <?php 
                   }
      
      }
}
?>
	