<?php 
session_start();
include_once("../engine/database.php");
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from html.verodate.com/verodate/single-blog-right-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2019 05:43:33 GMT -->
<?php
include_once("blog-header.php");
?>
    <body>           
        <!--================Frist Main hader Area =================-->
        <?php include_once("blog-menu.php"); ?>
        
        <!--================Frist Main hader Area =================-->
        
        <!--================Banner Area =================-->
        <!--================End Banner Area =================-->
        <!--================End Banner Area =================-->
        
        <!--================Blog grid Area =================-->
        <section class="blog_grid_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog_details_content">
                            <div class="single_blog_image">
                                <?php
                                        $post_id = $_GET['postid'];
                                        $retrive_blog_post = "SELECT * FROM blog_post WHERE id = $post_id"; 
                                        $retrieve_ini = mysqli_query($mycon, $retrive_blog_post);
                                        $postresult = mysqli_fetch_array($retrieve_ini);
                                        $poster= $postresult['poster_id'];
                                        $new_date= date('d M, Y | h:ia', strtotime($postresult['date_added']));
                                        $retrive_post_sender = "SELECT * FROM admin WHERE id = {$poster}";   
                                        $retrieve_exe = mysqli_query($mycon, $retrive_post_sender);
                                        $posterresult = mysqli_fetch_array($retrieve_exe);
                                        $date_t = str_replace("|", "at", $new_date );
                                    ?>
                                <h3>Blog image standard post</h3>
                                <div class="admin_date">
                                    <a>By <?php echo $posterresult['fullname']; ?></a>
                                    <a><?php echo $date_t; ?></a>
                                    <a href="blog-category.php?cat=<?php echo $postresult['category']; ?>"><?php echo ucfirst($postresult['category']);  ?></a>
                                </div>
                                <?php
                                   if (!empty($postresult['img_dir'])) {
                                        echo "<img src='".$postresult['img_dir']."' alt='' class='img-responsive'>";
                                    }
                                ?>
                            </div>
                            <div class="blog_quote">
                                <p><?php echo $postresult['content']; ?></p>
                            </div>
                            <div class="blog_standard">
                                <?php
                                                    /*
                                                    $user_id = $_SESSION['user_id'];
                                                    $post_id = $postresult['id'];
                                                    $likes_sql = "SELECT * FROM blog_post_likes WHERE post_id = $post_id";
                                                    $likes_result = mysqli_query($mycon, $likes_sql);
                                                    $total_likes= mysqli_num_rows($likes_result);

                                                    $likechecker = " SELECT * FROM blog_post_likes WHERE user_id= $user_id AND post_id = $post_id";

                                                    $exechecker= mysqli_query($mycon, $likechecker);
                                                    if (mysqli_num_rows($exechecker) > 0 ) {
                                                      $colorchange = "red";
                                                    }else{
                                                      $colorchange = "white";
                                                    }
                                                    */
                                                    $post_id = $postresult['id'];
                                                    $likes_sql = "SELECT * FROM blog_post_likes WHERE post_id = $post_id";
                                                    $likes_result = mysqli_query($mycon, $likes_sql);
                                                    $total_likes= mysqli_num_rows($likes_result);
                                                    if (isset($_SESSION['user_id'])) {
                                                        $user_id = $_SESSION['user_id'];
                                            
                                                        $likechecker = " SELECT * FROM blog_post_likes WHERE user_id= $user_id AND post_id = $post_id";

                                                        $exechecker= mysqli_query($mycon, $likechecker);
                                                        if (mysqli_num_rows($exechecker) > 0 ) {
                                                          $colorchange = "red";
                                                        }else{
                                                          $colorchange = "white";
                                                        }   
                                                    }
                                                    if (!isset($_SESSION['user_id'])) {
                                                       
                                                    
                                                    ?>
                                                    <div class="viewrs">
                                                        <a href="#!" data-toggle="modal" data-target="#loginModal"><i class="fa fa-comments"></i>16</a>
                                                        <a href="#!" data-toggle="modal" data-target="#loginModal"><i style="color: <?php if (isset($_SESSION['user_id'])) { echo $colorchange; }else{ echo "white"; }  ?>;" class="fa fa-heart" aria-hidden="true"></i><?php echo $total_likes; ?></a>
                                                        <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i>Share</a>
                                                    </div>
                                                    <?php
                                                    }
                                                    else{
                                                    ?>
                                                    <div class="viewrs" id="viewrs">
                                                        <a  href="#comment"><i class="fa fa-comments"></i>16</a>
                                                        <a  onClick="like(<?php echo $postresult['id']; ?>);" ><i style="color: <?php echo $colorchange; ?>;" class="fa fa-heart" aria-hidden="true"></i><?php echo $total_likes; ?></a>
                                                        <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i>Share</a>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                            </div>
                        </div>
                        <div class="blog_comment_list">
                            <h3>Comments</h3>
                            <div class="blog_comment_item" id="reset">
                                <?php
                                $post_id = $_GET['postid'];
                                $total_comments_sql = "SELECT COUNT(*) FROM blog_post_comments WHERE post_id = $post_id";
                                $result = mysqli_query($mycon, $total_comments_sql);
                                $total_comments = mysqli_fetch_array($result)[0];
                                $load_count = 4;
                                $comment_checker = " SELECT * FROM blog_post_comments WHERE post_id = $post_id LIMIT $load_count";
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
                                                    <input type="text" id="reply-input-<?php echo $retrieve_comment['id'];  ?>" name="reply_input" class="form-control" placeholder="Post a reply" maxlength="20">
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
                                    if ($total_comments > $load_count) {    
                                    ?>
                                <hr>
                                <div class="col-md-12 text-center">

                                    <button onClick="loadComments();" type="button"  class="btn btn-info text-center"><i class="fa fa-comment" aria-hidden="true"></i>&nbspView all <?php echo " ".$total_comments; ?> comments </button> 
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        
                        
                        <div class="comment_form_area" id="comment">
                            <?php
                                            if (isset($_SESSION['user_id'])) {
                            
                                            
                                        ?>
                            <h4>Leave a Comment</h4>
                            <div class="row">
                                <form class="form_inner" method='post' id="comment-form">
                                    <div id="comment_error" class="col-md-12">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea type= "text" name="comment" id="comment_input" placeholder="Comment" rows="1"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="number" id="post-id" name ="post_id" hidden value="<?php echo $post_id;  ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <!--method(comment)<button type="submit" onClick="com(<?php echo $post_id; ?>);" id="comment_btn" name="comment_btn" class="btn form-control login_btn">Submit</button><-->
                                        <button type="submit" id="comment_btn" name="comment_btn" class="btn form-control login_btn">Submit</button>
                                    </div>
                                </form>

                            </div>
                            
                                        <?php
                                            }else{
                                        ?>
                                <div class="col-md-12 " style="margin-top: 13px;">
                                
                                <button  class='btn form-control login_btn' data-toggle="modal" data-target="#loginModal">Login to Comment</button></div>
                                <?php
                            }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
<?php  include_once("blog-footer.php") ?>
            
        <!--================End Footer Area =================-->
        
        
        
        
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&amp;callback=initMap"></script>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.sticky-kit.min.js"></script>
        <script src="../js/jquery.scrollbar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
        <script src="../js/script.js"></script>
        
  
        <!-- Extra plugin js -->
        
        
        <script type="text/javascript" src="../js/validation.min.js"></script>
        <script type="text/javascript" src="../js/login.js"></script>
        
        <script type="text/javascript" src="../js/sweetalert.min.js"></script>
        <script type="text/javascript">
            /* function like(id){
                if (window.XMLHttpRequest){
                 xmlhttp=new XMLHttpRequest();
                    }

                    else{
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }

                    xmlhttp.open("POST","../engine/like.php",true);
                    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xmlhttp.send("like_id="+id);
                   // alert('Friend Request Sent');
                   
                    $("#refresh_"+id).load("../engine/test.php", {post_id: id }, function(){
                        
                    });

                    //var elem = document.getElementById('#id_'+id);
                    //elem.style.color = "red";
                    

                 
                     
                   // $("#"+id).load(" #"+id);
               
            }
            
                function reply(a){
                    $("#reply-input"+a).toggle();
                    $(document).ready(function(){
                        $("#reply-form-"+a).submit(function(e){
                                e.preventDefault();
                                var cid = document.getElementById("comment_id-"+a).value;
                                var rpid = document.getElementById("post-id").value;
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/insert.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                    $("#reply-error-"+a).fadeOut();
                                    $("#reply-btn-"+a).html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Sending');                                       
                                    },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(response){
                                        if(response === "ok"){                                 
                                            $("#reply-btn-"+a).html(' Sent ');
                                            $("#reset").load( "../engine/reply-function.php",{comment_id : cid, rpost_id : rpid }, function(){
                                                alert("replied");
                                                $("#reply-btn-"+a).html('<img src="ajax-loader.gif" /> &nbsp; Send');
                                            });
                                        } else {                                    
                                            $("#reply-error-"+a).fadeIn(1000, function(){                        
                                                $("#reply-error-"+a).html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                                                $("#reply-btn-"+a).html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Try again');
                                            });
                                        }
                                    }
                                });
                                return false;
                            });

                        });         
                }
                function replyComment(a){
                    
                }
            */  
            
                function loadReplies(rc){
                    var post_id ='<?php echo $post_id; ?>';
                    $("#replysection_"+rc).load("../engine/load-more.php",{all_replies : post_id, comment_id : rc}, function(){
                        
                    }).slideDown("slow");
                }

                function loadComments(){
                    var post_id ='<?php echo $post_id; ?>';
                    
                    $("#reset").load("../engine/load-more.php",{all_comments : post_id}, function(){
                        
                    }).slideDown("slow");
                }
                function goBack() {
                    window.history.back()
                }
                function like(id){
                    $("#viewrs").load("../engine/test2.php",{like_id : id });
                }
                input.addEventListener("keyup", function(event) {
                    if (event.keyCode === 13) {
                     event.preventDefault();
                     document.getElementById("mybtn").click();
                    }
                });
                
             
        </script>
        <script type="text/javascript">
            //another method(comment)
            /*function com(cid){
                $(document).ready(function(){
                        $("#comment-form").submit(function(e){
                                e.preventDefault();
                              
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/insert.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                    $("#comment_error").fadeOut();
                                    $("#comment_btn").html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Please wait');                                       
                                    },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(response){
                                        if(response === "ok"){
                                            //$(".blog_comment_item").load("../engine/comment-function.php"{})                                
                                            $("#comment_btn").html('<img src="ajax-loader.gif" /> &nbsp; Sent');
                                            $("#reset").load( "../engine/comment-function.php",{post_id : cid }, function(){
                                                alert("commented");
                                            });
                                        } else {                                    
                                            $("#comment_error").fadeIn(1000, function(){                        
                                                $("#comment_error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                                                $("#comment_btn").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Submit');
                                            });
                                        }
                                    }
                                });
                                return false;
                            });

                        });
                        
            }
            */
            $(document).ready(function(){
                        
                        $("#comment-form").submit(function(e){
                                e.preventDefault();
                                var pid = document.getElementById("post-id").value;  
                                $.ajax({
                                    type: "POST",
                                    url: "../engine/insert.php",
                                    data: new FormData(this),
                                    cache: false,
                                    contentType: false,
                                     processData: false,
                                     beforeSend: function() {
                                    //$('#maincontainer').hide();
                                     //$('#mainloader').show();
                                    $("#comment_error").fadeOut();
                                    $("#comment_btn").html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Please wait');                                       
                                    },
                                   complete: function() {
                                  
                                     
                                     // $('#maincontainer').show();
                                      //$('#mainloader').hide();
                                    },   
                                    success: function(response){
                                        if(response === "ok"){
                                            //$(".blog_comment_item").load("../engine/comment-function.php"{})                                
                                            $("#comment_btn").html('<img src="ajax-loader.gif" /> &nbsp; Sent');
                                            $("#comment_input").val("");                                            
                                            $("#reset").load( "../engine/comment-function.php",{post_id : pid }, function(){
                                                swal({
                                                    text: "Posted",
                                                    icon:"success",
                                                    timer: 1000,
                                                    button: false,
                                                });
                                                $("#comment_btn").html('<img src="ajax-loader.gif" /> &nbsp; Submit');
                                            }).fadeIn("slow");
                                            
                                        } else {                                    
                                            $("#comment_error").fadeIn(1000, function(){                        
                                                $("#comment_error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                                                $("#comment_btn").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Submit');
                                            });
                                        }
                                    }
                                });
                                return false;
                            });

                        });
                        
        </script>
        <script type="text/javascript">
        
        function san(a){
                    $("#reply-input"+a).toggle();
                
        }
        
            
        
        
       
    </script>
    <script type="text/javascript">
        function reply(id){
                    if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }

                    else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }
                    var text = document.getElementById("reply-input-"+id).value;
                    var post_id ='<?php echo $post_id; ?>';                                        
                    xmlhttp.open("POST","../engine/insert.php",true);
                    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xmlhttp.send("reply_input="+text + "&post_id="+post_id + "&comment_id="+id);
                   // alert('Friend Request Sent');
                    //$("#reset").load(" #reset");
                    setTimeout(function() {
                        $("#replysection_"+id).load( "../engine/reply-function.php",{comment_id : id, rpost_id : post_id }, function(){
                            swal({
                                text: "Replied",
                                icon:"success",
                                timer: 1000,
                                button: false,
                            });
                            $("#reply-input-"+id).val("");                     
                            $("#reply-btn-"+id).html('Send');
                        });
                    }, 1000); 
                                                
                   // $("#"+id).load(" #"+id);
                   
        }
    </script>
    </body>

<!-- Mirrored from html.verodate.com/verodate/single-blog-right-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2019 05:43:33 GMT -->
</html>