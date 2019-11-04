<?php
function restyle_text($input){
    if(empty($input)) {
        return "0";
    }
	$input = number_format($input);
	$input_count = substr_count($input, ',');
	if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'k';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'mil';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'bil';
        } else {
            return;
        }
    } else {
        return $input;
    }
}

function get_timeago( $ptime )
{   
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
    $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}
function mutual_friends($o_user, $mycon){
  $list_uf = array();
  $list_of = array();
  $counter = 0;
  $counter2 = 0;
  $sql = " SELECT * FROM userfriends WHERE user_id = {$_SESSION['user_id']}  OR friend_id = {$_SESSION['user_id']}";
              $sqlexe = mysqli_query($mycon, $sql);
              while($fetch = mysqli_fetch_array($sqlexe) ){
                if ($_SESSION['user_id'] == $fetch['user_id']) {
                  $usertocheck = $fetch['friend_id'];
                  }
                else{
                    $usertocheck = $fetch['user_id'];
                  }
                  
                $list_uf[$counter] = $usertocheck;
                $counter++;
              } 
  $sql2 = " SELECT * FROM userfriends WHERE user_id = $o_user OR friend_id = $o_user";
              $sqlexe2 = mysqli_query($mycon, $sql2);
              while($fetch2 = mysqli_fetch_array($sqlexe2) ){
                if ($o_user == $fetch2['user_id']) {
                  $usertocheck = $fetch2['friend_id'];
                  }
                else{
                    $usertocheck = $fetch2['user_id'];
                  } 
                $list_of[$counter2] = $usertocheck;
                $counter2++;
              }
              //print_r( $list_of);
              //print_r($list_uf);
              $mutual = array_intersect($list_uf, $list_of);
              $no_mutual = count($mutual);
              if ($no_mutual == 0) {
                  return "no mutual friends";
              }else{
                return $no_mutual. " mutual friends";
              }
              //print_r($mutual);
              /*foreach ($mutual as $key => $value) {
                $queryuser = "SELECT * FROM users WHERE id = $value";
                $userexe = mysqli_query($mycon, $queryuser);
                $userinfo = mysqli_fetch_array($userexe);
                return $userinfo['firstname']."<br>";
              }*/
}

function initiate_resize($imgname, $width, $height,$saveDir,$serverDir){
  if (isset($_FILES['$imgname'])) {
        $newNamePrefix = time() . '_';
        $uploadDir = '$serverDir'; 
        $filename = $newNamePrefix . $_FILES['$imgName']['name']; // Get the name of the file (including file extension).
        $ext = strtolower(substr($filename, strpos($filename,'.'), strlen($filename)-1));
        $fileName = $newNamePrefix . $_FILES['$imgName']['name'];
        $filePath = $uploadDir . $fileName;
        //check for extension.
        if($ext == ".png" or $ext == ".jpg" or $ext == ".jpeg" or $ext == ".gif"){
             
          $imageInformation = getimagesize($_FILES['$imgName']['tmp_name']);


          $imageWidth = $imageInformation[0]; //Contains the Width of the Image

          $imageHeight = $imageInformation[1]; //Contains the Height of the Image
          $location = protect_value($filePath);

          if($imageWidth < $width or $imageHeight < $height)
          {
             
           
          }else{
              
              $manipulator = new ImageManipulator($_FILES['$imgName']['tmp_name']);
                  // resizing to 200x200
                  $newproduct = $manipulator->resample($width, $height);
              //if file was moved succesfully
              $manipulator->save('$saveDir' . $newNamePrefix . $_FILES['$imgName']['name']);
          }

        }
      }
}

function discounted_price($price,$discount){
  $d_price = $price * (100 - $discount)/100;
  $whole = ceil($d_price);
  return $whole;
}
function reduced_text($text,$length){
  
  if(strlen($text) > $length){
    return substr($text, 0, $length) . "...";
  }
  else{
    return  $text;
  }
}
function total_cart(){
  $keys = array_column($_SESSION['cart'], 'item_quantity');
  $sum = array_sum($keys); 
  return $sum;

}
function total_price(){
  if (empty($_SESSION['cart'])) {
    return "-";
  }
  else{
    $keys = array_column($_SESSION['cart'], 'subtotal');
    $sum = array_sum($keys);
    return number_format($sum);
  }
}
function get_user($mycon, $column){

  $queryuser = "SELECT * FROM users WHERE id = {$_SESSION['user_id']}";
  $userexe = mysqli_query($mycon, $queryuser);
  $userinfo = mysqli_fetch_array($userexe);
  return $userinfo[$column];

}
           
?>