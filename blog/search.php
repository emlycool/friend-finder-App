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
        <?php include_once("blog-menu.php"); ?>
        
        <!--================End Banner Area =================-->
        
        <!--================Blog grid Area =================-->
        <section class="blog_grid_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-9" id="div-search">
                        <div class="row">
                            <div class="blog_grid_inner" id="hidden" style="display: none;">
                                <div class="col-md-12 col-sm-12" id="search-content">
                                    <div>
                                        <h3 style="color: rgb(231,76,60);">Search Result:</h3>

                                    </div>
                                    <?php
                                        $search_input = $_POST['search_input'];
                                        $total_pages_sql = "SELECT COUNT(*) FROM blog_post WHERE title LIKE '%$search_input%' OR category LIKE '%$search_input%' ORDER BY id DESC";
                                        $result = mysqli_query($mycon, $total_pages_sql);
                                        $total_rows = mysqli_fetch_array($result)[0];
                                        echo "<hr>
                                    <h4 style='color: rgb(231,76,60);''>Found&nbsp $total_rows result(s)</h4>";
                                        
                                        
                                        if (isset($_POST['search_input'])) {
                                        $load_count = 3;
                                        $retrive_blog_post = "SELECT * FROM blog_post WHERE title LIKE '%$search_input%' OR category LIKE '%$search_input%' ORDER BY id DESC LIMIT $load_count"; 
                                        $retrieve_ini = mysqli_query($mycon, $retrive_blog_post);
                                        while ($postresult = mysqli_fetch_array($retrieve_ini)) {
                                        $poster= $postresult['poster_id'];
                                        $new_date= date('d M, Y| h:i:sa', strtotime($postresult['date_added']));
                                        $retrive_post_sender = "SELECT * FROM admin WHERE id = {$poster}";   
                                        $retrieve_exe = mysqli_query($mycon, $retrive_post_sender);
                                        $posterresult = mysqli_fetch_array($retrieve_exe);
                                    ?>
                                    <div  class="blog_grid_item">
                                        <?php
                                        if (!empty($postresult['img_dir'])) {
                                            echo "<img src='".$postresult['img_dir']."' alt=''>";
                                        }
                                        ?>
                                        <div class="blog_grid_content">
                                            <a href="post_page.php?postid=<?php echo $postresult['id']; ?> "><h3><?php echo $postresult['title']; ?></h3></a>
                                            <div class="blog_grid_date">
                                                <a>By <?php echo $posterresult['fullname']; ?></a>
                                                <a><?php echo $new_date; ?></a>
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
                                            
                                            
                                        </div> 
                                    </div>
                                    <?php
                                    }
                                }   
                                    if ($total_rows < $load_count) {
                                        
                                    }else{
                                    ?>
                                    <div class="col-md-4 col-md-offset-5">
                                        <button class="btn btn-danger " id="load-btn" onClick="load(<?php echo $load_count; ?>);">Load more</button>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>                       
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-md-offset-5">
                            <input type="text" id="input" value="<?php echo $search_input;  ?>" hidden>
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
                                    <img src="../img/widget-title-border.png" alt="">
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
        <script>
        
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
            */
            
                function load(count){
                    var search = document.getElementById("input").value;
                    var Newcount = count + 2;
                    $("#search-content").load("../engine/load-more.php",{load_count : Newcount, search_input : search}, function(){
                        
                    }).slideDown("slow");
                }
            
    </script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            $('#hidden').slideDown(1000);
            
        });
        
        
       
    </script>

    </body>

<!-- Mirrored from html.verodate.com/verodate/blog-right-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2019 05:43:33 GMT -->
</html>