<?php
session_start();
include_once("../engine/database.php");
include_once('../processes/my-functions.php');
if (isset($_POST['newsfeed'])) {
            $querypost = "SELECT * FROM social_posts ORDER BY id DESC";
            $postini = mysqli_query($mycon, $querypost);
            while ($postresult = mysqli_fetch_array($postini)) {
             $query_f = "SELECT * FROM userfriends WHERE user_id = {$_SESSION['user_id']} AND friend_id = {$postresult['poster_id']} OR friend_id = {$_SESSION['user_id']} AND user_id = {$postresult['poster_id']}";
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
             if ($_SESSION['user_id'] == $postresult['poster_id']) {
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
                        <p><a href="p-timeline.php?o_user=<?php echo $retrieve_comment['commenter_id']; ?>" class="profile-link"><?php echo $user_details['firstname']. " ".$user_details['lastname']; ?> </a><i class="em em-lips"></i><?php echo $retrieve_comment['comment']; ?></p>
                      </div>
                  <?php

                          }
                        
                      }elseif ($retrieve_comment['commenter_id'] == $_SESSION['user_id']) {
                  ?>
                    <div class="post-comment">
                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                      <p><a href="p-timeline.php?o_user=<?php echo $retrieve_comment['commenter_id']; ?>" class="profile-link"><?php echo $user_details['firstname']. " ".$user_details['lastname']; ?> </a><i class="em em-lips"></i><?php echo $retrieve_comment['comment']; ?></p>
                    </div>
                  <?php
                      }else{
                  ?>
                    <div class="post-comment">
                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                      <p><a href="p-timeline.php?o_user=<?php echo $postresult['poster_id']; ?>" class="profile-link"><?php echo $user_details['firstname']. " ".$user_details['lastname']; ?> </a><i class="em em-lips"></i><?php echo $retrieve_comment['comment']; ?></p>
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

}
if (isset($_POST['comment_feed'])) {
$post_id = $_POST['cpid'];
    $load_count = 4;
                                $comment_checker2 = " SELECT * FROM social_post_comments WHERE post_id = $post_id  ORDER BY id LIMIT $load_count";
                                $comment_exe2 = mysqli_query($mycon, $comment_checker2);
                                $total_comments_sql = "SELECT COUNT(*) FROM social_post_comments WHERE post_id = $post_id";
                                $result_c = mysqli_query($mycon, $total_comments_sql);
                                $total_comments = mysqli_fetch_array($result_c)[0];
                                while($retrieve_comment2 = mysqli_fetch_array($comment_exe2) ){
                                  $date_commented2 = date('d M, Y | h:ia', strtotime($retrieve_comment2['date_added']));
                                  $new_date_commented2 = str_replace("|", "at", $date_commented2);
                                  $query_user2 = "SELECT firstname, lastname, profile_pic FROM users WHERE id = {$retrieve_comment2['commenter_id']}";
                                  $user_exe2 = mysqli_query($mycon, $query_user2);
                                  $user_details2 = mysqli_fetch_array($user_exe2);
                                ?>
                                    <div class="post-comment">
                                      <img src="../images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                                      <p><a href="p-timeline.php?o_user=<?php echo $retrieve_comment2['commenter_id']; ?>" class="profile-link"><?php echo $user_details2['firstname']. " ".$user_details2['lastname']; ?> </a><i class="em em-laughing"></i> <?php echo $retrieve_comment2['comment']; ?></p>
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
<?php
                              }
}if (isset($_POST['img_feed'])) {
?>
<div class="row js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": ".grid-sizer", "percentPosition": true }'>
                <?php
                $querypost = "SELECT * FROM social_posts ORDER BY id DESC";
                $postini = mysqli_query($mycon, $querypost);
                while ($postresult = mysqli_fetch_array($postini)) { //start of while loop1
                  $poster= $postresult['poster_id'];
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
                 $post_id = $postresult['id'];
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

                 $queryuser = "SELECT * FROM users WHERE id = $poster";
                 $userexe = mysqli_query($mycon, $queryuser);
                 $userinfo = mysqli_fetch_array($userexe);
                 $loc = $postresult['image_dir'];
                 if ($user== $postresult['poster_id']) {
                   $a = "you";
                 }
                 else{
                  $a="Friend";
                 }
                  if(!empty($postresult['image_dir'])){ 
                   $all = explode("||" , $loc);
                   $ext = strtolower(substr($all[0], strpos($all[0],'.'), strlen($all[0])-1));
                if ($ext != '.mp4' AND $ext !='.mkv') {
                    if (!empty($all)) {
                      
                    
                 
                ?>
                <div class="grid-item col-md-6 col-sm-6">
                  <div class="media-grid">
                    <div class="img-wrapper" onClick="Mimgbtn(<?php echo $postresult['id']; ?>);">
                      <img src="../<?php echo $all[0]; ?>" alt="" class="img-responsive post-image" />
                    </div>
                    <div class="media-info">
                      <div class="reaction" id="viewrs_<?php  echo $postresult['id']; ?>">
                        <a class="btn <?php echo $colorchange; ?>" onClick="like(<?php echo $postresult['id']; ?>);"><i class="icon ion-thumbsup"></i> <?php echo $total_likes; ?></a>
                        <a class="btn <?php echo $colorchange2; ?>" onClick="dislike(<?php echo $postresult['id']; ?>);"><i class="fa fa-thumbs-down"></i> <?php echo $total_dislikes; ?></a>
                        <a onClick="Mimgbtn(<?php echo $postresult['id']; ?>);" type="button"><i class="fa fa-comment" aria-hidden="true"></i></a>
                      </div>
                      <div class="user-info">
                        <img src="../images/users/user-8.jpg" alt="" class="profile-photo-sm pull-left" />
                        <div class="user">
                          <h6><a href="p-timeline.php?o_user=<?php echo $postresult['poster_id']; ?>" class="profile-link"><?php echo $userinfo['firstname']." ".$userinfo['lastname']; ?></a></h6>
                          <a class="text-green" href="#"><?php echo $a; ?></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                    }
                  }
                }
                }
                }//end of while loop 1
                ?>
              </div>
