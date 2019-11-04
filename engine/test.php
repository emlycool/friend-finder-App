<?php
	session_start();
	include_once("../engine/database.php");
	$user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $total_comments = "SELECT COUNT(*) FROM blog_post_comments WHERE post_id = $post_id";
                                                    $result = mysqli_query($mycon, $total_comments);
                                                    $total_comments = mysqli_fetch_array($result)[0];
    $likes_sql = "SELECT * FROM blog_post_likes WHERE post_id = $post_id";
    $likes_result = mysqli_query($mycon, $likes_sql);
    $total_likes= mysqli_num_rows($likes_result);
    $likechecker = " SELECT * FROM blog_post_likes WHERE user_id = $user_id AND post_id = $post_id";
    $exechecker= mysqli_query($mycon, $likechecker);
    if (mysqli_num_rows($exechecker) > 0 ) {
        $colorchange = "red";
    }else{
     	$colorchange = "grey";
    }
                                                    
?>
    <a style="color: green;" class="btn text-green" id="id_<?php echo $post_id; ?>" onClick="like(<?php echo $post_id; ?>);"><i style="color: <?php echo $colorchange; ?>;" class="fa fa-heart fa-lg"></i><span >&nbsp <?php echo $total_likes; ?></span></a>
    <a href="#register_form" class="popup-with-zoom-anim pull-right"><i class="fa fa-comment" aria-hidden="true"></i>&nbspView comments (<?php echo $total_comments; ?>)</a>                                                                                                
                                                    

                                            