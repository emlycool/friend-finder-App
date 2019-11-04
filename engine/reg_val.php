<?php
//require_once '../classControllers/db.php';
require_once '../classControllers/init.php';
$database = new db;

if ($_POST['firstname']) {
    $error = array();
    $data = array();
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(empty($_POST['firstname'])){$error['firstname']  = "Required!";}
    if (!preg_match($string_exp, $_POST['firstname'])) { $error['register'] = '<div class="alert alert-warning">The First Name you entered does not appear to be valid</div>'; }
    if (!preg_match($string_exp, $_POST['lastname'])) { $error['register'] = '<div class="alert alert-warning">The Last Name you entered does not appear to be valid</div>'; }
    if (empty($_POST['lastname'])) {$error['lastname']  = "Required!";}
    if (empty($_POST['lastname'])) {$error['lastname']  = "Required!";}
    if (empty($_POST['email'])) { $error['email']  = "Required!";}
    if (empty($_POST['password'])) {$error['password']  = "Required!"; }
    if (empty($_POST['country'])) {$error['country']    = "Required!";}
    if (empty($_POST['optradio'])) {$error['gender']    = "Required!";}
    if (empty($_POST['city'])) { $error['city']         = "Required!";}
    if (!empty($_POST['dob_day']) && !empty($_POST['dob_month']) && !empty($_POST['dob_year']) ) {
        $DOB = $_POST['dob_day'] . "/" . $_POST['dob_month'] . '/' . $_POST['dob_year'];
    }
    else{ $error['register'] = "Invalid Date of Birth";  }
    

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $_POST['password']);
    $lowercase = preg_match('@[a-z]@', $_POST['password']);
    $number    = preg_match('@[0-9]@', $_POST['password']);
    if (!$uppercase || !$lowercase || !$number  || strlen($_POST['password']) < 8) {
        $error['register'] = "<div class=\"alert alert-danger\">Password should be at least 8 characters in length and should include at least one upper case letter and one number.</div>"; }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { $error['email'] = "Invalid email"; }
    User::emailExists($_POST['email']) ? $error['email'] = "Email exists" : false ;
    if (empty($error)) {
        $user = new User;
        $user->firstname = $user->Capitalise($_POST['firstname']);
        $user->lastname = $user->Capitalise($_POST['lastname']);
        $user->email = $database->protect_value($_POST['email']);
        $user->city = $user->Capitalise($_POST['city']);
        $user->country = $user->Capitalise($_POST['country']);
        $user->gender = $user->Capitalise($_POST['optradio']);
        $user->DOB = $database->protect_value($DOB);
        $user->setter("password",$user->hash($_POST['password']));
        $user->setter("token", $user->token());
        $user->setter("verified", 0);
        $user->date_added = date("Y-m-d H:i:s");
        //$user->date_addded = time();
        if($user->postUser()){
            $url = "/pages/activate.php?token=\$user->token&email=\$user->email";
            firemail($user->email, $url);
            $data['message'] = "<div class=\"alert alert-warning\">Registration Successful kindly check your mail to activate your account.</div>";
            
        }
        else{
            $error['register'] = "<div class=\"alert alert-warning\"><span class=\"glyphicon glyphicon-info-sign\"></span> &nbsp; Registration Failed, Try again</div>";
        }

        

    }


    if (!empty($error)) {
        $data['success'] = false;
        $data['errors']  = $error;
    } else {
        $data['success'] = true;
    }
   // print_r($data);
    echo json_encode($data);
}



?>