<?php
}
if (isset($_POST['grid_view'])) {

?>
    <div id="grid-sidebar9" class="tab-pane fade">
                                        <div class="row">
                                            <?php 
                                            $product_request = "SELECT * FROM products WHERE m_cat = {$_POST['grid_view']}";
                                            $product_exe = $mycon2->query($product_request);
                                            while ($retrieve_product = mysqli_fetch_array($product_exe)) {  if (isset($_SESSION['user_id'])) {
                                                        $wishlist_sql = "SELECT * FROM wishlist WHERE user_id={$_SESSION['user_id']} AND product_id = {$retrieve_product['id']} ";
                                                        $wishlist_exe = $mycon2->query($wishlist_sql);
                                                    }
                                            ?>

                                            <div class="col-lg-3 col-md-4">
                                                <div class="product-wrapper product-box-style mb-30">
                                                    <div class="product-img">
                                                        <a href="product-details.php?product=<?php echo $retrieve_product['id']; ?>">
                                                            <img src="<?php echo $retrieve_product['product_frontDir']; ?>" alt="">
                                                        </a>
                                                        <span>hot</span>
                                                        
                                                        <div class="product-action">
                                                            <a class="animate-left" title="Wishlist" <?php if (!isset($_SESSION['user_id'])){ ?>onClick="goto();" <?php } else{?> onClick="wishlist(<?php echo $retrieve_product['id']; ?>);" <?php } ?>>
                                                                <i class="pe-7s-like" <?php if (mysqli_num_rows($wishlist_exe) > 0){ ?>
                                                                    style="color:red;"
                                                                <?php } ?> id="wish<?php echo $retrieve_product['id']; ?>"></i>
                                                            </a>
                                                            <a class="animate-top" title="Add To Cart" href="#" onClick="add_cart(<?php echo $retrieve_product['id'].",1"; ?>);">
                                                                <i class="pe-7s-cart"></i>
                                                            </a>
                                                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="product-details.php?product=<?php echo $retrieve_product['id']; ?>">
                                                                <i class="pe-7s-look"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h4><a href="product-details.php?product=<?php echo $retrieve_product['id']; ?>"><?php echo reduced_text($retrieve_product['name'], 30); ?></a></h4>
                                                        <span class="">&#8358; <?php echo number_format($retrieve_product['new_price']); ?></span>
                                                        <?php
                                                        if($retrieve_product['new_price'] != $retrieve_product['price']){
                                                        ?>
                                                        <span class="" style="font-size: 0.875em; font-weight:normal;">
                                                            <s>&#8358; <?php echo number_format($retrieve_product['price']); ?></s>
                                                        </span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
<?php
}
if (isset($_POST['list_view'])) {
?>
<div id="grid-sidebar10" class="tab-pane fade active show">
                                        <div class="row">
                                            <div id="error"></div>
                                            <?php 
                                            $product_request = "SELECT * FROM products WHERE m_cat = {$_POST['list_view']}";
                                            $product_exe = $mycon2->query($product_request);
                                            while ($retrieve_product = mysqli_fetch_array($product_exe)) { if (isset($_SESSION['user_id'])) {
                                                    $wishlist_sql = "SELECT * FROM wishlist WHERE user_id={$_SESSION['user_id']} AND product_id = {$retrieve_product['id']} ";
                                                    $wishlist_exe = $mycon2->query($wishlist_sql);
                                                    }
                                            ?>
                                            <div class="col-lg-12">
                                                <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                                    <div class="product-img list-img-width">
                                                        <a>
                                                            <img src="<?php echo $retrieve_product['product_frontDir']; ?>" alt="">
                                                        </a>
                                                        <span>hot</span>
                                                        <div class="product-action-list-style">
                                                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="product-details.php?product=<?php echo $retrieve_product['id']; ?>">
                                                                <i class="pe-7s-look"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-list">
                                                        <div class="product-list-info">
                                                            <h4><a href="product-details.php?product=<?php echo $retrieve_product['id']; ?>"><?php echo reduced_text($retrieve_product['name'], 55); ?></a></h4>
                                                            <span class="">&#8358; <?php echo number_format($retrieve_product['new_price']); ?></span>
                                                            <?php
                                                            if($retrieve_product['new_price'] != $retrieve_product['price']){
                                                            ?>
                                                            <span class="" style="font-size: 0.875em; font-weight:normal;">
                                                                <s>&#8358; <?php echo number_format($retrieve_product['price']); ?></s>
                                                            </span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <p><?php echo reduced_text($retrieve_product['description'], 70); ?></p>
                                                        </div>
                                                        <div class="product-list-cart-wishlist">
                                                            <div class="product-list-cart">
                                                                <a class="btn-hover list-btn-style" href="#" onClick="add_cart(<?php echo $retrieve_product['id'].",1"; ?>);">add to cart</a>
                                                            </div>
                                                            <div class="product-list-wishlist">
                                                                <?php if (!isset($_SESSION['user_id'])){ ?>
                                                                <a class="btn-hover list-btn-wishlist" onClick="goto();">
                                                                    <i class="pe-7s-like" id="wish<?php echo $retrieve_product['id']; ?>"></i>
                                                                </a>    
                                                                <?php } else{?>
                                                                <a class="btn-hover list-btn-wishlist" onClick="wishlist(<?php echo $retrieve_product['id']; ?>);">
                                                                    <i <?php if (mysqli_num_rows($wishlist_exe) > 0){ ?>
                                                                    style="color:red;"
                                                                <?php } ?> class="pe-7s-like" id="wish<?php echo $retrieve_product['id']; ?>"></i>
                                                                </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
<?php
}
?>