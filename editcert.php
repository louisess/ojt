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
session_start();  

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
$sql2 = "SELECT * FROM certificates WHERE certid = '".$_GET['certid']."'";
$row2 = $funObj->details($sql2);


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
    <div class="sidebar" data-color="white">
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
            <h3 class="description"><a href="../ojt/certs.php" title="Click to go back to account overview.">Certificates</a> / Edit certificates</h3>
          </div>

          <div class="row">
            <div class="col-md-12">

              <!-- events container -->
              <div class="card text-center">
                <div class="card-header">
                  <!--
                  <input type="button" class="btn btn-sm float-left smbtn" value="MY CERTIFICATES" name="answer" onclick="showCerts()"/>
                  <input type="button" href="#" class="btn btn-sm float-left smbtn" value="CREATE" name="answer" onclick="showDiv()"/>
                  -->
                </div>
                <div class="card-body">
                  <div id="createform"  style="display:block;" class="answer_list" >
                    <h5> EDIT CERTIFICATE </h5>
                    <p>
                      <i class="fas fa-asterisk"></i> Edit your certificates here.
                    </p>
                    <hr>
                    <?php
                    $cid = $_GET['certid'];
                    echo'
                    <form class="formrow" name="savecert" method="post" action="editcert.php?certid='.$cid.'">
                    <div class="row m-2">
                      <!---create cert form function--->';
                        
                         
                        if(isset($_POST['updatecert'])){
                          $orgid = $_SESSION['user'];  
                          $certid = $cid;
                          //echo $cid;
                          $eventname = $_POST['eventname']; 
                          $dayfrom = $_POST['dayfrom']; 
                          $dayto = $_POST['dayto']; 
                          $month = $_POST['month']; 
                          $year = $_POST['year'];
                          //$st = range(4,20);
                          //eventdate conditions:
                          

                          if($dayfrom == $dayto){
                            if($dayfrom == 1 || $dayfrom == 21 || $dayfrom == 31){
                              $eventdate = $_POST['dayfrom'].'st of '.$month.', '.$year;
                            }else if($dayfrom == 2 || $dayfrom == 22){
                              $eventdate = $_POST['dayfrom'].'nd of '.$month.', '.$year;
                            }else if($dayfrom == 3 || $dayfrom == 23){
                              $eventdate = $_POST['dayfrom'].'rd of '.$month.', '.$year;
                            }else{
                              $eventdate = $_POST['dayfrom'].'th of '.$month.', '.$year;
                            }
                          }else{
                            if($dayto == 1 || $dayto == 21 || $dayto == 31){
                              $eventdate = $_POST['dayfrom']. ' to ' .$_POST['dayto'].'st of '.$month.', '.$year;
                            }else if($dayto == 2 || $dayto == 22){
                              $eventdate = $_POST['dayfrom']. ' to ' .$_POST['dayto'].'nd of '.$month.', '.$year;
                            }else if($dayto == 3 || $dayto == 23){
                              $eventdate = $_POST['dayfrom']. ' to ' .$_POST['dayto'].'rd of '.$month.', '.$year;
                            }else{
                              $eventdate = $_POST['dayfrom']. ' to ' .$_POST['dayto'].'th of '.$month.', '.$year;
                            }
                          } 
                            
                          

                          $venue = $_POST['venue'];  
                          $organizer1 = $_POST['organizer1'] . ' - ' . $_POST['position1'];  
                          $organizer2 = $_POST['organizer2'] . ' - ' . $_POST['position2']; 
                          $organizer3 = $_POST['organizer3'] . ' - ' . $_POST['position3'];  


                          $updatecert = $funObj->updateCert($eventname, $eventdate, $venue, $organizer1, $organizer2, $organizer3, $certid, $orgid); 

                          if(!$updatecert){
                            //echo "sno";
                            echo "<script> unsuccesful </script>";

                          }else{
                            //echo "<script> succesful </script>";

                            echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
                              Nice!<strong> '.$eventname.'</strong> has been updated.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                          }

                            

                        }  
                        ?>
                      <div class="col-md-2">
                      </div>

                      <div class="col-md-8">
                         
                        <div class="form-group">
                          <h6><?php echo $row2['eventname']; ?> DETAILS</h6>

                          <label for="eventname">EVENT NAME</label>
                          <input type="text" class="form-control text-center" id="eventname" name="eventname" placeholder="" value="<?php echo $row2['eventname']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput2">DATE</label>
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
                                  *Date in the certificates will come out as <i>"1st of January, 2021"</i>
                                </p>
 
                            
                          </div>
                        </div>
                        <div class="form-group">
                          <?php 
                              $organizername1  = $row2['organizer1'];
                              $organizername2  = $row2['organizer2'];
                              $organizername3  = $row2['organizer3'];
                              $name = explode(" - ", $organizername1);                             
                              $name2 = explode(" - ", $organizername2);
                              $name3 = explode(" - ", $organizername3);
                               
                               
                          echo 
                        '<label for="venue">VENUE</label>
                          <input type="text" class="form-control text-center" id="venue" name="venue" placeholder="" value="'. $row2['venue'].'" required>
                        </div>
                        <div class="form-group">
                          <label for="hosts">HOSTS/ORGANIZERS</label>
                          <div class="row">
                            <div class="col-6">
                              <label>NAME</label>
                              <input type="text" class="form-control mb-2 text-center" id="organizer1" name="organizer1" value="'. $name[0].'" required>
                            </div>
                            <div class="col-6">
                              <label>POSITION</label>

                              <input type="text" class="form-control mb-2 text-center" id="position1" name="position1" placeholder=""'; 
                                if($name[1] == null){
                                  echo 'value=""';
                                }else{
                                   echo 'value="'.$name[1].'"';
                                }
                                echo '>
                            </div>                            
                            
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <label>NAME</label>
                              <input type="text" class="form-control text-center" id="organizer2" name="organizer2" placeholder=""';
                                if($name2[0] == null){
                                  echo 'value=""';
                                }else{
                                   echo 'value="'.$name2[0].'"';
                                }

                              echo '>
                            </div>
                            <div class="col-6">
                              <label>POSITION</label>

                              <input type="text" class="form-control mb-2 text-center" id="position2" name="position2" placeholder=""';
                                if($name2[1] == null){
                                  echo 'value=""';
                                }else{
                                   echo 'value="'.$name2[1].'"';
                                }
                              echo '>
                            </div>                            
                            
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <label>NAME</label>
                              <input type="text" class="form-control text-center" id="organizer3" name="organizer3" placeholder=""';
                                if($name3[0] == null){
                                  echo 'value=""';
                                }else{
                                   echo 'value="'.$name3[0].'"';
                                }

                              echo '>
                            </div>
                            <div class="col-6">
                              <label>POSITION</label>

                              <input type="text" class="form-control mb-2 text-center" id="position3" name="position3" placeholder=""';
                                if($name3[1] == null){
                                  echo 'value=""';
                                }else{
                                   echo 'value="'.$name3[1].'"';
                                }

                              echo '>
                            </div>                            
                            
                          </div>';
                          
                          
                          ?>
                          
                        </div>
                      </div>
                      <div class="col-md-2">
                        
                      </div>

                                        
                    </div>
                    <!--- end of row --->
                    <input type="submit" value="UPDATE" class="btn btn-sm smbtn btn-round" name="updatecert" title="Save you certificate details."/>
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