<?php  

session_start();  
    class dbFunction {  

    private $conn;
    public $id;
    public $fname;
    public $lname;
    public $email;
    public $password;
            
    function __construct($db){
        $this->conn = $db;
    }

       function UserRegister($fname, $lname, $email, $password){  
        $password = md5($password);  
        $sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindparam(1,$this->fname);
        $stmt->bindparam(2,$this->lname);
        $stmt->bindparam(3,$this->email);
        $stmt->bindparam(4,$this->password);
        $stmt->execute();
                    
        }  
        public function loginUser(){  
            $password = md5($password); 
            $sql = "SELECT * FROM organizers where email=? AND password=?";
            $stmt = $this->conn->prepare($sql);

            
            $stmt->bindparam(1,$this->email);
            $stmt->bindparam(2,$this->password);

            $stmt->execute();
            
            

            return $stmt;
        }  
        public function isUserExist($email){  
            $sql = "SELECT * FROM organizers WHERE email = '".$email."'";

        }  
    }  
?>  