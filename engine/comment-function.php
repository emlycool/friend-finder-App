<?php
session_start();
include_once("database.php");
include_once('../processes/my-functions.php');
if (isset($_POST['post_id'])) { $post_id = $_POST['post_id'];
                            
                                $post_id = $_POST['post_id'];
                                $comment_checker = " SELECT * FROM blog_post_comments WHERE post_id = $post_id";
                                $comment_exe = mysqli_query($mycon, $comment_checker);
                                while($retrieve_comment = mysqli_fetch_array($comment_exe) ){
                                    $date_commented = date('d M, Y | h:ia', strtotime($retrieve_comment['date_added']));
                                    $new_date_commented = str_replace("|", "at", $date_commented);
                                    $query_user = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_comment['commenter_id']}";
                                    $user_exe = mysqli_query($mycon, $query_user);
                                    $user_details = mysqli_fetch_array($user_exe);
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="../<?php echo $user_details['profile_pic']; ?>" height="70" width ="70"   alt="profile pic" class=" img-circle">
                                    </div>
                                    <div class="media-body">
                                        <h4><?php echo $user_details['firstname']. " ". $user_details['lastname']; ?></h4>
                                        <h5><?php echo $new_date_commented; ?></h5>
                                        <p><?php echo $retrieve_comment['comment'];  ?></p>
                                        <?php
                                            if (isset($_SESSION['user_id'])) {
                                                
                                            
                                        ?>
                                        <a onClick="san(<?php echo $retrieve_comment['id']; ?>);" ><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                                        <?php
                                            }else{
                                        ?>
                                        <a href="#!" data-toggle="modal" data-target="#loginModal"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                                        <?php
                                            }
                                        ?>
                                        <form id="reply-form-<?php echo $retrieve_comment['id']; ?>" role="form" class="form-inline"  method="post" >
                                            <div class="post-comment row" id="reply-input<?php echo $retrieve_comment['id']; ?>" style ="display: none;">
                                                <div class="col-md-1">
                                                    <img src="../<?php echo $user_details['profile_pic']; ?>" alt="" class="profile-photo-sm" />
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="reply-input-<?php echo $retrieve_comment['id'];  ?>" name="reply_input" class="form-control" placeholder="Post a reply">
                                                    <input type="number" id="post_id-<?php echo $retrieve_comment['id'];  ?>" name ="post_id" hidden value="<?php echo $post_id; ?>">
                                                    <input type="number" id="comment_id-<?php echo $retrieve_comment['id']; ?>" name ="comment_id" hidden value="<?php echo $retrieve_comment['id']; ?>">   
                                                </div>
                                                <div class="col-md-2">
                                                    <button onClick="reply(<?php echo $retrieve_comment['id']; ?>);" class="btn btn-primary" name="reply_btn" type="button" id="reply-btn-<?php echo $retrieve_comment['id']; ?>">Send</button>
                                                </div>
                                                <div class="col-md-4" id="reply-error-<?php echo $retrieve_comment['id']; ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="replysection_<?php echo $retrieve_comment['id'];  ?>">
                                    <?php
                                        $reply_checker = " SELECT * FROM blog_post_comment_reply WHERE post_id = $post_id AND comment_id = {$retrieve_comment['id']} LIMIT 2";
                                        


                                    $reply_exe = mysqli_query($mycon, $reply_checker);
                                    $total_replies = mysqli_num_rows($reply_exe);
                                    while($retrieve_reply = mysqli_fetch_array($reply_exe) ){
                                        $date_replied = date('d M, Y | h:ia', strtotime($retrieve_reply['date_added']));
                                        $new_date_replied = str_replace("|", "at", $date_replied);
                                        $query_user2 = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_reply['replyer_id']}";
                                        $user_exe2 = mysqli_query($mycon, $query_user2);
                                        $user_details2 = mysqli_fetch_array($user_exe2);
                                    ?>
                                    <div class="media reply_comment" >
                                        <div class="media-left">
                                            <img src="../<?php echo $user_details2['profile_pic']; ?>" alt="" class="profile-photo-sm">
                                        </div>
                                        <div class="media-body">
                                            <h4><?php echo $user_details2['firstname']. " ".$user_details2['lastname']; ?></h4>
                                            <h5><?php echo $new_date_replied; ?></h5>
                                            <p><?php echo $retrieve_reply['reply']; ?></p>
                                        </div>
                                        
                                    </div>
                                    <?php
                                    }// closing loop for replies
                                    if ($total_replies > 0) {
                                    ?>
                                    <div class="col-md-12 text-center">
                                        <a onClick="loadReplies(<?php echo $retrieve_comment['id']; ?>);" ><i class="fa fa-arrow-down" aria-hidden="true"></i>&nbspView all replies</a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                    <?php
                                    }//closing loop for comments
                                    ?>

                                
                               
                                
                            
<?php

                                
}
if (isset($_POST['Spost_id'])) {
    $post_id = $_POST['Spost_id'];
    $comment_checker = "SELECT * FROM social_post_comments WHERE post_id = $post_id AND commenter_id = {$_SESSION['user_id']} ORDER BY id DESC";
                    $comment_exe = mysqli_query($mycon, $comment_checker);
                    $retrieve_comment = mysqli_fetch_array($comment_exe);
                    $date_commented = date('d M, Y | h:ia', strtotime($retrieve_comment['date_added']));
                    $new_date_commented = str_replace("|", "at", $date_commented);
                    $query_user = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_comment['commenter_id']}";
                    $user_exe = mysqli_query($mycon, $query_user);
                    $user_details = mysqli_fetch_array($user_exe);
                              
                  ?>
                    <div class="post-comment">
                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                      <p><a href="timeline.php" class="profile-link"><?php echo $user_details['firstname']. " ".$user_details['lastname']; ?> </a><?php echo $retrieve_comment['comment']; ?></p>
                    </div>
                  <?php
                    
}
if(isset($_POST['modal_post'])){
    $post_id = $_POST['modal_post'];
    $querypost = "SELECT * FROM social_posts WHERE id = $post_id ORDER by id";
                          $postini = mysqli_query($mycon, $querypost);
                          $postresult = mysqli_fetch_array($postini);
                          $queryuser = "SELECT profile_pic,firstname,lastname FROM users WHERE id = {$postresult['poster_id']}";// to get profile pic
                                   $userexe = mysqli_query($mycon, $queryuser);
                                   $userinfo = mysqli_fetch_array($userexe);
                                   $total_comments_sql = "SELECT COUNT(*) FROM social_post_comments WHERE post_id = $post_id";
                                $result_c = mysqli_query($mycon, $total_comments_sql);
                                $total_comments = mysqli_fetch_array($result_c)[0];
?>
<div class="modal fade modal-1" tabindex="-1" role="dialog" aria-hidden="true" id="commentModal">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="post-content">
                            <div class="post-container">
                              <img src="../images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
                              <a href="timeline.php" class="profile-link"><?php echo $userinfo['firstname']." ".$userinfo['lastname']; ?></a> 
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
                                      <p><a href="timeline.html" class="profile-link"><?php echo $user_details2['firstname']. " ".$user_details2['lastname']; ?> </a>&nbsp; <?php echo $retrieve_comment2['comment']; ?></p>
                                      <p class="pull-right"><span class="text-muted">&nbsp<?php echo get_timeago($retrieve_comment2['date_added'] ); ?></span></p>

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

?>