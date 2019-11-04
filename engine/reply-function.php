<?php
session_start();
include_once("database.php");
if (isset($_POST['comment_id'])) {                 
                                $reply_checker = " SELECT * FROM blog_post_comment_reply WHERE post_id = {$_POST['rpost_id']} AND comment_id = {$_POST['comment_id']}";


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
?>