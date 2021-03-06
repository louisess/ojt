<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
include ('db/dbcon.php');
include_once('db/dbFunction.php'); 

$database = new Database();
$db = $database->getConnection();

//session_start();

// check user login
//$user = new User();
$funObj = new dbFunction($db); 


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/f2009aab61.js" crossorigin="anonymous"></script>

  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    CertiCreate
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/style.css" rel="stylesheet" />
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="bgbody">
  <div class="container mt-5 text-center">
      <img src="assets/img/logotiny.png">
  </div>
  <div class="row">
    <div class="col-md-2">
      
    </div>

    <div class="col-md-8">

      <!-- events container -->
      <div class="card text-center mx-5 my-5">
        <div class="card-header">
          
        </div>
        <div class="card-body">
          <h5 class="card-title">Participant Form</h5>
          <hr>
            <div class="row formrow">
              <?php
                  $eventid = $_GET['certid'];
                  //echo $eventid;
                  $row = $funObj->certName($eventid);
                  echo "<p><b>Seminar: </b>".$row['eventname'];
                  
                  $expdate = $row['expdate'];
                  $datenow = date("Y-m-d");
                  $defauldate = '0000-00-00';
                  
                 // echo "<p><b>Seminar: </b>".$datenow;
                 
                
                // $now = date("Y-m-d");
                if( $defauldate == $expdate){
                     if(isset($_POST['addparticipant'])){

                    $eventid = $_POST['eventid'];
                    $name = $_POST['name']; 
                    $email1 = $_POST['email1'];
                    $email2 = $_POST['email2'];

                    if ($email1 !== $email2){
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Oops! Email do not match!
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                    }else{
                      $email = $_POST['email1'];
                      //$checkparticipants = $funObj->checkParticipants($eventid, $email);
                      $retrieveId = $funObj->retrieveId($eventid, $email);
                        $count =  $retrieveId->rowCount();
                     

                      if($count > 0){
                        
                        $partrow = $retrieveId->fetch(PDO::FETCH_ASSOC);
                         echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                              Oops! You have already registered for this seminar. Your certificate code is: <b>UB-".$eventid. $partrow['pid'] ."</b>
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
                          
                      }else{
                        $added = $funObj->addParticipant($name, $email, $eventid);
                        $retrieveId = $funObj->retrieveId($eventid, $email);
                        $count =  $retrieveId->rowCount();
                        $partrow = $retrieveId->fetch(PDO::FETCH_ASSOC);
                        
                         echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
                                Success! Here is your Certificate Code: <b>UB-'.$eventid. $partrow['pid'] .'</b> Verify and Download your Certificate <a style="color:white" name="pdf_report_generate" href="verify.php?verify='.$eventid. $partrow['pid'] .'"><b>here.</b></a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                      }
                      
                    }                      

                  }  

                  echo '</p>

              <form id="addParticipants" action="participantsform.php?certid='.$eventid.'" method="post">

                <input type="hidden" id="eventid" name="eventid" value="'.$eventid.'">

                <div class="form-group">
                  <label for="formGroupExampleInput">NAME</label>
                  <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Juan dela Cruz" required>
                </div>

                <div class="form-group">
                  <label for="formGroupExampleInput2">EMAIL</label>
                  <input type="email" name="email1" class="form-control" id="formGroupExampleInput2" placeholder="jdl@gmail.com" required>
                </div>


                
                <div class="form-group">
                  <label for="formGroupExampleInput2">CONFIRM EMAIL</label>
                  <input type="email" name="email2" class="form-control" id="formGroupExampleInput2" placeholder="jdl@gmail.com" required>
                </div>
              
              <input type="submit" class="btn btn-primary" value="Submit" name="addparticipant">';
                    
                }
                else if ($datenow > $expdate) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Oops! The link you are trying to access is already expired!
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                            <p class="text-center">
                            <h6> Why is your link expired?</h6>
                            <i>
                            - The seminar you have attended has a cut off for registration. Ask your organizer about this.
                            </i>
                            <p>';
                        
                 }else{
                     
                      if(isset($_POST['addparticipant'])){

                    $eventid = $_POST['eventid'];
                    $name = $_POST['name']; 
                    $email1 = $_POST['email1'];
                    $email2 = $_POST['email2'];

                    if ($email1 !== $email2){
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Oops! Email do not match!
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                    }else{
                      $email = $_POST['email1'];
                      //$checkparticipants = $funObj->checkParticipants($eventid, $email);
                      $retrieveId = $funObj->retrieveId($eventid, $email);
                        $count =  $retrieveId->rowCount();
                     

                      if($count > 0){
                        
                        $partrow = $retrieveId->fetch(PDO::FETCH_ASSOC);
                         echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                              Oops! You have already registered for this seminar. Your certificate code is: <b>UB-".$eventid. $partrow['pid'] ."</b>
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
                          
                      }else{
                        $added = $funObj->addParticipant($name, $email, $eventid);
                        $retrieveId = $funObj->retrieveId($eventid, $email);
                        $count =  $retrieveId->rowCount();
                        $partrow = $retrieveId->fetch(PDO::FETCH_ASSOC);
                        
                         echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
                                Success! Here is your Certificate Code: <b>UB-'.$eventid. $partrow['pid'] .'</b> Verify and Download your Certificate <a style="color:white" name="pdf_report_generate" href="verify.php?verify='.$eventid. $partrow['pid'] .'"><b>here.</b></a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                      }
                      
                    }                      

                  }  

                  echo '</p>

              <form id="addParticipants" action="participantsform.php?certid='.$eventid.'" method="post">

                <input type="hidden" id="eventid" name="eventid" value="'.$eventid.'">

                <div class="form-group">
                  <label for="formGroupExampleInput">NAME</label>
                  <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Juan dela Cruz" required>
                </div>

                <div class="form-group">
                  <label for="formGroupExampleInput2">EMAIL</label>
                  <input type="email" name="email1" class="form-control" id="formGroupExampleInput2" placeholder="jdl@gmail.com" required>
                </div>


                
                <div class="form-group">
                  <label for="formGroupExampleInput2">CONFIRM EMAIL</label>
                  <input type="email" name="email2" class="form-control" id="formGroupExampleInput2" placeholder="jdl@gmail.com" required>
                </div>
              
              <input type="submit" class="btn btn-primary" value="Submit" name="addparticipant">';
                 }
                  

                 




                ?>
              </form>
            </div>
          
        </div>
        <div class="card-footer text-muted">
          
        </div>
      </div>

    </div>

        <div class="col-md-2">
      
    </div>

  </div>
    
  </div>
  <!--   Core JS Files   -->
  <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>

</body>

</html>
