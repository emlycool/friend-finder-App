<!-- Modal video -->
<div id="textModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal textUpload content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Post text</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
         <form   method='post' id='textUpload' enctype="multipart/form-data">
          <textarea  name="modal_texts" id="modal_texts" cols="30" rows="7" class="form-control form-group" placeholder="Write what you wish"></textarea></textarea>
          <input type='submit' class='btn btn-info' value='Published' >
        </form>
        <!-- Preview-->
        <div id='TEXTpreview-error'></div>
      </div>
    </div>
  </div>
</div>
<div id="videoModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal videoUpload content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Post Video</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
         <form   method='post' id='videoUpload' enctype="multipart/form-data">
          Select file : <input type='file' name='video[]' id='file-video' class='form-control' multiple required><br>
          
          <hr><textarea  name="Vcaption" id="modal_texts" cols="30" rows="3" class="form-control form-group" placeholder="Caption"></textarea></textarea>
          <input type='submit' class='btn btn-info' value='Post' >
        </form>
        <!-- Preview-->
        <div id='VIDpreview-error'></div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Picture</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form   method='post' id='upload' enctype="multipart/form-data">
          Select file : <input type='file' name='file[]' id='file' class='form-control' multiple required>
          <hr><textarea  name="pic_caption" id="modal_texts" cols="30" rows="3" class="form-control" placeholder="Caption"></textarea></textarea>
          <br>
          <input type='submit' id="Pupload-btn" class='btn btn-info' value='Post' >
        </form>

        <!-- Preview-->
        <div id='PICpreview-error'></div>
      </div>
 
    </div>

  </div>
</div>
<!--Popup       <?php 
                      
                    ?>
                    <div class="modal fade in modal-1" tabindex="-1" role="dialog" aria-hidden="true" id="commentModal">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="modal-content">
                          <?php
                          $post_id = $_SESSION['modal_post'];
                          $querypost = "SELECT * FROM social_posts WHERE id = $post_id";
                          $postini = mysqli_query($mycon, $querypost);
                          $postresult = mysqli_fetch_array($postini);
                          $queryuser = "SELECT profile_pic,firstname,lastname FROM users WHERE id = {$postresult['poster_id']}";// to get profile pic
                                   $userexe = mysqli_query($mycon, $queryuser);
                                   $userinfo = mysqli_fetch_array($userexe);
                          ?>
                          <div class="post-content">
                            <div class="post-container">
                              <img src="../images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
                              <a href="timeline.php" class="profile-link"><?php echo $userinfo['firstname']." ".$userinfo['lastname']; ?></a> 
                              <div class="post-detail">
                                
                                
                                <div class="line-divider"></div>
                                <div class="post-text">
                                  <p><?php echo $postresult['captions']; ?><i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                </div>
                                <div class="line-divider"></div>
                                <?php
                                $comment_checker2 = " SELECT * FROM social_post_comments WHERE post_id = $post_id  ORDER BY id";
                                $comment_exe2 = mysqli_query($mycon, $comment_checker2);
                                while($retrieve_comment2 = mysqli_fetch_array($comment_exe2) ){
                                  $date_commented2 = date('d M, Y | h:ia', strtotime($retrieve_comment2['date_added']));
                                  $new_date_commented2 = str_replace("|", "at", $date_commented2);
                                  $query_user2 = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_comment2['commenter_id']}";
                                  $user_exe2 = mysqli_query($mycon, $query_user2);
                                  $user_details2 = mysqli_fetch_array($user_exe2);
                                ?>
                                <div class="post-comment">
                                  <img src="images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                                  <p><a href="timeline.html" class="profile-link"><?php echo $user_details2['firstname']. " ".$user_details2['lastname']; ?> </a><i class="em em-laughing"></i> <?php echo $retrieve_comment2['comment']; ?></p>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="post-comment" id="comment-field">
                                  <img src="../images/users/user-1.jpg" alt="" class="profile-photo-sm" />
                                    <input type="text" id="comment_" class="form-control comment" placeholder="Post a comment">
                                    <button style="margin-left: 10px;" onClick="comment(<?php echo $postresult['id']; ?>);" class="btn btn-primary" name="comment-btn"  type="button" id="comment-btn-">Send</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </divPopup End-->
                    

<div id="view-comment" data-toggle="modal" data-target=".modal-1">
        
</div>

<div id="comment-modal">
  
</div>
<div id="img-modal">
</div>
<div id="vid-modal"></div>