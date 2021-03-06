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
        
        function checkParticipants($email, $eventid){
            $sql = "SELECT * FROM certicates WHERE email = '".$email."' AND $eventid = '". $eventid ."' ";
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
            $sql = "SELECT * FROM certificates WHERE orgid = '".$id."' ORDER BY certid DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;


        }
        
        function viewCertDetails($certid){
            $sql = "SELECT * FROM certificates WHERE orgid = '".$certid."' ORDER BY certid DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;


        }


        function viewParticipants($eventid){
            $sql = "SELECT * FROM participants WHERE eventid = '".$eventid."'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;

        }

        function retrieveId($eventid, $email){
            //$sql = "SELECT * FROM participants WHERE eventid = '".$eventid."'";
            $sql = "SELECT *
            FROM participants
            WHERE eventid = '$eventid'
            AND email = '$email'";
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

        function createCert($eventname, $eventdate, $orgid, $venue, $organizer1, $organizer2, $organizer3, $signatory1, $signatory2, $signatory3, $department, $title, $description, $recognition, $presentationline, $logo1, $logo2, $logo3, $expdate){
           
            $sql = "INSERT INTO certificates(eventname, eventdate, orgid, venue, organizer1, organizer2, organizer3, signatory1, signatory2, signatory3, department, title, description, recognition, presentationline, logo1, logo2, logo3, expdate) values('$eventname','$eventdate', '$orgid', '$venue','$organizer1','$organizer2','$organizer3','$signatory1','$signatory2','$signatory3','$department','$title','$description', '$recognition', '$presentationline',  '$logo1', '$logo2', '$logo3', '$expdate')";

            $stmt = $this->conn->prepare($sql);
            
            $stmt->execute();
                        
            return true;
        }

        function updateCert($eventname, $eventdate, $venue, $organizer1, $organizer2, $organizer3, $department, $title, $description, $recognition, $presentationline, $logo1, $logo2, $logo3, $expdate ,$certid){
            $sql = "UPDATE certificates SET eventname='$eventname', eventdate='$eventdate', venue='$venue', organizer1='$organizer1', organizer2='$organizer2' , organizer3='$organizer3', department='$department', title='$title',  description='$description', recognition='$recognition', presentationline='$presentationline', logo1='$logo1', logo2='$logo2', logo3='$logo3', expdate='$expdate'  WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
         function setExpLink($expdate, $certid){
            $sql = "UPDATE certificates SET expdate='$expdate' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
        function clrDate($expdate, $certid){
            $sql = "UPDATE certificates SET expdate='$expdate' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
        function delImg1($imgname, $certid){
            $sql = "UPDATE certificates SET logo1 = ' ' WHERE certid='$certid' AND logo1='$imgname'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
         
        function delImg2($imgname, $certid){
            $sql = "UPDATE certificates SET logo2 = ' ' WHERE certid='$certid' AND logo2='$imgname'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
        function delImg3($imgname, $certid){
            $sql = "UPDATE certificates SET logo3 = ' ' WHERE certid='$certid' AND logo3='$imgname'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
        function delSign1($imgname, $certid){
            $sql = "UPDATE certificates SET signatory1 = ' ' WHERE certid='$certid' AND signatory1='$imgname'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
        function delSign2($imgname, $certid){
            $sql = "UPDATE certificates SET signatory2 = ' ' WHERE certid='$certid' AND signatory2='$imgname'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
        function delSign3($imgname, $certid){
            $sql = "UPDATE certificates SET signatory3 = ' ' WHERE certid='$certid' AND signatory3='$imgname'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
                        
            return true;
        }
        
        function deleteCert($certid){
            $sql = "DELETE FROM certificates WHERE certid='$certid'";

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

        function upload1($signatory1, $certid){  
           //$sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";
           // $sql = "INSERT INTO certificates(logo1, signatory1) VALUES ('$logo1','$signatory1') WHERE certid = '$certid'";
            $sql = "UPDATE certificates SET signatory1='$signatory1' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);


            $stmt->execute();
                        
            return true;
        }

        function upload2($signatory2, $certid){  
           //$sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";
           // $sql = "INSERT INTO certificates(logo1, signatory1) VALUES ('$logo1','$signatory1') WHERE certid = '$certid'";
            $sql = "UPDATE certificates SET signatory2='$signatory2' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);


            $stmt->execute();
                        
            return true;
        }

        function upload3($signatory3, $certid){  
           //$sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";
           // $sql = "INSERT INTO certificates(logo1, signatory1) VALUES ('$logo1','$signatory1') WHERE certid = '$certid'";
            $sql = "UPDATE certificates SET signatory3='$signatory3' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);


            $stmt->execute();
                        
            return true;
        }
        
        function upload4($logo1, $certid){  
           //$sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";
           // $sql = "INSERT INTO certificates(logo1, signatory1) VALUES ('$logo1','$signatory1') WHERE certid = '$certid'";
            $sql = "UPDATE certificates SET logo1='$logo1' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);


            $stmt->execute();
                        
            return true;
        }
        
        
        function upload5($logo2, $certid){  
           //$sql = "INSERT INTO organizers(fname, lname, email, password) values('$fname','$lname','$email','$password')";
           // $sql = "INSERT INTO certificates(logo1, signatory1) VALUES ('$logo1','$signatory1') WHERE certid = '$certid'";
            $sql = "UPDATE certificates SET logo2='$logo2' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);


            $stmt->execute();
                        
            return true;
        }
        
         function upload6($logo3, $certid){  
           
            $sql = "UPDATE certificates SET logo3='$logo3' WHERE certid='$certid'";

            $stmt = $this->conn->prepare($sql);


            $stmt->execute();
                        
            return true;
        }
        
    }  
    
?>   