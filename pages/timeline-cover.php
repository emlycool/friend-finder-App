<div class="timeline-cover" style=" background: url('../images/covers/1.jpg') no-repeat;">
          <?php 
          $timeline_pages = array('timeline.php', 'timeline-about.php', 'timeline-album.php', 'timeline-friends.php');
          $url = $_SERVER['REQUEST_URI'];
          $url_str = explode("/", $url);
          if (isset($_GET['O_user'])) {
            $O_user = $_GET['O_user'];
            $usertoquery = $O_user;
          }else{ $usertoquery = $_SESSION['user_id'];
          }
          $queryuser = "SELECT * FROM users WHERE id = $usertoquery";
          $userexe = mysqli_query($mycon, $queryuser);
          $userinfo = mysqli_fetch_array($userexe);
          include_once('../processes/my-functions.php');
                                        $total_friends_sql = "SELECT COUNT(*) FROM userfriends WHERE user_id = {$_SESSION['user_id']} OR friend_id = {$_SESSION['user_id']}";
                                        $result_f = mysqli_query($mycon, $total_friends_sql);
                                        $total_friends = mysqli_fetch_array($result_f)[0];
          ?>
          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                  <img src="../<?php echo $userinfo['profile_pic']; ?>" alt="" class="img-responsive profile-photo" />
                  <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                  <h3><?php echo $userinfo['firstname']. " ". $userinfo['lastname']; ?></h3>
                  <p class="text-muted"></p>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="timeline.php" class='<?php if ($url_str[3] == $timeline_pages[0]) {
                    ?> active <?php } ?>'>Timeline</a></li>
                  <li><a href="timeline-about.php" class='<?php if ($url_str[3] == $timeline_pages[1]) {
                    ?> active <?php } ?>' >About</a></li>
                  <li><a href="timeline-album.php" class='<?php if ($url_str[3] == $timeline_pages[2]) {
                    ?> active <?php } ?>'>Album</a></li>
                  <li><a href="timeline-friends.php" class='<?php if ($url_str[3] == $timeline_pages[3]) {
                    ?> active <?php } ?>'>Friends</a></li>

                </ul>
                <ul class="follow-me list-inline">
                  <li><?php echo restyle_text($total_friends); ?>&nbspfriend(s).</li>
                  
                  <li><a href="edit-profile-basic.php"><i class="fa fa-edit"></i></a></li>
                  <li><a href="edit-profile-settings.php"><i class="fa fa-cogs"></i></a></li>
                </ul>
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              <img src="../<?php echo $userinfo['profile_pic']; ?>" alt="" class="img-responsive profile-photo" />
              <h4><?php echo $userinfo['firstname']. " ". $userinfo['lastname'] ?></h4>
              <p class="text-muted"><?php echo restyle_text($total_friends); ?>&nbspfriend(s).</p>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                <li><a href="timeline.php" class='<?php if ($url_str[3] == $timeline_pages[0]) {
                    ?> active <?php } ?>'>Timeline</a></li>
                  <li><a href="timeline-about.php" class='<?php if ($url_str[3] == $timeline_pages[1]) {
                    ?> active <?php } ?>' >About</a></li>
                  <li><a href="timeline-album.php" class='<?php if ($url_str[3] == $timeline_pages[2]) {
                    ?> active <?php } ?>'>Album</a></li>
                  <li><a href="timeline-friends.php" class='<?php if ($url_str[3] == $timeline_pages[3]) {
                    ?> active <?php } ?>'>Friends</a></li>
              </ul>
              
            </div>
          </div><!--Timeline Menu for Small Screens End-->

        </div>