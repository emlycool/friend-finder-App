<?php 
session_start();
include_once("database.php");
include_once("../processes/functions.php");
require_once('ImageManipulator.php');
include_once('../processes/my-functions.php');
if (isset($_POST['create_admin'])) {
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  
	
		$admin_email = protect_value($_POST['admin_email']);
		$fullname = protect_value(ucfirst($_POST['admin_fullname']));
		$password = $_POST['admin_password'];
		$encrpt_password = password_hash("$password", PASSWORD_DEFAULT);
		$query_usercheck ="SELECT * FROM admin WHERE email = '$admin_email' LIMIT 1";
	  		$qini = $mycon->query($query_usercheck);
			if (mysqli_num_rows($qini) > 0) {
				header("location:../admin/sign-up.php?err_msg=email already exist | Try another");
					exit;
			}else{
				$admin_sql = "INSERT INTO admin()
					 VALUES(NULL, '$fullname', '$admin_email', '$encrpt_password', NOW() )";
					 $qadmin = $mycon->query($admin_sql);
					if($qadmin){
					 	
					 header("location:../admin/login.php?message=Admin added");
					exit;
					}
					else{
						die(mysqli_error($mycon));
					}
			}
	}else {
		  header("location:../admin/sign-up.php?err_msg=Invalid email address");
	}
}

if (isset($_POST['add_blog_post']) ) {
	$blog_title = protect_value($_POST['blog_title']);
	$blog_content = protect_value($_POST['blog_content']);
	$poster_id = $_SESSION['admin_id'];
	$blog_category = $_POST['category'];
	// resizing picture
	if (empty($_FILES['blog_img']['name'])) {
		$query_insert = "INSERT INTO blog_post() VALUES(NULL,'$blog_title', '$blog_content' , '', '$poster_id', NOW() )";
		$qini = mysqli_query($mycon,$query_insert);
		if ($qini) {
			header("location:../admin/blog.php?message=Added Successful");
				exit;

		}else{
			die(mysqli_error($mycon));		
		} 
	}else{
		$newNamePrefix = time() . '_';
		$uploadDir = '../images/blog_img/'; 
		$filename = $newNamePrefix . $_FILES['blog_img']['name']; // Get the name of the file (including file extension).
		$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
		$fileName = $newNamePrefix . $_FILES['blog_img']['name'];
		$filePath = $uploadDir . $fileName;
		//check for extension.
		if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
         
			$imageInformation = getimagesize($_FILES['blog_img']['tmp_name']);


			$imageWidth = $imageInformation[0]; //Contains the Width of the Image

			$imageHeight = $imageInformation[1]; //Contains the Height of the Image


			if($imageWidth < 350 or $imageHeight < 440)
			{
			   
			 
			}else{
			    
					$manipulator = new ImageManipulator($_FILES['blog_img']['tmp_name']);
			        // resizing to 200x200
			        $newproduct = $manipulator->resample(350, 440,false);
					//if file was moved succesfully
					$manipulator->save('../images/blog_img/' . $newNamePrefix . $_FILES['blog_img']['name']);
			}

		
			$query_insert = "INSERT INTO blog_post() VALUES(NULL,'$blog_title', '$blog_content' , '$filePath', '$poster_id', '$blog_category', NOW() )";
			$qini = mysqli_query($mycon,$query_insert);
			if ($qini) {
				header("location:../admin/blog.php?message=Added Successful");
					exit;

			}else{
				die(mysqli_error($mycon));		
			} 
		}
	}
}
	

