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

$certid = $_GET['certid'];
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
              <p>
                <?php
                  //echo $certid;
                  $cert = $funObj->certName($certid);
                  echo "<b>Seminar: </b>".$cert['eventname'];
                ?>
              </p>
              <form id="addParticipants" action="participantsform.php" method="post">
                <div class="form-group">
                  <label for="formGroupExampleInput">NAME</label>
                  <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Juan dela Cruz">
                </div>

                <div class="form-group">
                  <label for="formGroupExampleInput2">EMAIL</label>
                  <input type="email" name="email" class="form-control" id="formGroupExampleInput2" placeholder="jdl@gmail.com">
                </div>


                <!--
                <div class="form-group">
                  <label for="formGroupExampleInput2">CONFIRM EMAIL</label>
                  <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="jdl@gmail.com">
                </div>
              -->
              <input type="submit" class="btn btn-primary" value="Submit">
              <?php
                if(isset($_POST['createcert'])){
                  $orgid = $_SESSION['user'];  
                  $eventname = $_POST['eventname']; 
                  $day = $_POST['day']; 
                  $month = $_POST['month']; 
                  $year = $_POST['year'];
                  //$st = range(4,20);
                  //eventdate conditions:
                  
                    if($day == 1 || $day == 21 || $day == 31){
                      $eventdate = $_POST['day'].'st of '.$month.', '.$year;
                    }else if($day == 2 || $day == 22){
                      $eventdate = $_POST['day'].'nd of '.$month.', '.$year;
                    }else if($day == 3 || $day == 23){
                      $eventdate = $_POST['day'].'rd of '.$month.', '.$year;
                    }else{
                      $eventdate = $_POST['day'].'th of '.$month.', '.$year;
                    }
                  

                  $venue = $_POST['venue'];  
                  $organizer1 = $_POST['organizer1'];  
                  $organizer2 = $_POST['organizer2'];  
                  $organizer3 = $_POST['organizer3'];  


                  $savecert = $funObj->createCert($eventname, $eventdate, $orgid, $venue, $organizer1, $organizer2, $organizer3); 

                  if(!$savecert){
                    //echo "sno";
                    echo "<script> unsuccesful </script>";

                  }else{
                    //echo "<script> succesful </script>";
                    echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
                      Nice!<strong> '.$eventname.'</strong> has been added to your events.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
                  }

                      

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