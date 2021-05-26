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
            <a class="navbar-brand">Hi, <b><?php echo $row['fname']; ?></b>!</a>
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
                          $department = $_POST['department'];
                          $title = $_POST['title'];
                          $description = $_POST['description'];
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
                            $organizer1 = $_POST['organizer1']. ' - ' .$_POST['position1'];  
                            $organizer2 = $_POST['organizer2']. ' - ' .$_POST['position2'];  
                            $organizer3 = $_POST['organizer3']. ' - ' .$_POST['position3'];  


                            $updatecert = $funObj->updateCert($eventname, $eventdate, $venue, $organizer1, $organizer2, $organizer3, $department, $title, $description, $certid); 

                            if(!$updatecert){
                              //echo "sno";
                              echo "<script> unsuccesful </script>";

                            }else{
                              //echo "<script> succesful </script>";
                              
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Nice!<strong> '.$eventname.'</strong> has been updated. Click <A style="color: white;" HREF="javascript:history.go(0)"><b>here</b></A> to refresh page.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                            }

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
                            $dbday1 = array_pad(explode("to", $row2['eventdate']), 2, null);
                            //echo $dbday1[0];
                              $day1tmp1 = array_pad(explode("rd", $dbday1[0]), 2, null);
                              $day1tmp2 = array_pad(explode("st", $dbday1[0]), 2, null);
                              $day1tmp3 = array_pad(explode("th", $dbday1[0]), 2, null);
                              $day1tmp4 = array_pad(explode("nd", $dbday1[0]), 2, null);

                              $dbday2 = array_pad(explode("of", $dbday1[1]), 2, null);
                              //$dbday2exp = array_pad(explode(",", $dbday1[0]), 2, null);
                              $day2tmp1 = array_pad(explode("th", $dbday2[0]), 2, null);
                              $day2tmp2 = array_pad(explode("st", $dbday2[0]), 2, null);
                              $day2tmp3 = array_pad(explode("nd", $dbday2[0]), 2, null);
                              $day2tmp4 = array_pad(explode("rd", $dbday2[0]), 2, null);

                              
                            if($dbday1[1] == null){
                              if(is_numeric($day1tmp1[0])){
                                $day1 = $day1tmp1[0];
                                $day2 = $day1;
                              }else if(is_numeric($day1tmp2[0])){
                                $day1 = $day1tmp2[0];
                                $day2 = $day1;
                              }else if(is_numeric($day1tmp3[0])){
                                $day1 = $day1tmp3[0];
                                $day2 = $day1;
                              }else{
                                $day1 = $day1tmp4[0];
                                $day2 = $day1;

                              }
                              $mnd = array_pad(explode(",", $dbday1[0]), 2, null);
                              $month = array_pad(explode("of ", $mnd[0]), 2, null);
                              $dbmnth = $month[1];
                              $dbyr = $mnd[1];
                              //echo $dbmnth;
                            }else{
                              //if date is within a range
                              
                              if(is_numeric($day2tmp1[0])){
                                $day1 = $day1tmp1[0];
                                $day2 = $day2tmp1[0];
                              }else if(is_numeric($day2tmp2[0])){
                                $day1 = $day1tmp2[0];
                                $day2 = $day2tmp2[0];
                              }else if(is_numeric($day2tmp3[0])){
                                $day1 = $day1tmp3[0];
                                $day2 = $day2tmp3[0];
                              }else{
                                $day1 = $day1tmp4[0];
                                $day2 = $day2tmp4[0];

                              }

                              $mnd = array_pad(explode(",", $dbday1[1]), 2, null);
                              $mndtmp = array_pad(explode("of ", $mnd[0]), 2, null);
                              $dbmnth = $mndtmp[1];
                              $dbyr = $mnd[1];
                              //echo $dbmnth;
                            }
                              
                           // echo $day2;
                            
                            //echo $mnd[1];
                        echo "<select name='dayfrom'>
                                <option value='1'"; if($day1 == '1'){
                                    echo "selected";
                                  }
                                  echo ">1</option>
                                <option value='2'"; if($day1 == '2'){
                                    echo "selected";
                                  }
                                  echo ">2</option>
                                <option value='3'"; if($day1 == '3'){
                                    echo "selected";
                                  }
                                  echo ">3</option>
                                <option value='4'"; if($day1 == '4'){
                                    echo "selected";
                                  }
                                  echo ">4</option>
                                <option value='5'"; if($day1 == '5'){
                                    echo "selected";
                                  }
                                  echo ">5</option>
                                <option value='6'"; if($day1 == '6'){
                                    echo "selected";
                                  }
                                  echo ">6</option>
                                <option value='7'"; if($day1 == '7'){
                                    echo "selected";
                                  }
                                  echo ">7</option>
                                <option value='8'"; if($day1 == '8'){
                                    echo "selected";
                                  }
                                  echo ">8</option>
                                <option value='9'"; if($day1 == '9'){
                                    echo "selected";
                                  }
                                  echo ">9</option>
                                <option value='10'"; if($day1 == '10'){
                                    echo "selected";
                                  }
                                  echo ">10</option>
                                <option value='11'"; if($day1 == '11'){
                                    echo "selected";
                                  }
                                  echo ">11</option>
                                <option value='12'"; if($day1 == '12'){
                                    echo "selected";
                                  }
                                  echo ">12</option>
                                <option value='13'"; if($day1 == '13'){
                                    echo "selected";
                                  }
                                  echo ">13</option>
                                <option value='14'"; if($day1 == '14'){
                                    echo "selected";
                                  }
                                  echo ">14</option>
                                <option value='15'"; if($day1 == '15'){
                                    echo "selected";
                                  }
                                  echo ">15</option>
                                <option value='16'"; if($day1 == '16'){
                                    echo "selected";
                                  }
                                  echo ">16</option>
                                <option value='17'"; if($day1 == '17'){
                                    echo "selected";
                                  }
                                  echo ">17</option>
                                <option value='18'"; if($day1 == '18'){
                                    echo "selected";
                                  }
                                  echo ">18</option>
                                <option value='19'"; if($day1 == '19'){
                                    echo "selected";
                                  }
                                  echo ">19</option>
                                <option value='20'"; if($day1 == '20'){
                                    echo "selected";
                                  }
                                  echo ">20</option>
                                <option value='21'"; if($day1 == '21'){
                                    echo "selected";
                                  }
                                  echo ">21</option>
                                <option value='22'"; if($day1 == '22'){
                                    echo "selected";
                                  }
                                  echo ">22</option>
                                <option value='23'"; if($day1 == '23'){
                                    echo "selected";
                                  }
                                  echo ">23</option>
                                <option value='24'"; if($day1 == '24'){
                                    echo "selected";
                                  }
                                  echo ">24</option>
                                <option value='25'"; if($day1 == '25'){
                                    echo "selected";
                                  }
                                  echo ">25</option>
                                <option value='26'"; if($day1 == '26'){
                                    echo "selected";
                                  }
                                  echo ">26</option>
                                <option value='27'"; if($day1 == '27'){
                                    echo "selected";
                                  }
                                  echo ">27</option>
                                <option value='28'"; if($day1 == '28'){
                                    echo "selected";
                                  }
                                  echo ">28</option>
                                <option value='29'"; if($day1 == '29'){
                                    echo "selected";
                                  }
                                  echo ">29</option>
                                <option value='30'"; if($day1 == '30'){
                                    echo "selected";
                                  }
                                  echo ">30</option>
                                <option value='31'"; if($day1 == '31'){
                                    echo "selected";
                                  }
                                  echo ">31</option>
                                </select>
                              To:";
                            
                            
                             
                              //$day2 = $dbday3[0];

                              //echo $day2;
                            
                              echo "<select name='dayto'>
                                      <option value='1'"; if($day2 == '1'){
                                    echo "selected";
                                  }
                                  echo ">1</option>
                                <option value='2'"; if($day2 == '2'){
                                    echo "selected";
                                  }
                                  echo ">2</option>
                                <option value='3'"; if($day2 == '3'){
                                    echo "selected";
                                  }
                                  echo ">3</option>
                                <option value='4'"; if($day2 == '4'){
                                    echo "selected";
                                  }
                                  echo ">4</option>
                                <option value='5'"; if($day2 == '5'){
                                    echo "selected";
                                  }
                                  echo ">5</option>
                                <option value='6'"; if($day2 == '6'){
                                    echo "selected";
                                  }
                                  echo ">6</option>
                                <option value='7'"; if($day2 == '7'){
                                    echo "selected";
                                  }
                                  echo ">7</option>
                                <option value='8'"; if($day2 == '8'){
                                    echo "selected";
                                  }
                                  echo ">8</option>
                                <option value='9'"; if($day2 == '9'){
                                    echo "selected";
                                  }
                                  echo ">9</option>
                                <option value='10'"; if($day2 == '10'){
                                    echo "selected";
                                  }
                                  echo ">10</option>
                                <option value='11'"; if($day2 == '11'){
                                    echo "selected";
                                  }
                                  echo ">11</option>
                                <option value='12'"; if($day2 == '12'){
                                    echo "selected";
                                  }
                                  echo ">12</option>
                                <option value='13'"; if($day2 == '13'){
                                    echo "selected";
                                  }
                                  echo ">13</option>
                                <option value='14'"; if($day2 == '14'){
                                    echo "selected";
                                  }
                                  echo ">14</option>
                                <option value='15'"; if($day2 == '15'){
                                    echo "selected";
                                  }
                                  echo ">15</option>
                                <option value='16'"; if($day2 == '16'){
                                    echo "selected";
                                  }
                                  echo ">16</option>
                                <option value='17'"; if($day2 == '17'){
                                    echo "selected";
                                  }
                                  echo ">17</option>
                                <option value='18'"; if($day2 == '18'){
                                    echo "selected";
                                  }
                                  echo ">18</option>
                                <option value='19'"; if($day2 == '19'){
                                    echo "selected";
                                  }
                                  echo ">19</option>
                                <option value='20'"; if($day2 == '20'){
                                    echo "selected";
                                  }
                                  echo ">20</option>
                                <option value='21'"; if($day2 == '21'){
                                    echo "selected";
                                  }
                                  echo ">21</option>
                                <option value='22'"; if($day2 == '22'){
                                    echo "selected";
                                  }
                                  echo ">22</option>
                                <option value='23'"; if($day2 == '23'){
                                    echo "selected";
                                  }
                                  echo ">23</option>
                                <option value='24'"; if($day2 == '24'){
                                    echo "selected";
                                  }
                                  echo ">24</option>
                                <option value='25'"; if($day2 == '25'){
                                    echo "selected";
                                  }
                                  echo ">25</option>
                                <option value='26'"; if($day2 == '26'){
                                    echo "selected";
                                  }
                                  echo ">26</option>
                                <option value='27'"; if($day2 == '27'){
                                    echo "selected";
                                  }
                                  echo ">27</option>
                                <option value='28'"; if($day2 == '28'){
                                    echo "selected";
                                  }
                                  echo ">28</option>
                                <option value='29'"; if($day2 == '29'){
                                    echo "selected";
                                  }
                                  echo ">29</option>
                                <option value='30'"; if($day2 == '30'){
                                    echo "selected";
                                  }
                                  echo ">30</option>
                                <option value='31'"; if($day2 == '31'){
                                    echo "selected";
                                  }
                                  echo ">31</option>
                                      </select>";
                            

                            echo '<br>

                              <label for="date" class="mr-2">Month</label> 
                              <select name="month">
                                <option value="January"';
                                if($dbmnth == 'January'){
                                  echo "selected";
                                }
                                echo '>January</option>
                                <option value="February"';
                                if($dbmnth == 'February'){
                                  echo "selected";
                                }
                                echo '>February</option>
                                <option value="March"
                                ';
                                if($dbmnth == 'March'){
                                  echo "selected";
                                }
                                echo '>March</option>
                                <option value="April"';
                                if($dbmnth == 'April'){
                                  echo "selected";
                                }
                                echo '>April</option>
                                <option value="May"';
                                if($dbmnth == 'May'){
                                  echo "selected";
                                }
                                echo '>May</option>
                                <option value="June"';
                                if($dbmnth == 'June'){
                                  echo "selected";
                                }
                                echo '>June</option>
                                <option value="July"';
                                if($dbmnth == 'July'){
                                  echo "selected";
                                }
                                echo '>July</option>
                                <option value="August"';
                                if($dbmnth == 'August'){
                                  echo "selected";
                                }
                                echo '>August</option>
                                <option value="September"';
                                if($dbmnth == 'September'){
                                  echo "selected";
                                }
                                echo '>September</option>
                                <option value="October"';
                                if($dbmnth == 'October'){
                                  echo "selected";
                                }
                                echo '>October</option>
                                <option value="November"';
                                if($dbmnth == 'November'){
                                  echo "selected";
                                }
                                echo '>November</option>
                                <option value="December"';
                                if($dbmnth == 'December'){
                                  echo "selected";
                                }
                                echo '>December</option>
                              </select>
                              <br>';

                              ?>
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

                          <label for="venue">VENUE</label>
                          <input type="text" class="form-control text-center" id="venue" name="venue" placeholder="" value="<?php echo $row2['venue'] ?>" required>
                          <br>

                           <div class="form-group">
                          <label for="department" >DEPARTMENT</label>
                          <br>
                          <select name="department" required>
                            <option value="School of Business Administration and Accountancy" 
                            <?php if($row2['department']=="School of Business Administration and Accountancy") echo 'selected';?>>School of Business Administration and Accountancy</option>
                            <option value="School of Criminal Justice and Public Safety"
                            <?php if($row2['department']=="School of Criminal Justice and Public Safety") echo 'selected';?>>School of Criminal Justice and Public Safety</option>
                            <option value="School of Engineering and Architecture"
                            <?php if($row2['department']=="School of Engineering and Architecture") echo 'selected';?>>School of Engineering and Architecture</option>
                            <option value="School of Information Technology"
                            <?php if($row2['department']=="School of Information Technology") echo 'selected';?>>School of Information Technology</option>
                            <option value="School of International Hospitality and Tourism Management"
                            <?php if($row2['department']=="School of International Hospitality and Tourism Management") echo 'selected';?>>School of International Hospitality and Tourism Management</option>
                            <option value="School of Law"
                            <?php if($row2['department']=="School of Law") echo 'selected';?>>School of Law</option>
                            <option value="School of Nursing" <?php if($row2['department']=="School of Nursing") echo 'selected';?>>School of Nursing</option>
                            <option value="School of Natural Sciences"
                            <?php if($row2['department']=="School of Natural Sciences") echo 'selected';?>>School of Natural Sciences</option>
                            <option value="School of Teacher Education and Liberal Arts"<?php if($row2['department']=="School of Teacher Education and Liberal Arts") echo 'selected';?>>School of Teacher Education and Liberal Arts</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="title">TITLE</label>
                          <input type="text" class="form-control text-center" value="<?php echo $row2['title'] ?>" id="title" name="title" placeholder="" required>
                          <p>*Certificate of Attendance/Participation</p>
                        </div>
                        
                        <div class="form-group">
                          <label for="description">DESCRIPTION</label>
                         <textarea class="form-control" id="description" name="description" rows="3"><?php
                         $value = $row2['description']; echo htmlspecialchars($value); ?></textarea>
                        </div>


                          <label for="hosts">HOSTS/ORGANIZERS</label>
                          <div class="row">
                            <div class="col-6">
                              <label>NAME</label>
                              <?php
                                $organizername1 = array_pad(explode(" - ", $row2['organizer1']), 2, null);
                                $organizername2 = array_pad(explode(" - ", $row2['organizer2']), 2, null);
                                $organizername3 = array_pad(explode(" - ", $row2['organizer3']), 2, null);
                                //$organizername1 = $row2['organizer1']; list($organizer1, $position1) = explode(" - ", $organizername1);
                                //$organizername2 = $row2['organizer2']; list($organizer2, $position2) = explode(" - ", $organizername2);
                                //$organizername3 = $row2['organizer3']; list($organizer3, $position3) = explode(" - ", $organizername3);

                               echo '
                              <input type="text" class="form-control mb-2 text-center" id="organizer1" name="organizer1" value="'. $organizername1[0] .'" required>
                            </div>
                            <div class="col-6">
                              <label>POSITION</label>
                              <input type="text" class="form-control mb-2 text-center" id="position1" name="position1" value="'.$organizername1[1].'" required>

                            </div>
                          </div>
                          <div class = "row">
                            <div class="col-6">
                              <label>POSITION</label>
                              <input type="text" class="form-control mb-2 text-center" id="organizer2" name="organizer2" value="'.$organizername2[0].'">

                            </div>
                            <div class="col-6">
                              <label>TITLE</label>
                              <input type="text" class="form-control mb-2 text-center" id="position2" name="position2" value="'.$organizername2[1].'">

                            </div>
                          </div>

                          <div class = "row">
                            <div class="col-6">
                              <label>NAME</label>
                              <input type="text" class="form-control mb-2 text-center" id="organizer2" name="organizer3" value="'.$organizername3[0].'">

                            </div>
                            <div class="col-6">
                              <label>POSITION</label>
                              <input type="text" class="form-control mb-2 text-center" id="position2" name="position3" value="'.$organizername3[1].'">

                            </div>
                          </div    

                          </div>
                           <input type="submit" value="UPDATE" class="btn btn-sm smbtn btn-round" name="updatecert" title="Save you certificate details."/>
                        </div>';

                        ?> 
                       

                                        
                    </div>
                    <!--- end of row --->

                   
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
