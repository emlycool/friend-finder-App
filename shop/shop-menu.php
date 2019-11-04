<div class="categori-menu-wrapper2 clearfix">
        <div class="pl-200 pr-200">
            <div class="categori-style-2">
                <div class="category-heading-2">
                    <h3>All Categories</h3>
                    <div class="category-menu-list">
                        <ul>
                            <?php 
                            
                            $sql_ec = "SELECT * FROM ec_category";
                                                        $sql_ec_ini = $mycon2->query($sql_ec);
                                                        while ($cat= mysqli_fetch_array($sql_ec_ini) ) {//loop for m_cat
                                                            $sql_ec2 = "SELECT * FROM ec_sub_category WHERE m_cat = {$cat['id']}";
                                                            $sql_ec_ini2 = $mycon2->query($sql_ec2);
                                                        
                            ?>
                            <li>
                                <a href="shop-list.php?cat=<?php echo $cat['id']; ?>" style="margin-left: 20px;"><?php echo $cat['m_cat']; ?> <?php if (mysqli_num_rows($sql_ec_ini2) > 0) {?><i class="pe-7s-angle-right"></i><?php } ?>
                                </a>
                                <?php
                                    if (mysqli_num_rows($sql_ec_ini2) > 0) { //if statement for s_cat
                                ?>
                                <div class="category-menu-dropdown">
                                    <?php 
                                    while ($cat2 = mysqli_fetch_array($sql_ec_ini2) ){ // loop s_cat
                                    
                                    ?>
                                    <div class="category-dropdown-style category-common4 mb-40">
                                        <h4 class="categories-subtitle"> <?php echo $cat2['s_cat']; ?></h4>
                                        <ul>
                                            <?php 
                                            $sql_ec3 = "SELECT * FROM ec_least_category WHERE m_cat= {$cat['id']} AND s_cat = {$cat2['id']}";
                                            $sql_ec_ini3 = $mycon2->query($sql_ec3);
                                            while ($cat3 = mysqli_fetch_array($sql_ec_ini3)) {
                                            ?>
                                            <li><a href="#"> <?php echo $cat3['l_cat']; ?></a></li>
                                            <?php
                                            } // end loop l_cat
                                            ?>
                                        </ul>
                                    </div>
                                    <?php
                                    } // while loop for s_cat
                                    ?>
                                    <div class="mega-banner-img">
                                        <a href="single-product.html">
                                            <img src="<?php echo $cat['cat_banner']  ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                                <?php
                                    } //if statements for s_cat
                                ?>
                            </li>
                            <?php
                            }//while loop for m_cat
                            ?>
                            <li>
                                <a href="#"><img alt="" src="assets/img/icon-img/23.png">Others Equipment</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-style-4 menu-hover">
                <nav>
                    <ul>
                        <li><a href="#">home
        
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </div>
    </div><!-- end of menu -->