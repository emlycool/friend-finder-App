<header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php"><img src="../images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown"><a href="../index.php">Home</a></li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Newsfeed <span><img src="../images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu newsfeed-home">
                    <li><a href="newsfeed.php">Newsfeed</a></li>
                    <li><a href="newsfeed-people-nearby.php">Poeple Nearly</a></li>
                    <li><a href="newsfeed-friends.php">My friends</a></li>
                    <li><a href="newsfeed-messages.php">Chatroom</a></li>
                    <li><a href="newsfeed-images.php">Images</a></li>
                    <li><a href="newsfeed-videos.php">Videos</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timeline <span><img src="../images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu login">
                  <li><a href="timeline.php">Timeline</a></li>
                  <li><a href="timeline-about.php">Timeline About</a></li>
                  <li><a href="timeline-album.php">Timeline Album</a></li>
                  <li><a href="timeline-friends.php">Timeline Friends</a></li>
                  <li><a href="edit-profile-basic.php">Edit: Basic Info</a></li>
                  <li><a href="edit-profile-work-edu.php">Edit: Work</a></li>
                  <li><a href="edit-profile-interests.php">Edit: Interests</a></li>
                  <li><a href="edit-profile-settings.php">Account Settings</a></li>
                  <li><a href="edit-profile-password.php">Change Password</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="../blog/blog-finder.php">Blog</a></li>
              <li class="dropdown"><a href="../shop/shop-finder.php">Shop</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                 <ul class="dropdown-menu login">
                  <li><a href="edit-profile-settings.php"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp&nbsp Settings</a></li>
                  <li><a href="faq.php"><i class="fa fa-question" aria-hidden="true"></i>&nbsp&nbsp FAQ</a></li>
                  <li><a href="contact.php"><i class="fa fa-contact" aria-hidden="true"></i>&nbsp&nbsp Contact</a></li>
                  <li><a href="../engine/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp&nbsp Logout</a></li>
                  
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-right hidden-sm" id="search" method="POST" action="newsfeed-people-nearby.php" >
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="search" name="find" id="find" class="form-control" placeholder="Search friends, photos, videos">
                <button  style="display: none;" type="submit" id="myBtn">Button</button>
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>