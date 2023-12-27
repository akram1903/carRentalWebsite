<?php
class customer 
{
    //properties
    public $ssn;
    public $fName;
    public $lName;
    public $email;
    protected $password;
    public $phone_no;
    public $role = "customer";
    public $wallet;
    //Methods
    public function __construct($ssn, $fName,$lName, $email, $password,$phone_no,$wallet)
    {
        $this->ssn = $ssn;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->email = $email;
        $this->password = $password;
        $this->phone_no = $phone_no;
        $this->wallet=$wallet;

    }

    static function login($email, $password)
    //Must be static so it can be accessed without creating object 
    //because login happens before there exist a user 
    {
        $customer = null;
        //connection with database
        require_once('config.php'); //gets page data once 
        //query to Check User in database with correct email and password 
        $qry = "SELECT * FROM Customer WHERE email='$email' AND password='$password'";
        //Double quotation to detect variables
        //email and passeord are strings -> ' '
        $cn = mysqli_connect(DB_host, DB_user_name, DB_user_password, DB_name);
        //Connect not secure attack->SQL injection instead use BDO object
        var_dump($cn);
        $result = mysqli_query($cn, $qry);
        //this is to execute the query takes 1-connection 2-query 
        //This gets data so you must fetch:
        if ($data = mysqli_fetch_assoc($result)) { //returns associative array if there is a user found with this information in DB
            switch ($data["role"]) {
                    //Make the object according to the role either user or admin
                case 'customer':
                    $customer = new customer($data["ssn"], $data["fName"], $data["LName"], $data["email"], $data["password"],$data["phone_no"],$data["wallet"]);
                    break;

                case 'admin':
                    $customer = new admin($data["ssn"], $data["fName"], $data["LName"], $data["email"], $data["password"],$data["phone_no"],$data["wallet"]);
                    break;
            }
        }
        mysqli_close($cn); //you must close the connection
        return $customer;
    }

    
}
class admin extends customer
{
    //override
    public $role = "admin";
    function deleteUser()
    {
    }
    function showAllUser()
    {
    }
}