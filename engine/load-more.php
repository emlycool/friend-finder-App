 <?php
    session_start();
    include_once("../engine/database.php");
                                if (isset($_POST['load_count'])) {
                                        $search_input = $_POST['search_input'];
                                        $total_pages_sql = "SELECT COUNT(*) FROM blog_post WHERE title LIKE '%$search_input%' OR category LIKE '%$search_input%' ORDER BY id DESC";
                                        $result = mysqli_query($mycon, $total_pages_sql);
                                        $total_rows = mysqli_fetch_array($result)[0];
                                        

                                        $load_count = $_POST['load_count'];

                                        $retrive_blog_post = "SELECT * FROM blog_post WHERE title LIKE '%$search_input%' OR category LIKE '%$search_input%' ORDER BY id DESC LIMIT $load_count"; 
                                        $retrieve_ini = mysqli_query($mycon, $retrive_blog_post);
                                        while ($postresult = mysqli_fetch_array($retrieve_ini)) {
                                        $poster= $postresult['poster_id'];
                                        $new_date= date('d M, Y| h:i:sa', strtotime($postresult['date_added']));
                                        $retrive_post_sender = "SELECT * FROM admin WHERE id = {$poster}";   
                                        $retrieve_exe = mysqli_query($mycon, $retrive_post_sender);
                                        $posterresult = mysqli_fetch_array($retrieve_exe);
                                    ?>
                                    <div id="hidden" class="blog_grid_item">
                                        <?php
                                        if (!empty($postresult['img_dir'])) {
                                            echo "<img src='".$postresult['img_dir']."' alt=''>";
                                        }
                                        ?>
                                        <div class="blog_grid_content">
                                            <h3><?php echo $postresult['title']; ?></h3>
                                            <div class="blog_grid_date">
                                                <a href="#">By <?php echo $posterresult['fullname']; ?></a>
                                                <a href="#"><?php echo $new_date; ?></a>
                                                <a href="#"><?php echo $postresult['category'];  ?></a>
                                            </div>
                                            <p style='white-space: pre-wrap ; white-space: pre-line; margin-top: -1em;'>
                                            <?php
                                                $blog_content = $postresult['content'];
                                                if (strlen($blog_content) > 300) {
                                                    echo substr($postresult['content'], 0, 300) . "...<a href='post_page.php?postid={$postresult['id']}'>Read More <i class='fa fa-angle-double-right'></i></a>";
                                                }else{
                                                    echo $blog_content;
                                                }
                                            
                                            ?>
                                            </p>
                                            
                                            
                                        </div> 
                                    </div>
                                    <?php
                                    }
                                
                                        
                                    if ($total_rows < $load_count) {
                                        
                                    }else{
                                    ?>
                                    <div class="col-md-4 col-md-offset-5">
                                        <button class="btn btn-danger " id="load-btn" onClick="load(<?php echo $load_count; ?>);">Load more</button>
                                    </div>
                                    <?php
                                    }
                                }
if (isset($_POST['all_comments'])) {
                                    $post_id = $_POST['all_comments'];
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
                                    $total_replies_sql = "SELECT COUNT(*) FROM blog_post_comment_reply WHERE post_id = $post_id AND comment_id = {$retrieve_comment['id']}";
                                    $result = mysqli_query($mycon, $total_replies_sql);
                                    $total_replies = mysqli_fetch_array($result)[0];    
                                    $reply_checker = " SELECT * FROM blog_post_comment_reply WHERE post_id = $post_id AND comment_id = {$retrieve_comment['id']} LIMIT 2";
                                    $reply_exe = mysqli_query($mycon, $reply_checker);
                                    
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
                                    if ($total_replies > 2) {
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
                                    
                                

}
if (isset($_POST['all_replies'])) {
                                        $post_id = $_POST['all_replies'];
                                        $comment_id = $_POST['comment_id'];
                                        
                                        $reply_checker = " SELECT * FROM blog_post_comment_reply WHERE post_id = $post_id AND comment_id = $comment_id ";
                                    $reply_exe = mysqli_query($mycon, $reply_checker);
                                    
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
}
if (isset($_POST['all_Scomment'])) {

                    $load_count = $_POST['all_Scomment'];
                    $post_id = $_POST['lpid'];
                    $total_comments_sql = "SELECT COUNT(*) FROM social_post_comments WHERE post_id = $post_id";
                                $result_c = mysqli_query($mycon, $total_comments_sql);
                                $total_comments = mysqli_fetch_array($result_c)[0];
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
                                      <p><a href="timeline.html" class="profile-link"><?php echo $user_details2['firstname']. " ".$user_details2['lastname']; ?> </a><i class="em em-laughing"></i> <?php echo $retrieve_comment2['comment']; ?></p>
                                    </div>
                                <?php
                                }
                                ?>
                                </div><div id="user-comment"></div>
                                <?php
                                if (($total_comments > $load_count)) {
                                
                                ?>
                                <div class="text-center">
                                    <input type="text" id="input" value="<?php echo $post_id;  ?>" hidden>
                                    <button class="btn btn-info " id="load-btn" onClick="loadComments(<?php echo $load_count; ?>);">Load more</button>
                                </div>
                                <?php
                                }
                                
}
?>

                                    
