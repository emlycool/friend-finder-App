<?php
class User
{
    private $id;
    public $firstname;
    public $lastname;
    public $phone;
    public $email;
    private $password;
    public $profile_pic = "images/default.jpg";
    public $gender;
    public $city;
    public $country;
    public $DOB;
    private $token;
    private $verified;
    public $date_added;
    
    
    public function fullname()
    {
        $fullname = $this->firstname. " " . $this->lastname;
        return $fullname;
    }
    public function Capitalise($str)
    {
        global $database;
        $value = ucfirst($database->protect_value($str));
        return $value;
    }
    public function hash($str)
    {
        return password_hash($str, PASSWORD_DEFAULT);
    }
    public function findById($id=0)
    {
        global $database;
        $result_set = $database->query("SELECT * FROM users WHERE id = {$id} LIMIT 1");
        $result_array = $database->fetch_array($result_set);
        return $result_array;
    }
    public function token(){
        $token = md5(rand(0, 1000));
        return $token;
    }
    public function allUsers()
    {
        global $database;
        $result = $database->query("SELECT * FROM users");
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
        
    }
    public function postUser(){
        global $database;
        $res = $database->query("INSERT INTO users()
            VALUES(NULL, '$this->firstname', '$this->lastname', NULL, '$this->email', '$this->password', '$this->profile_pic', '$this->gender', '$this->city', '$this->country', '$this->DOB', '$this->token', $this->verified, '$this->date_added')");
        return $res;
        
    }
    public function setter($property,$string){
        $this->{$property} = $string;

    }
    public function gettter($property)
    {
        return $this->{$property};
    }
    // public function updateUser($column, $data, $user_id, $nodata){
    //     global $database;
    //     $query = "UPDATE users SET {$column} = ''"
    // }
    public static function emailExists($email)
    {
        global $database;
        $database->query("SELECT * FROM `users` WHERE `email` = '$email' ");
        if($database->rowsAffected() > 0)
        {
            return true;
        } 
        else{
            return false;
        }

    }
    public static function activate($email,$token){
        global $database;
        $res = $database->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
        if ($database->rowsAffected() == 1) {
            $result_array = $database->fetch_array($res);
            if ($result_array['verified'] == 1) {
                $_SESSION['success'] = "Account is already verified!, proceed to login.";
                header("location:../index.php#login");
                die;
            }
            else{
                if ($token == $result_array['token']) {
                    $confirm = $database->query("UPDATE `users` SET status = 1 WHERE id = {$result_array['id']}");
                    self::$verified = 1;
                    if ($confirm) {
                        $_SESSION['success'] = "Account verified, proceed to login";
                        header("location:../index.php#login");
                        die;
                    }
                    
                }
                else{
                    echo "link expired";
                }
            }
        }
        
    }
}

?>