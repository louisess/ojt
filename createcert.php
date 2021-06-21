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


if (!isset($_SESSION['user'])){
  header('location:index.php');
}

$database = new Database();
$db = $database->getConnection();

//session_start();

// check user login
//$user = new User();
$funObj = new dbFunction($db); 

$sql = "SELECT * FROM organizers WHERE id = '".$_SESSION['user']."'";
$row = $funObj->details($sql);

?>


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
  <div class="wrapper ">
    <div class="sidebar" data-color="black">
      <div class="logo">
        <a href="/" class="simple-text logo-normal">
          
          <div>
            <img src="../ojt/assets/img/logo.png">
          </div>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="../ojt/certs.php">
              <i class="fas fa-certificate"></i>
              <p>Certificates</p>
            </a>
          </li>

          <li>
            <a href="../ojt/account.php">
              <i class="far fa-user-circle"></i>
              <p>Account</p>

            </a>
          </li>

          <li>
            <a href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
              <p>Log out</p>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Hi, <b><?php echo $row['fname']; ?></b>!</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
          <!-- serts
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
          -->
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <h3 class="description"><a href="../ojt/certs.php" title="Click to go back to account overview.">Certificates</a> / Create certificates</h3>
          </div>

          <div class="row">
            <div class="col-md-12">

              <!-- events container -->
              <div class="card text-center">
                <div class="card-header">
                    <a type="button" class="btn btn-sm btn-primary" href="/ojt/certs.php"><i class="fas fa-arrow-circle-left"></i> GO BACK</a> 
                  <!--
                  <input type="button" class="btn btn-sm float-left smbtn" value="MY CERTIFICATES" name="answer" onclick="showCerts()"/>
                  <input type="button" href="#" class="btn btn-sm float-left smbtn" value="CREATE" name="answer" onclick="showDiv()"/>
                  -->
                </div>
                <div class="card-body">
                  <div id="createform"  style="display:block;" class="answer_list" >
                      
                    <h5> CREATE CERTIFICATE </h5>
                    <p>
                      <i class="fas fa-asterisk"></i> Add details about your event/seminar and create a certificate to be generated.
                    </p>
                    <div class="alert alert-secondary" role="alert" style="color:black;">
                     <small>Note: When entering your data in the boxes, substitute the character (') with (`).</small>
                    </div>
                    <hr>
                    <!--<form id="uploadForm" action="createcert.php" method="post"></form>-->
                    <form class="formrow" name="createcert" method="POST" action="createcert.php">
                    <div class="row m-2">
                      <!---create cert form function--->
                        <?php
                        if(isset($_POST['createcert'])){
                         
                          $orgid = $_SESSION['user'];  
                          $eventname = $_POST['eventname']; 
                          $dayfrom = $_POST['dayfrom']; 
                          $dayto = $_POST['dayto']; 
                          $month = $_POST['month']; 
                          $year = $_POST['year'];
                          $department = $_POST['department'];
                          $title = $_POST['title'];
                          $description = $_POST['description'];
                          $recognition = $_POST['recognition'];
                          $presentationline = $_POST['presentationline'];
                          //$description = $_POST['description'];
                          $singleqt = "'";
                          

                          
                          //$st = range(4,20);
                          //eventdate conditions:
                          if($dayfrom > $dayto){
                             echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Oops. Please choose a later day for your end date.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                          }else{
                            if($dayfrom == $dayto){
                                $eventdate = $month. ' ' .$_POST['dayfrom']. ', '.$year;
                            }else{
                                $eventdate = $month. ' ' .$_POST['dayfrom']. ' to '.$_POST['dayto'] .', '.$year;
                            } 
                            
                          

                          $venue = $_POST['venue'];  
                          $organizer1 = $_POST['organizer1'] . ' - ' . $_POST['position1'];  
                          $organizer2 = $_POST['organizer2'] . ' - ' . $_POST['position2']; 
                          $organizer3 = $_POST['organizer3'] . ' - ' . $_POST['position3'];
                          $signatory1 = ' ';
                          $signatory2 = ' ';
                          $signatory3 = ' ';
                          $logo1 = ' ';
                          $logo2 = ' ';
                          $logo3 = ' ';
                          $expdate = '0000-00-00';
                        
                            
                            
                        if (htmlentities(strpos($eventname, "'")) == TRUE || htmlentities(strpos($title, "'")) == TRUE || htmlentities(strpos($description, "'")) == TRUE || htmlentities(strpos($venue, "'")) == TRUE || htmlentities(strpos($department, "'")) == TRUE || htmlentities(strpos($recognition, "'")) == TRUE || htmlentities(strpos($presentationline, "'")) == TRUE){
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Oops. Please replace your single quote with "`".
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                        }else{
                          if(strlen($description) > 255){
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Oops! Your description is too long.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                        }else{
                            $savecert = $funObj->createCert($eventname, $eventdate, $orgid, $venue, $organizer1, $organizer2, $organizer3, $signatory1, $signatory2, $signatory3, $department, $title, $description, $recognition, $presentationline, $logo1, $logo2, $logo3, $expdate); 


                            
                                                    
                          if(!$savecert){
                            //echo "sno";
                            echo "<script> unsuccesful </script>";

                          }else{
                              
                              
                            //echo "<script> succesful </script>";
                            
                            $id = $orgid;
                            $cert = $funObj->viewCertsForUpload($id, $eventdate, $venue, $eventname);
                            $count =  $cert->rowCount();
                            $certrow = $cert->fetch(PDO::FETCH_ASSOC);
                            extract((array)$certrow);

                            echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
                              Nice!<strong> '.$eventname.'</strong> has been added to your events.Upload your logos and signatories <a style="color: white;" href="uploadimgs.php?certid='.$certrow['certid'].'"><b>here</b></a>.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                            
                            
                          }
                                
                            }
                                                        

                        } 
                          
                        

                          
                          }
                          

                            

                        }  
                        ?>
                      <div class="col-md-2">
                      </div>

                      <div class="col-md-8">
                         
                        <div class="form-group">
                          <h5>EVENT DETAILS</h5>

                          <div class="form-group mb-3">
                            <h6 for="department">➀ DEPARTMENT</h6>
                            
                            <input type="text" class="form-control text-center" id="department" name="department" required>
                            <label>ex. <i>(School of Information Technology)</i></label>
                          </div>


                          <div class="form-group mb-3">
                            <h6 for="title">➁ TITLE</h6>
                            <input type="text" class="form-control text-center" id="title" name="title" placeholder="" required>
                            <label>ex. <i>(Certificate of Attendance/Participation)</i></label>
                          </div>

                          <div class="form-group mb-3">
                            <h6 for="presentationline">➂ PRESENTATION LINE</h6>
                            <input type="text" class="form-control text-center" id="presentationline" name="presentationline" placeholder="" required>
                            <label>ex. <i>(is awarded to)</i></label>
                          </div>

                          <div class="form-group mb-3">
                            <h6 for="recognition">➃ RECOGNITION</h6>
                            <input type="text" class="form-control text-center" id="recognition" name="recognition" placeholder="" required>
                            <label>ex. <i>(for actively participating in...)</i></label>
                          </div>

                          <div class="form-group mb-3">
                            <h6 for="eventname">➄ EVENT NAME</h6>
                            <input type="text" class="form-control text-center" id="eventname" name="eventname" required>
                              
                          </div>

                          <div class="form-group mb-3">
                            <h6 for="department">➆ DESCRIPTION</h6>
                           <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                           <label>Short message or description about the certificate.</label>
                          </div>

                          
                          
                        <div class="form-group mb-3">
                          <h6 for="formGroupExampleInput2">➇ DATE</h6>
                          <div class="md-form">
                            <!--
                            <input type="date" id="eventdate" name="eventdate" class="form-control text-center">
                          -->
                            <label for="date" class="mr-2">Day</label> 
                            From:
                            <?php
                              echo "<select name='dayfrom'>";
                              for ($day = 1; $day <= 31; $day++) {
                                echo "<option value=".$day.">$day<br></option>";
                              }
                              echo "</select>";
                            ?>
                            To:

                            <?php
                              echo "<select name='dayto'>";
                              for ($day = 1; $day <= 31; $day++) {
                                echo "<option value=".$day.">$day<br></option>";
                              }
                              echo "</select>";
                            ?>

                            <br>

                              <label for="date" class="mr-2">Month</label> 
                              <select name="month">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                              </select>
                              <br>

                              <label for="date" class="mr-2">Year</label> 
                                <?php
                                  echo "<select name='year'>";
                                  for ($year = 2021; $year <= 2035; $year++) {
                                    echo "<option value=$year>$year<br></option>";
                                  }
                                  echo "</select>";
                                ?>
                                <p>
                                  Date in the certificates will come out as <i>"1st of January, 2021"</i>
                                </p>
 
                            
                          </div>
                        </div>

                        <div class="form-group mb-3">
                          <h6 for="venue">➈ VENUE</h6>
                          <input type="text" class="form-control text-center" id="venue" name="venue" placeholder="" required>
                        </div>
                        
                        
                        
                        
                        <div class="form-group mb-3">
                          <h6 for="hosts">➉ CERTIFICATE SIGNATORIES</h6>
                          <div class="row">
                            <div class="col-6">
                              <label>SIGNATORY NAME</label>
                              <input type="text" class="form-control mb-2 text-center" id="organizer1" name="organizer1" value="<?php echo $row['fname'].' '.$row['lname']; ?>" required>
                            </div>
                            <div class="col-6">
                              <label>SIGNATORY TITLE</label>

                              <input type="text" class="form-control mb-2 text-center" id="position1" name="position1" placeholder="" required>
                            </div>                            
                            
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <label>SIGNATORY NAME</label>
                              <input type="text" class="form-control text-center" id="organizer2" name="organizer2" placeholder="">
                            </div>
                            <div class="col-6">
                              <label>SIGNATORY TITLE</label>

                              <input type="text" class="form-control mb-2 text-center" id="position2" name="position2" placeholder="">
                            </div>                            
                            
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <label>SIGNATORY NAME</label>
                              <input type="text" class="form-control text-center" id="organizer3" name="organizer3" placeholder="">
                            </div>
                            <div class="col-6">
                              <label>SIGNATORY TITLE</label>

                              <input type="text" class="form-control mb-2 text-center" id="position3" name="position3" placeholder="">
                            </div>                            
                            
                          </div>
                          
                          
                          
                          
                        </div>
                      </div>
                      <div class="col-md-2">
                        
                      </div>
                      <!--
                      <div class="col-6">
                        <div class="form-group">
                          <h6>CERTIFICATE DETAILS</h6>
                          <p>
                            LOGO:
                            <br>
                            <label>Upload Logo1</label>
                             <input type="file" class="form-control" id="logo1" name="logo2" accept="image/x-png,image/gif,image/jpeg" />

                            
                          </p>
                          <p>
                            SIGNATORY:
                            <br>
                            <label>Upload Signatory1</label>
                             <input type="file" class="form-control" id="signatory1" name="signatory1" accept="image/x-png,image/gif,image/jpeg" />

                            
                          </p>

                         

                        </div>

                      
                      </div>

                      -->

                                        
                    </div>
                    <!--- end of row --->
                    <div class="form-group">
                      <input type="submit" value="SAVE CERTIFICATE" class="btn btn-sm smbtn btn-round" name="createcert" title="Save you certificate details."/>

                    </div>
                    </form>
                    <hr>
                        

                       
                      </div>

                  </div>

                  

                <div class="card-footer text-muted">
                  
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!--   Core JS Files   -->
  <!-- JavaScript Bundle with Popper -->
  <script type="text/javascript">
    $('.collapse').on('show.bs.collapse', function () {
      $('.collapse.in').collapse('hide');
    });

    /*
    function showCerts() {
       document.getElementById('certlist').style.display = "block";
       document.getElementById('createform').style.display = "none";
    }
    function showDiv() {
       document.getElementById('createform').style.display = "block";
       document.getElementById('certlist').style.display = "none";
    }
    

  </script>
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
