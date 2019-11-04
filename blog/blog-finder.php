<?php 
session_start();
include_once("../engine/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once("blog-header.php");
?>
    <body>           
        <?php include_once("blog-menu.php"); ?>
        
        <!--================End Banner Area =================-->
        
        <!--================Blog grid Area =================-->
        <section class="blog_grid_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-9" id="div-search">
                        <div class="row">
                            <div class="blog_grid_inner">
                                <div class="col-md-12 col-sm-6">
                                    <?php
                                        
                                        if (isset($_GET['pageno'])) {
                                            $pageno = $_GET['pageno'];
                                        } else {
                                            $pageno = 1;
                                        }
                                        $no_of_records_per_page = 5;
                                        $offset = ($pageno-1) * $no_of_records_per_page;

                                        $total_pages_sql = "SELECT COUNT(*) FROM blog_post";
                                        $result = mysqli_query($mycon, $total_pages_sql);
                                        $total_rows = mysqli_fetch_array($result)[0];
                                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                                        $retrive_blog_post = "SELECT * FROM blog_post ORDER BY id DESC LIMIT $offset, $no_of_records_per_page"; 
                                        $retrieve_ini = mysqli_query($mycon, $retrive_blog_post);
                                        while ($postresult = mysqli_fetch_array($retrieve_ini)) {
                                        $poster= $postresult['poster_id'];
                                        $new_date= date('d M, Y | h:ia', strtotime($postresult['date_added']));
                                        $retrive_post_sender = "SELECT * FROM admin WHERE id = {$poster}";   
                                        $retrieve_exe = mysqli_query($mycon, $retrive_post_sender);
                                        $posterresult = mysqli_fetch_array($retrieve_exe);
                                        $date_t = str_replace("|", "at", $new_date );
                                    ?>
                                    <div class="blog_grid_item">
                                        <?php
                                        if (!empty($postresult['img_dir'])) {
                                            echo "<img src='".$postresult['img_dir']."' alt='' class='img-responsive'>";
                                        }
                                        ?>
                                        <div class="blog_grid_content">
                                            <a href="post_page.php?postid=<?php echo $postresult['id']; ?>"><h3><?php echo $postresult['title']; ?></h3></a>
                                            <div class="blog_grid_date">
                                                <a>By <?php echo $posterresult['fullname']; ?></a>
                                                <a><?php echo $date_t; ?></a>
                                                <a href="blog-category.php?cat=<?php echo $postresult['category']; ?>"><?php echo ucfirst($postresult['category']);  ?></a>
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
                                            <div class="reaction">
                                                <div id ="refresh_<?php echo $postresult['id'];?>">
                                                    <?php
                                                    
                                                    
                                                    $post_id = $postresult['id'];
                                                    $total_comments = "SELECT COUNT(*) FROM blog_post_comments WHERE post_id = $post_id";
                                                    $result = mysqli_query($mycon, $total_comments);
                                                    $total_comments = mysqli_fetch_array($result)[0];
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
                                                          $colorchange = "grey";
                                                        }
                                                    }
                                                    if (!isset($_SESSION['user_id'])) {
                                                       
                                                    
                                                    ?>
                                                    <a href="#!" data-toggle="modal" data-target="#loginModal"><i style="color: <?php if (isset($_SESSION['user_id'])) { echo $colorchange; }else{ echo "grey"; }  ?>;" class="fa fa-heart fa-lg"></i><span >&nbsp <?php echo $total_likes; ?></span></a>
                                                    <a href="post_page.php?postid=<?php echo $postresult['id'];?>" class="popup-with-zoom-anim pull-right"><i class="fa fa-comment" aria-hidden="true"></i>&nbspView comments (<?php echo $total_comments; ?>)</a>
                                                    <?php
                                                    }
                                                    else{
                                                    
                                                    ?>
                                                    <a style="color: green;" class="btn text-green" id="id_<?php echo $postresult['id']; ?>" onClick="like(<?php echo $postresult['id']; ?>);"><i style="color: <?php echo $colorchange; ?>;" class="fa fa-heart fa-lg"></i><span >&nbsp <?php echo $total_likes; ?></span></a>
                                                    <a href="post_page.php?postid=<?php echo $postresult['id'];?>" class="popup-with-zoom-anim pull-right"><i class="fa fa-comment" aria-hidden="true"></i>&nbspView comments (<?php echo $total_comments; ?>)</a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            
                                        </div> 
                                    </div>
                                    <?php
                                    }
                                    ?>
                                   
                                </div>                       
                            </div>
                        </div>
                        <div class="pagination_area">
                            <a class="prev <?php if($pageno <= 1){ echo 'disabled'; } ?>" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" >Previous</a>
                            <a class="arrow_left <?php if($pageno <= 1){ echo 'disabled'; } ?>" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><i class="fa fa-angle-left"></i></a>
                            <a class="arrow_right <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>" href="#"><i class="fa fa-angle-right"></i></a>
                            <a class="next <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>" href="blog-finder.php<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="right_sidebar_area">
                            <aside class="s_widget search_widget">
                                <!--<div class="input-group">
                                    <input name="search_input" type="text" class="form-control" placeholder="Search Here">
                                    <span class="input-group-btn">
                                        <button id="search-btn" class="btn btn-default" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </span>
                                </div>-->
                                <form action="search.php" method="POST">
                                    <div class="input-group">
                                        <input name="search_input" type="text" class="form-control" placeholder="Search Here">
                                        <span class="input-group-btn">
                                            <button type="submit" name="search-btn" class="btn btn-default" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </aside>
                            <aside class="s_widget tags_widget">
                                <div class="s_title">
                                    <h4>Categories</h4>
                                    
                                </div>
                                <ul>
                                    <?php
                                    $cat_sql = "SELECT DISTINCT category FROM blog_category ";
                                    $run_cat = mysqli_query($mycon, $cat_sql);
                                    while ($cat_result = mysqli_fetch_array($run_cat)) {
                                    ?>
                                    <li><a href="blog-category.php?cat=<?php echo $cat_result['category']; ?>"><?php echo ucfirst($cat_result['category'] ); ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </aside>
                            <aside class="s_widget recent_post_widget">
                                <div class="s_title">
                                    <h4>Recent Post</h4>
                                    
                                </div>
                                <?php
                                $retrive_recent_blog_post = "SELECT * FROM blog_post ORDER BY id DESC LIMIT 3"; 
                                        $recent_ini = mysqli_query($mycon, $retrive_recent_blog_post);
                                        while ($recent_post = mysqli_fetch_array($recent_ini)) {
                                        $date= date('d M, Y | h:ia', strtotime($recent_post['date_added']));
                                        $date_time = str_replace("|", "at", $date );

                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <?php
                                        if (!empty($recent_post['img_dir'])) {
                                            echo "<img src='".$recent_post['img_dir']."' height='70' width='70' alt=''>";
                                        }
                                        ?>
                                    </div>
                                    <div class="media-body">
                                        <a href="post_page.php?postid=<?php echo $recent_post['id']; ?>"><h4><?php echo $recent_post['title'];  ?></h4></a>
                                        <span><?php echo $date_time; ?></span>
                                    </div>
                                </div>
                                <?php
                                        }
                                ?>
                            </aside>
                            
                            <aside class="s_widget social_widget">
                               
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            
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
        <!-- MY scripts -->
        
    <script>
        
            function like(id){
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
        
    </script>
    <script type="text/javascript">
        /*
        $('document').ready(function(){
            var search = document.getElementById("#").innerHTML;
            $("search-btn").click(function(){
                $('#div-search').load("../engine/search.php", {search_input: search}, function(){
                alert("hi there");
            });
                });
        });
        */
    </script>

    </body>

<!-- Mirrored from html.verodate.com/verodate/blog-right-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2019 05:43:33 GMT -->
</html>