if(isset($_POST['add_friend_id'])) {
	

		$friend_id = $_POST['add_friend_id'];
		$currentuser = $_SESSION['user_id'];

		$query_usercheck =" SELECT * FROM addfriend_list WHERE request_user = $currentuser AND  friend_id = $friend_id";
		$qini=mysqli_query($mycon, $query_usercheck);
		if (mysqli_num_rows($qini) > 0) {

			$query_delete =" DELETE FROM addfriend_list WHERE request_user = $currentuser AND  friend_id = $friend_id";
			$qinidel=mysqli_query($mycon, $query_delete);
			//echo "request_canceled";
	
		}else{

		$query_insert=" INSERT INTO addfriend_list() VALUES(NULL,$currentuser,$friend_id, NOW() )";
				$result_insert= mysqli_query($mycon, $query_insert);
				if ($result_insert) {
					//echo "request_sent";
				}else{
					//echo "error_occured";
				}

	   }	


}
if(isset($_POST['confirm_friend_id'])) {
	

		$friend_id = $_POST['confirm_friend_id'];
		$user_id = $_SESSION['user_id'];

				
		$query_insert=" INSERT INTO userfriends() VALUES(NULL,$user_id,$friend_id, NOW() )";
		$result_insert= mysqli_query($mycon, $query_insert);

		$query_del =" DELETE FROM addfriend_list WHERE request_user = $friend_id AND  friend_id = $user_id";
		$qinidel=mysqli_query($mycon, $query_del);
		if ($qinidel AND $result_insert) {
			$query = "SELECT * FROM addfriend_list WHERE friend_id = $user_id";
              $qexe = mysqli_query($mycon, $query);
            	if (mysqli_num_rows($qexe) < 1) {
                echo "<div class'container'><h4>No friend requests</h4></div>";
             	}
              while ($fetch = mysqli_fetch_array($qexe) ) {
	              $request_user = $fetch['request_user'];
	              $user_info = "SELECT * FROM users WHERE id = $request_user";
	              $qexe_info = mysqli_query($mycon, $user_info); 
	              $user_array = mysqli_fetch_array($qexe_info);
				
				?>
		              <div  class="nearby-user">
		                <div class="row">
		                  <div class="col-md-2 col-sm-2">
		                    <img src="images/users/user-15.jpg" alt="user" class="profile-photo-lg" />
		                  </div>
		                  <div class="col-md-5 col-sm-5">
		                    <h5><a href="#" class="profile-link"><?php echo $user_array['lastname']." ".$user_array['firstname']; ?> </a></h5>
		                    <p><?php echo $user_array['city']; ?></p>
		                    <p class="text-muted">BIO</p>
		                  </div>
		                  <div class="col-md-5 col-sm-5">
		                       
		                    <button  id="<?php echo $user_array['id']; ?>" onClick="confirm_friend(<?php echo $user_array['id']; ?>);" type="submit" class="btn btn-primary pull-right">Confirm</button>
		                  <button style="margin-right: 3px;"id="<?php echo $user_array['id']; ?>" onClick="delete_friend(<?php echo $user_array['id']; ?>);" type="submit" class="btn btn-danger pull-right">Delete</button>
		                  </div>
		                </div>
		              </div>
              <?php
              	}
        }

			


}//end of isset
if(isset($_POST['delete_friend_id'])) {
	

		$friend_id = $_POST['delete_friend_id'];
		$currentuser = $_SESSION['user_id'];

		

			$query_delete =" DELETE FROM addfriend_list WHERE request_user = $friend_id AND  friend_id = $currentuser";
			$qinidelete=mysqli_query($mycon, $query_delete);
			
	
}
if (isset($_POST['message'])) {
		$message = protect_value($_POST['message']);
		$receiver_id = protect_value($_POST['receiver_id']);
		$sender_id = $_SESSION['user_id'];
		$querymsg ="INSERT INTO chat() VALUES(NULL, $sender_id, $receiver_id, '$message', NOW())";
		$result_msg = mysqli_query($mycon,$querymsg);

	}	
