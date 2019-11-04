<div class="profile-card">
            <?php
            include_once('../processes/my-functions.php');
                                        $queryiu = "SELECT * FROM users WHERE id = {$_SESSION['user_id']}";
                                         $userexe2 = mysqli_query($mycon, $queryiu);
                                         $useri = mysqli_fetch_array($userexe2);
                                        $total_friends_sql = "SELECT COUNT(*) FROM userfriends WHERE user_id = {$_SESSION['user_id']} OR friend_id = {$_SESSION['user_id']}";
                                        $result_f = mysqli_query($mycon, $total_friends_sql);
                                        $total_friends = mysqli_fetch_array($result_f)[0];
                                        

            ?>
              <img src="../<?php echo $useri['profile_pic']; ?>" alt="user" class="profile-photo" />
              <h5><a href="timeline.php" class="text-white"><?php echo $useri['firstname']." ".$useri['lastname']; ?></a></h5>
              <a href="timeline-friends.php" class="text-white"><i class="ion ion-android-person-add"></i> <?php echo restyle_text($total_friends); ?></a>
            </div><!--profile card ends-->
            <ul class="nav-news-feed">
              <li><i class="icon ion-ios-paper"></i><div><a href="newsfeed.php">My Newsfeed</a></div></li>
              <li><i class="icon ion-ios-people"></i><div><a href="newsfeed-people-nearby.php">People Nearby</a></div></li>
              <li><i style="color: indigo;" class="fa fa-user-plus"></i><div><a href="friend_request.php">Friend Request</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="newsfeed-friends.php">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="newsfeed-chat-list.php">Messages</a></div></li>
              <li><i class="icon ion-images"></i><div><a href="newsfeed-images.php">Images</a></div></li>
              <li><i class="icon ion-ios-videocam"></i><div><a href="newsfeed-videos.php">Videos</a></div></li>
            </ul><!--news-feed links ends-->
            <div id="chat-block">
              <div class="title">Online Friends</div>
              <ul class="online-users list-inline">
                <?php 
                $query_active = "SELECT * FROM userfriends WHERE user_id = {$_SESSION['user_id']} OR friend_id = {$_SESSION['user_id']}";
                $active_exe = mysqli_query($mycon, $query_active);
                if (mysqli_num_rows($active_exe) > 0) {
                    while ($active_u = mysqli_fetch_array($active_exe)) {
                      if ($_SESSION['user_id'] == $active_u['user_id']) {
                      $usertocheck = $active_u['friend_id'];
                      }
                      else{
                        $usertocheck = $active_u['user_id'];
                      }
                      
                      $query_active2 = "SELECT * FROM user_time WHERE user_id = $usertocheck";
                      $active_exe2 = mysqli_query($mycon, $query_active2);
                      $active_u2 = mysqli_fetch_array($active_exe2);
                      $db_time = $active_u2['last_active'];
                      $current_time = time();
                      $diff = $current_time - $db_time;
                      if ($diff < 3000) {
                          $queryuser = "SELECT * FROM users WHERE id = $usertocheck";
                           $userexe = mysqli_query($mycon, $queryuser);
                           $userinfo = mysqli_fetch_array($userexe);
                        
                ?>
                <li><a href="newsfeed-messager.php?id=<?php echo $usertocheck; ?>" title="<?php echo $userinfo['firstname']." ".$userinfo['lastname']; ?>"><img src="../images/users/user-2.jpg" alt="user" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>
                <?php
                      }
                    }
                }
                ?>
              </ul>
            </div><!--chat block ends-->