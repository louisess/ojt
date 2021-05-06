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
                    
        return true;
        }  

        function loginUser($email, $password){  
            $password = md5($password); 
            $sql = "SELECT * FROM organizers where email='$email' AND password='$password'";
            $stmt = $this->conn->prepare($sql);

            
            $stmt->bindparam(1,$this->email);
            $stmt->bindparam(2,$this->password);

            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            /*
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch_array();
                return $row['id'];
            }
            else{
                return false;
            }
            */
        }  

        public function check_login($email, $password){
            $password = md5($password);
            $sql = "SELECT * FROM organizers where email='$email' AND password='$password'";
            //$query = $this->connection->query($sql);
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['id'];
            }
            else{
                return false;
            }
        }

        public function details($sql){
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            //$query = $this->connection->query($sql);
     
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;       
        }

 

        public function isUserExist($email){  
            $sql = "SELECT * FROM organizers WHERE email = '".$email."'";
            $stmt = $this->conn->prepare($sql);
            //$sql->execute();
            //$query = $this->connection->query($sql);
     
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row; 

        }  

        function editAcct($fname, $lname, $email, $password){  
        $password = md5($password);  
        $sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindparam(1,$this->fname);
        $stmt->bindparam(2,$this->lname);
        $stmt->bindparam(3,$this->email);
        $stmt->bindparam(4,$this->password);
        $stmt->execute();
                    
        return true;
        }
    }  
?>  