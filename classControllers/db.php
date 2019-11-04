<?php
require_once 'constant.php';
class db
{
    private $db;
    private $lastQuery;
    function __construct()
    {

        $this->get_connection();
    }


    public function get_connection()
    {
        $this->db = new mysqli(server, username, password, database);
        if ($this->db->connect_errno) {
            die("Database connection failed" . $this->db->connect_error);
        }
    }

    public function query($sql)
    {
        $this->lastQuery = $sql;
        $result = $this->db->query($sql);

        $this->confirm_query($result);

        return $result;
    }

    private function confirm_query($result)
    {
        if (!$result) {
            $output = "Query failed" . $this->db->error. "</br>";
            $output .= "Last Query". $this->lastQuery;
            die($output);
        }
    }


    public function escape_string($string)
    {

        $escape_string = $this->db->real_escape_string($string);
        return $escape_string;
    }
    public function protect_value($string)
    {
        $protected_value = htmlentities($this->escape_string($string));
        return $protected_value; 
    }
    public function fetch_array($string)
    {
        
        $array = mysqli_fetch_array($string);
        return $array;
    }
    public function rowsCount($resultSet){
        mysqli_num_rows($resultSet);
    }
    public function insertId(){
        return mysqli_insert_id($this->db);
    }
    public function rowsAffected(){
        return mysqli_affected_rows($this->db);
    }
    public function close_connnection(){
        return mysqli_close($this->db);
    }
}


class DB2
{
    private $db;
    private $lastQuery;
    function __construct()
    {

        $this->get_connection();
    }


    public function get_connection()
    {
        $this->db = new mysqli(server2, username2, password2, database2);
        if ($this->db->connect_errno) {
            die("Database connection failed" . $this->db->connect_error);
        }
    }

    public function query($sql)
    {
        $this->lastQuery = $sql;
        $result = $this->db->query($sql);

        $this->confirm_query($result);

        return $result;
    }

    private function confirm_query($result)
    {
        if (!$result) {
            $output = "Query failed" . $this->db->error . "</br>";
            $output = "Last Query" . $this->lastQuery;
            die($output);
        }
    }


    public function escape_string($string)
    {

        $escape_string = $this->db->real_escape_string($string);
        return $escape_string;
    }
    public function protect_value($string)
    {
        $protected_value = htmlentities($this->escape_string($string));
        return $protected_value;
    }
    public function fetch_array($string)
    {

        $array = mysqli_fetch_array($string);
        return $array;
    }
    public function rowsCount($resultSet)
    {
        mysqli_num_rows($resultSet);
    }
    public function insertId()
    {
        return mysqli_insert_id($this->db);
    }
    public function rowsAffected()
    {
        return mysqli_affected_rows($this->db);
    }
    public function close_connnection()
    {
        return mysqli_close($this->db);
    }
}

?>