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
        require_once('connection.php'); //gets page data once 
        //query to Check User in database with correct email and password 
        $qry = "SELECT * FROM Customer WHERE email='$email' AND password='$password'";
        //Double quotation to detect variables
        //email and passeord are strings -> ' '
        $cn = Connect();
        //Connect not secure attack->SQL injection instead use BDO object
        // var_dump($cn);
        $result = $cn->query($qry);
        //this is to execute the query takes 1-connection 2-query 
        //This gets data so you must fetch:
        if ($data = mysqli_fetch_assoc($result)) { //returns associative array if there is a user found with this information in DB
           // switch ($data["role"]) {
                    //Make the object according to the role either user or admin
                //case 'customer':
                    $customer = new customer($data["ssn"], $data["fName"], $data["lName"], $data["email"], $data["password"],$data["phone_no"],$data["wallet"]);
                //    break;

                //case 'admin':
                  //  $customer = new admin($data["ssn"], $data["fName"], $data["lName"], $data["email"], $data["password"],$data["phone_no"],$data["wallet"]);
                  //  break;
         //   }
        }
        $cn->close(); //you must close the connection
        return $customer;
    }
    static function signUp($email, $password, $fName,$lName,$phone_no)
    {
        //connection with database
        require_once('connection.php');
        $cn = Connect();

        //gets page data once 
        //query to Insert User in database 
        $qry = "INSERT INTO Customer(fName,lName,email,password,phone_no) VALUES('$fName','$lName','$email','$password','$phone_no')";
        //Double quotation o detect variables
        //email and passeord are strings -> ' '
        
        
        //Connect not secure attack->SQL injection instead use BDO object
        // var_dump($cn);
        //this is to execute the query takes 1-connection 2-query this line where error may occurs->Exception try and catch
        try {
            $result = $cn->query($qry);
            // if($result === TRUE){
            //     echo "Signed up successfully";
            // }
            // else{
            //     echo "signed up unsuccessfull";
            //     var_dump($cn);
            // }
            //This dont get data so you nofetch:
            $cn->close(); //you must close the connection
            return $result;

            // header("location:index.php?Successful_Registeration");
        } catch (\Throwable $th) {
            $cn->close();
            header("location:SignUp.php?msg=Email_Exists");
        }
        //Note: even if it entered catch it executes what is after it


    }
    //Static->because it is for all users
    static function showAllCars()
    {

        require_once('config.php');
        $qry = "SELECT * FROM Car ORDER BY registration_date desc LIMIT 20";
        $cn = mysqli_connect(DB_host, DB_user_name, DB_user_password, DB_name ,DB_port);
        $result = mysqli_query($cn, $qry);
        
        //query gets data so you must fetch
        //mysqli_fetch_all()->returns all data (كذا row)
        //mysqli_fetch_assoc()->returns one row
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
    }
    function getCarPhotos($plate_id)
    {
        require_once('config.php');
        //show posts of the user in descending order
        //get data from 2 tables in DB use->join
        $qry = "SELECT photo FROM Car_Photos where Car_plate_id='$plate_id'";
        $cn = mysqli_connect(DB_host, DB_user_name, DB_user_password, DB_name ,DB_port);
        $result = mysqli_query($cn, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
    }
    static function getCar($plate_id)
    {
        require_once('config.php');
        //show posts of the user in descending order
        //get data from 2 tables in DB use->join
        $qry = "SELECT * FROM Car where plate_id='$plate_id'";
        $cn = mysqli_connect(DB_host, DB_user_name, DB_user_password, DB_name ,DB_port);
        $result = mysqli_query($cn, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
    }
    
    static function getreservedDuration($plate_id)
    {
        require_once('config.php');
        //show posts of the user in descending order
        //get data from 2 tables in DB use->join
        $qry = "SELECT * FROM reservation where Car_plate_id='$plate_id' ORDER BY return_date ";
        $cn = mysqli_connect(DB_host, DB_user_name, DB_user_password, DB_name ,DB_port);
        $result = mysqli_query($cn, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($cn);
        return $data;
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
?>