if (isset($_POST['modal_texts'])) {
	$text = protect_value($_POST['modal_texts']);
	$poster_id = $_SESSION['user_id'];
	$time = time();
	$query_post = "INSERT INTO social_posts() VALUES(NULL,  $poster_id, '', '$text', $time)";
	$postexe = mysqli_query($mycon, $query_post);
	if ($postexe) {
		echo "ok";
	}else{
		echo"Some thing happened";
	}
}
if (isset($_POST['add_blog_category']) ) {
	$blog_category = protect_value($_POST['blog_category']);
			$sql_insert = "INSERT INTO blog_category() VALUES(NULL,'$blog_category')";
			$qini = mysqli_query($mycon,$sql_insert);
			if ($qini) {
				header("location:../admin/blog.php?message=Added Successful");
					exit;

			}else{
				die(mysqli_error($mycon));		
			} 
}
if (isset($_POST['add_ec_category']) ) {
			$product_category = protect_value($_POST['product_category']);
			// resizing picture
			
			if (isset($_FILES['cat_img'])) {
				$newNamePrefix = time() . '_';
				$uploadDir = 'assets/img/banner/'; 
				$filename = $newNamePrefix . $_FILES['cat_img']['name']; // Get the name of the file (including file extension).
				$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
				$fileName = $newNamePrefix . $_FILES['cat_img']['name'];
				$filePath = $uploadDir . $fileName;
				//check for extension.
				if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
		         
					$imageInformation = getimagesize($_FILES['cat_img']['tmp_name']);


					$imageWidth = $imageInformation[0]; //Contains the Width of the Image

					$imageHeight = $imageInformation[1]; //Contains the Height of the Image
					$location = protect_value($filePath);

					if($imageWidth < 850 or $imageHeight < 162)
					{
					   
					 
					}else{
					    
							$manipulator = new ImageManipulator($_FILES['cat_img']['tmp_name']);
					        // resizing to 200x200
					        $newproduct = $manipulator->resample(850, 162,false);
							//if file was moved succesfully
							$manipulator->save('../shop/assets/img/banner/' . $newNamePrefix . $_FILES['cat_img']['name']);
					}
				}
			}else{
				$location = "";
			}
			
			$sql_insert = "INSERT INTO ec_category() VALUES(NULL,'$product_category', '$location')";
			$qini = mysqli_query($mycon2,$sql_insert);
			if ($qini) {
				header("location:../admin/ecommerce.php?message=Added category uccessful");
					exit;

			}else{
				die(mysqli_error($mycon2));		
			} 
}
if (isset($_POST['add_ec_subcategory']) ) {
			$product_subcategory = protect_value($_POST['product_subcategory']);
			$m_cat_id = protect_value($_POST['m_cat']);
			$sql_insert = "INSERT INTO ec_sub_category() VALUES(NULL,'$product_subcategory', '$m_cat_id')";
			$qini = mysqli_query($mycon2,$sql_insert);
			if ($qini) {
				header("location:../admin/ecommerce.php?message=Added sub-category successful");
					exit;

			}else{
				die(mysqli_error($mycon2));		
			} 
}
if (isset($_POST['add_ec_leastcategory']) ) {
			$product_leastcategory = protect_value($_POST['product_leastcategory']);
			$m_cat_id = protect_value($_POST['m_cat']);
			$s_cat_id = protect_value($_POST['s_cat']);
			$sql_insert = "INSERT INTO ec_least_category() VALUES(NULL,'$product_leastcategory', '$m_cat_id', '$s_cat_id')";
			$qini = mysqli_query($mycon2,$sql_insert);
			if ($qini) {
				header("location:../admin/ecommerce.php?message=Added least-category successful");
					exit;

			}else{
				die(mysqli_error($mycon2));		
			} 
}
if (isset($_POST['comment'])) {
	$comment = protect_value($_POST['comment']);
	$post_id = protect_value($_POST['post_id']);
	$commenter  = protect_value($_SESSION['user_id']);
	$comment_sql = "INSERT INTO blog_post_comments VALUES(NULL,'$comment',$commenter, $post_id, NOW())";
	$comment_exe = mysqli_query($mycon, $comment_sql);
	if ($comment_exe) {
		echo "ok";
	}else{
		echo"Some thing happened";
	}
}
if (isset($_POST['Scomment'])) {
	$comment = protect_value($_POST['Scomment']);
	$post_id = protect_value($_POST['Spost_id']);
	$commenter  = $_SESSION['user_id'];
	$time = time();
	$comment_sql = "INSERT INTO social_post_comments VALUES(NULL,'$comment',$commenter, $post_id, $time)";
	$comment_exe = mysqli_query($mycon, $comment_sql);
	if ($comment_exe) {
		echo "ok";
	}else{
		echo"Some thing happened";
	}
}
if (isset($_POST['reply_input'])) {
	$reply_input = protect_value($_POST['reply_input']);
	$post_id = protect_value($_POST['post_id']);
	$replyer  = protect_value($_SESSION['user_id']);
	$comment_id = protect_value($_POST['comment_id']);
	$reply_sql = "INSERT INTO blog_post_comment_reply VALUES(NULL,'$reply_input',$replyer, $post_id, $comment_id, NOW())";
	$reply_exe = mysqli_query($mycon, $reply_sql);
	if ($reply_exe) {
		echo "ok";
	}else{
		echo"Some thing happened";
	}
}
if (isset($_FILES['video'])) {
		$poster_id = $_SESSION['user_id'];
		if(!empty(array_filter($_FILES['video']['name']))){
	        $newNamePrefix = time() . '_';
	        $count=0;
	        $location = "";
	        foreach($_FILES['video']['name'] as $key=>$val){
	        	$tmp = $_FILES['video']['tmp_name'][$count]; 
			$filename = $newNamePrefix . basename($_FILES['video']['name'][$key]); // Get the name of the file (including file extension).
			$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
			//$fileName = $newNamePrefix . $_FILES['file']['name'];
			
			//check for extension.
				if($ext== ".mkv" or $ext == ".mp4"){
	              	
						
	                //$picture = $db->mysql_prep($filePath);
					//if file was moved succesfully
					move_uploaded_file($tmp, '../videos/uploads/'.$val );
	                $location .= "videos/uploads/".$val."||";

					//$sql_query01 = "INSERT INTO pictures()Values(Null,{$post_id},'{$picture}')";
	                //$inserter = $db->query($sql_query01);

			   }

				    $count=$count + 1;
	        	}
	       		$locationprt = protect_value($location);
	      		$time = time();
	         
	       		if (isset($_POST['Vcaption']) ){$caption = $_POST['Vcaption'];}else{ $caption = "";}
	       		$poster_id = $_SESSION['user_id'];
	       		$querypic = "INSERT INTO social_posts() VALUES(NULL, $poster_id, '$locationprt', '$caption',  $time )";
	       		$picexe = mysqli_query($mycon, $querypic);
	       		if ($picexe) {
	       			echo "done";
	       		}else{
						die(mysqli_error($mycon));	
				}
			
		}
}
if (isset($_FILES['file'])) {
     if(!empty(array_filter($_FILES['file']['name']))){
        $newNamePrefix = time() . '_';
        $count=0;
        $location = "";
        foreach($_FILES['file']['name'] as $key=>$val){
        	$tmp = $_FILES['file']['tmp_name'][$count]; 
			$filename = $newNamePrefix . basename($_FILES['file']['name'][$key]); // Get the name of the file (including file extension).
			$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
		//$fileName = $newNamePrefix . $_FILES['file']['name'];
		
		//check for extension.
			if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
	             
				$imageInformation = getimagesize($tmp);


				         $imageWidth = $imageInformation[0]; //Contains the Width of the Image

				        $imageHeight = $imageInformation[1]; //Contains the Height of the Image
				        $location .= "images/upload/".$newNamePrefix.$val."||";


				        if($imageWidth < 0 OR $imageHeight < 0)
				          {
				             
				           
				        }else{
				              
				            $manipulator = new ImageManipulator($tmp);
				                  // resizing to 200x200
				                $newproduct = $manipulator->resample(500, 333, false);
				              //if file was moved succesfully
				              	$manipulator->save('../images/upload/' . $newNamePrefix . $_FILES['file']['name'][$count]);

				        }

		   }

		    $count=$count + 1;
        }
       	$locationprt = protect_value($location);
        if (isset($_POST['pic_caption']) ){$caption = $_POST['pic_caption'];}else{ $caption = "";}
       	$currentuser = $_SESSION['user_id'];
       	$time = time();
       	$querypic = "INSERT INTO social_posts() VALUES(NULL, $currentuser, '$locationprt', '$caption', $time )";
       	$picexe = mysqli_query($mycon, $querypic);
       	if ($picexe) {
       		echo "done";
       	}
		
			//$user_id_log = $_SESSION['otamidiuser_id'];
			//$user_g = User::find_by_id("users",$user_id_log);
			//$activity = $user_g->firstname . " ".$user_g->lastname . " added a  product titled " . $title."<br> Content: ".$content;
		

	//echo "Posted";
	//echo $response;

	}
}
if (isset($_POST['dob_day_edit'])) {
	$city = protect_value($_POST['city_edit']);
	$address = protect_value($_POST['address']);
	$DOB = $_POST['dob_day_edit']."-". $_POST['dob_month_edit'].'-'. $_POST['dob_year_edit'];
	$sql2 = "UPDATE users SET DOB = '$DOB', city = '$city'  WHERE id = {$_SESSION['user_id']}";
	$result2 = mysqli_query($mycon, $sql2);	
	

	if (isset($_POST['bio']) && !empty($_POST['bio'])) {
		$bio = protect_value($_POST['bio']);
		$queryuser_i = "SELECT * FROM u_info WHERE user_id = {$_SESSION['user_id']}";
		$userexe2 = mysqli_query($mycon, $queryuser_i);
		if (mysqli_num_rows($userexe2) > 0) {
			$sql3 = "UPDATE u_info SET BIO = '$bio', r_address = '$address' WHERE user_id = {$_SESSION['user_id']}";
			$result3 = mysqli_query($mycon, $sql3);
				
		}else{
			$querybio = "INSERT INTO u_info() VALUES(NULL, {$_SESSION['user_id']}, '$bio', '', '', '', '$address')";
	       	$bioexe = mysqli_query($mycon, $querybio);
	       	
		}
	}
	if ($result2 OR $result3 OR $bioexe) {
		echo "done";
	}
}
if (isset($_POST['add_banner_img']) ) {
			$banner_type = $_POST['banner_type'];
			if ($banner_type == "sld") {
				
				if (isset($_FILES['banner_img'])) {
				$newNamePrefix = time() . '_';
				$uploadDir = 'assets/img/banner/'; 
				$filename = $newNamePrefix . $_FILES['banner_img']['name']; // Get the name of the file (including file extension).
				$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
				$fileName = $newNamePrefix . $_FILES['banner_img']['name'];
				$filePath = $uploadDir . $fileName;
				//check for extension.
				if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
		         
					$imageInformation = getimagesize($_FILES['banner_img']['tmp_name']);


					$imageWidth = $imageInformation[0]; //Contains the Width of the Image

					$imageHeight = $imageInformation[1]; //Contains the Height of the Image
					$location = protect_value($filePath);

					if($imageWidth < 850 or $imageHeight < 162)
					{
					   
					 
					}else{
					    
							$manipulator = new ImageManipulator($_FILES['banner_img']['tmp_name']);
					        // resizing to 200x200
					        $newproduct = $manipulator->resample(850, 162,false);
							//if file was moved succesfully
							$manipulator->save('../shop/assets/img/banner/' . $newNamePrefix . $_FILES['banner_img']['name']);
					}
				}
				}else{
					$location = "";
				}
			}
			if ($banner_type == "hb") {
				
				if (isset($_FILES['banner_img'])) {
				$newNamePrefix = time() . '_';
				$uploadDir = 'assets/img/banner/'; 
				$filename = $newNamePrefix . $_FILES['banner_img']['name']; // Get the name of the file (including file extension).
				$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
				$fileName = $newNamePrefix . $_FILES['banner_img']['name'];
				$filePath = $uploadDir . $fileName;
				//check for extension.
				if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
		         
					$imageInformation = getimagesize($_FILES['banner_img']['tmp_name']);


					$imageWidth = $imageInformation[0]; //Contains the Width of the Image

					$imageHeight = $imageInformation[1]; //Contains the Height of the Image
					$location = protect_value($filePath);

					if($imageWidth < 850 or $imageHeight < 162)
					{
					   
					 
					}else{
					    
							$manipulator = new ImageManipulator($_FILES['banner_img']['tmp_name']);
					        // resizing to 200x200
					        $newproduct = $manipulator->resample(850, 162,false);
							//if file was moved succesfully
							$manipulator->save('../shop/assets/img/banner/' . $newNamePrefix . $_FILES['banner_img']['name']);
					}
				}
				}else{
					$location = "";
				}
			}
			if ($banner_type == "sb") {
				
				if (isset($_FILES['banner_img'])) {
				$newNamePrefix = time() . '_';
				$uploadDir = 'assets/img/banner/'; 
				$filename = $newNamePrefix . $_FILES['banner_img']['name']; // Get the name of the file (including file extension).
				$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
				$fileName = $newNamePrefix . $_FILES['banner_img']['name'];
				$filePath = $uploadDir . $fileName;
				//check for extension.
				if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
		         
					$imageInformation = getimagesize($_FILES['banner_img']['tmp_name']);


					$imageWidth = $imageInformation[0]; //Contains the Width of the Image

					$imageHeight = $imageInformation[1]; //Contains the Height of the Image
					$location = protect_value($filePath);

					if($imageWidth < 850 or $imageHeight < 162)
					{
					   
					 
					}else{
					    
							$manipulator = new ImageManipulator($_FILES['banner_img']['tmp_name']);
					        // resizing to 200x200
					        $newproduct = $manipulator->resample(850, 162,false);
							//if file was moved succesfully
							$manipulator->save('../shop/assets/img/banner/' . $newNamePrefix . $_FILES['banner_img']['name']);
					}
				}
				}else{
					$location = "";
				}
			}
			
			
			
			
			
			$sql_insert = "INSERT INTO ec_category() VALUES(NULL,'$product_category', '$location')";
			$qini = mysqli_query($mycon2,$sql_insert);
			if ($qini) {
				header("location:../admin/shop.php?message=Added category uccessful");
					exit;

			}else{
				die(mysqli_error($mycon2));		
			} 
}
if (isset($_POST['add_product'])) {
	$p_name = protect_value($_POST['p_name']);
	$p_price = protect_value($_POST['p_price']);
	$p_discount = protect_value($_POST['p_discount']);
	$new_price = discounted_price($p_price,$p_discount);
	if (isset($_POST['colradio']) AND $_POST['colradio']=="input") {
		if (isset($_POST['p_col_input'])) { $p_color = protect_value($_POST['p_col_input']); }else{ $p_color = ""; }
	}
	if (isset($_POST['colradio']) AND $_POST['colradio'] == "pick") {
		$p_color = "";
		if (!empty($_POST['pick_color'])) {
			foreach ($_POST['pick_color'] as $selected) {
			$p_color .= $selected."/";
			}
		}
	}

	if (isset($_POST['radiocat']) AND $_POST['radiocat']=="yes") {
		if (isset($_POST['m_cat'])) { $m_cat = protect_value($_POST['m_cat']); }else{ $m_cat = 0; }
		if (isset($_POST['s_cat'])) { $s_cat = protect_value($_POST['s_cat']); }else{ $s_cat = 0; }
		if (isset($_POST['l_cat'])) { $l_cat = protect_value($_POST['l_cat']); }else{ $l_cat = 0; }

	}
	if (isset($_POST['radiocat']) AND $_POST['radiocat']=="no") {
		$m_cat = 0;
		$s_cat = 0;
		$l_cat = 0;
	}
	$p_desc = protect_value($_POST['p_desc']);
	if (isset($_FILES['d_banner'])) {
        $newNamePrefix = time() . '_';
        $uploadDir = 'assets/img/img-banner/'; 
        $filename = $newNamePrefix . $_FILES['d_banner']['name']; // Get the name of the file (including file extension).
        $ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
        $fileName = $newNamePrefix . $_FILES['d_banner']['name'];
        $filePath = $uploadDir . $fileName;
        //check for extension.
        if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
             
          $imageInformation = getimagesize($_FILES['d_banner']['tmp_name']);


          $imageWidth = $imageInformation[0]; //Contains the Width of the Image

          $imageHeight = $imageInformation[1]; //Contains the Height of the Image
          $banner_location = protect_value($filePath);

          if($imageWidth < 600 or $imageHeight < 500)
          {
             
           
          }else{
              
              $manipulator = new ImageManipulator($_FILES['d_banner']['tmp_name']);
                  // resizing to 200x200
                  $newproduct = $manipulator->resample(600, 500,false);
              //if file was moved succesfully
              $manipulator->save('../shop/assets/img/img-banner/' . $newNamePrefix . $_FILES['d_banner']['name']);
          }

        }
    }
    if (isset($_FILES['front_img'])) {// front image and thumb image
        $newNamePrefix = time() . '_';
        $uploadDir = 'assets/img/img-product/';
        $uploadDir2 = 'assets/img/img-product-thumb/'; 

        $filename = $newNamePrefix . $_FILES['front_img']['name']; // Get the name of the file (including file extension).
        $ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
        $fileName = $newNamePrefix . $_FILES['front_img']['name'];
        $filePath = $uploadDir . $fileName;
        $filePath2 = $uploadDir2 . $fileName;

        //check for extension.
        if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
             
	        $imageInformation = getimagesize($_FILES['front_img']['tmp_name']);


	        $imageWidth = $imageInformation[0]; //Contains the Width of the Image

	        $imageHeight = $imageInformation[1]; //Contains the Height of the Image
	        $front_location = protect_value($filePath);
	        $thumb_location = protect_value($filePath2);

          	if($imageWidth < 0 or $imageHeight < 0)
          	{
             
           
          	}else{
                          
	            $manipulator = new ImageManipulator($_FILES['front_img']['tmp_name']);
	            // resizing to 200x200
	            $newproduct = $manipulator->resample(312, 400,false);
	            //if file was moved succesfully            
              	$manipulator->save('../shop/assets/img/img-product/' . $newNamePrefix . $_FILES['front_img']['name']);
         	}
         	if($imageWidth < 85 OR $imageHeight < 101)
			{				             	           
			}else{
				              
	            $manipulator = new ImageManipulator($_FILES['front_img']['tmp_name']);
	            // resizing to 200x200
                $newproduct = $manipulator->resample(85, 101,false);
              	//if file was moved succesfully
              	$manipulator->save('../shop/assets/img/img-product-thumb/' . $newNamePrefix . $_FILES['front_img']['name']);
	            
	        }
        }
    }
    if (isset($_FILES['p_img'])) {// product detals
	      	if(!empty(array_filter($_FILES['p_img']['name']))){
		        $newNamePrefix = time() . '_';
		        $count=0;
		        $details_location = "";

		        foreach($_FILES['p_img']['name'] as $key=>$val){
		        	$tmp = $_FILES['p_img']['tmp_name'][$count]; 
					$filename = $newNamePrefix . basename($_FILES['p_img']['name'][$key]); // Get the name of the file (including file extension).
					$ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
					//$fileName = $newNamePrefix . $_FILES['file']['name'];
					
					//check for extension.
					if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif" or $ext == ".mp4"){
		              	
							
		                $imageInformation = getimagesize($tmp);


				         $imageWidth = $imageInformation[0]; //Contains the Width of the Image

				        $imageHeight = $imageInformation[1]; //Contains the Height of the Image
				        $details_location .= "assets/img/img-product-details/".$newNamePrefix.$val."||";


				        if($imageWidth < 500 OR $imageHeight < 654)
				          {
				             
				           
				        }else{
				              
				            $manipulator = new ImageManipulator($tmp);
				                  // resizing to 200x200
				                $newproduct = $manipulator->resample(500, 654,false);
				              //if file was moved succesfully
				              	$manipulator->save('../shop/assets/img/img-product-details/' . $newNamePrefix . $_FILES['p_img']['name'][$count]);

				        }
				        

				        

				   }

				    $count=$count + 1;
		       }//end of foreach loop   
	      	}
    }
    echo $new_price;
    $time = time();
    $sql_insert = "INSERT INTO products VALUES(NULL, '$p_name', $p_price, $p_discount, $new_price,'$p_color', $m_cat, $s_cat, $l_cat, '$p_desc', '$banner_location', '$front_location', '$thumb_location', '$details_location', $time )";
    $sql_ini = $mycon2->query($sql_insert);
    if ($sql_ini) {
   		header("location:../admin/ecommerce.php?message=Added Product successful");
		exit;
	}else{
		die(mysqli_error($mycon2));		
	}
}
	    
 ?>