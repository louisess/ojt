<?php  

    class dbFunction {  

    public $conn;
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

        function checkDuplicates($email){
            $sql = "SELECT * FROM organizers WHERE email = '".$email."'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;

        }

        function editAcct($fname, $lname, $email, $id){  
        //$password = md5($password);  
        $sql = "UPDATE organizers SET fname='$fname', lname='$lname', email='$email' WHERE id='$id'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
                    
        return true;
        }

        function viewCerts($id){
            $sql = "SELECT * FROM certificates WHERE orgid = '".$id."'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;


        }

        function viewCertsForUpload($id, $eventdate, $venue, $eventname){
            //$sql = "SELECT * FROM certificates WHERE orgid = '".$id."'. AND eventdate = '". ."'";
            $sql = "SELECT certid FROM certificates
            WHERE orgid = '$id' 
            AND eventdate = '$eventdate'
            AND eventname = '$eventname';
            AND venue = '$venue'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;


        }

        function certName($eventid){
            $sql = "SELECT * FROM certificates WHERE certid = '".$eventid."'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            //$query = $this->connection->query($sql);
     
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;    

            

        }

        function createCert($eventname, $eventdate, $orgid, $venue, $organizer1, $organizer2, $organizer3){
            //$sql = "SELECT * FROM certificates WHERE orgid = '$id'";
            $sql = "INSERT INTO certificates (eventname, eventdate, orgid, venue, organizer1, organizer2, organizer3) values('$eventname','$eventdate','$orgid', '$venue','$organizer1','$organizer2','$organizer3')";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }

        function addParticipant($name, $email, $eventid){
            //$sql = "SELECT * FROM certificates WHERE orgid = '$id'";
            $sql = "INSERT INTO participants(name, email, eventid) values('$name','$email','$eventid')";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }

        function uploadImages($signatory1, $certid){  
           //$sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";
           // $sql = "INSERT INTO certificates(logo1, signatory1) VALUES ('$logo1','$signatory1') WHERE certid = '$certid'";
            $sql = "UPDATE certificates SET signatory1='$signatory1' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);


            $stmt->execute();
                        
            return true;
        }

         
    }  
?>   