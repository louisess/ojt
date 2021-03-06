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
        <a href="certs.php" class="simple-text logo-normal">
          
          <div>
            <img src="assets/img/logo.png">
          </div>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="certs.php">
              <i class="fas fa-certificate"></i>
              <p>Certificates</p>
            </a>
          </li>

          <li>
            <a href="account.php">
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
            <h3 class="description"><a href="certs.php" title="Click to go back to account overview.">Certificates</a> / Your certificates</h3>
          </div>

          <div class="row">
            <div class="col-md-12">

              <!-- events container -->
              <div class="card text-center">
                <div class="card-header">
                    <a type="button" class="btn btn-sm btn-primary" href="certs.php"><i class="fas fa-arrow-circle-left"></i> GO BACK</a> 
                  <!--
                  <input type="button" class="btn btn-sm float-left smbtn" value="MY CERTIFICATES" name="answer" onclick="showCerts()"/>
                  <input type="button" href="#" class="btn btn-sm float-left smbtn" value="CREATE" name="answer" onclick="showDiv()"/>
                  -->
                </div>
                <div class="card-body">
                 <div id="certlist" style="display: block;" class="answer_list" >
                  <h5>YOUR CERTIFICATES</h5>
                  <p>
                    <i class="fas fa-asterisk"></i> A list of your saved certificates for events.
                  </p>
                  <?php
                  

                   
                        
                        if(isset($_POST['deletecert'])){
                            $certid = $_POST['certid'];
                            $certname = $_POST['eventname'];
                            $deleteCert = $funObj->deleteCert($certid);
                            
                            if($deleteCert){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Deleted seminar: '. $certname .'
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>';
                            }else{
                                echo "error";
                            }
                            }
                            if (isset($_POST["setexpdate"])){
                                $certid = $_POST['certid'];
                                $expdate = ($_POST['expdate']);
                                $certname = ($_POST['eventname']);
                                //$expdate = date("m-d-Y", strtotime($date1));;
                                
                                $setExpDate = $funObj->setExpLink($expdate,$certid);
                                if($setExpDate){
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> Set link expiry: '. $expdate .' for '. $certname .'
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>';
                                }else{
                                    echo "error";
                                }
                                
                            }
                            
                            if (isset($_POST["cleardt"])){
                                $certid = $_POST['certid'];
                                $expdate = '0000-00-00';
                                $certname = ($_POST['eventname']);
                                //$expdate = date("m-d-Y", strtotime($date1));;
                                
                                $setExpDate = $funObj->clrDate($expdate,$certid);
                                if($setExpDate){
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> Set link expiry: '. $expdate .' for '. $certname .'
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>';
                                }else{
                                    echo "error";
                                }
                                
                            }
                                    
                            $id =  $_SESSION['user'];
                            //$sql2 = "SELECT * FROM certificates WHERE orgid = '".$_SESSION['user']."'";
                            $cert = $funObj->viewCerts($id);
                            //$stmt=$client->viewClients();

                            $count =  $cert->rowCount();
                            
                            
                            
                            echo '<hr>';
                            if(!$cert){
                              echo "<label> There are no certificates here... </label>";
                            }else{
                              echo ' <div id="accordion">
                                        <table class="table table-hover text-custom">
                                        <thead class="text-custom">
                                        <tr>
                                          <th scope="col">EVENT NAME</th>
                                          <th scope="col">DATE</th>
                                          <th scope="col">VENUE</th>
                                          <th scope="col"></th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                              while ($certrow = $cert->fetch(PDO::FETCH_ASSOC)) {
                                extract($certrow);
                                echo ' <tr data-toggle="collapse" data-target="#collapse'.$certrow['certid'].'" class="collapse-row collapsed accordion-toggle" title="??? Click row for details">
                          
                                <td>'.$certrow['eventname'].'</td>';
                                echo '<td>'.$certrow['eventdate'].'</td>';
                                echo '<td>'.$certrow['venue']. '<td>';
                                echo '<td colspan="2">
                            
                            <form class="form-inline" method="get" target="_blank" action="generatepdftry.php">
                            <input type="hidden" id="certid" name="certid" value="'.$certrow['certid'].'">
                              <button type="submit" id="pdf_report_generate" name="pdf_report_generate" class="btn btn-primary" href="generatepdftry.php?certid='.$certrow['certid'].'"><i class="fa fa-pdf"" aria-hidden="true"></i>
                              Preview Certificate</button>
                              </form>
                           
                          </td>
                        </tr>
                        <div id="collapse'.$certrow['certid'].'" class="accordion-body collapse in">
                        <tr>
                          <!----------WHERE DETAILS APPEAR------------->
                            <td colspan="4">
                              <table class="table table-borderless">
                                <tbody>
                                <tr> 
                                    <td>  <a href="editcert.php?certid='.$certrow['certid'].'" id="certid"  name="editcert" class="btn btn-primary btn-sm"><i class="fa fa-pdf"" aria-hidden="true"></i> 
                                      <i class="fas fa-edit"></i> Edit Details </a> </td>  
                                </tr> 
                                  <tr>
                                    <th scope="col">EVENT NAME</th>
                                    <td>'.$certrow['eventname'].'</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">DATE</th>
                                    <td>'.$certrow['eventdate'].'</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">VENUE</th>
                                    <td>'.$certrow['venue']. '</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">DEPARTMENT</th>
                                    <td>'.$certrow['department']. '</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">CERTIFICATE TITLE</th>
                                    <td>'.$certrow['title']. '</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">CERTIFICATE DESCRIPTION</th>
                                    <td>'.$certrow['description']. '</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">ORGANIZER/S OR SIGNATORIES</th>

                                    <td>'.$certrow['organizer1']. '<br>'
                                    .$certrow['organizer2'].'<br>'
                                    .$certrow['organizer3'].'
                                    </td>
                                  </tr>

                                  <tr>
                                    <th scope="row">SIGNATORY IMAGES</th>';
                                    
                                    if ($certrow['signatory1'] == ' ' && $certrow['signatory2'] == ' ' && $certrow['signatory3'] == ' '){
                                    
                                     echo '<td>No signatory uploaded. Upload <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>.
                                      </td>';

                                    }else if($certrow['signatory1'] != null && $certrow['signatory2'] == ' ' && $certrow['signatory3'] == ' '){
                                      echo '
                                      <td><img width="200px" height="80px" src="uploads/'.$certrow['signatory1'].'"/> <br>                                  
                                      Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                      </td>

                                      ';
                                    }else if($certrow['signatory1'] != null && $certrow['signatory2'] != null && $certrow['signatory3'] == ' '){
                                      echo '<td><img width="200px" height="80px" src="uploads/'.$certrow['signatory1'].'"/> <br>                                  
                                        Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                      </td>
                                      <br>
                                      <img width="200px" height="80px" src="uploads/'.$certrow['signatory2'].'"/>
                                      <br>                                  
                                     
                                      </td>';
                                    }else if($certrow['signatory1'] != null && $certrow['signatory2'] != null && $certrow['signatory3'] != null){
                                      echo '<td><img width="200px" height="80px" src="uploads/'.$certrow['signatory1'].'"/> <br>                                  
                                     
                                      </td>
                                      <br>
                                      <img width="200px" height="80px" src="uploads/'.$certrow['signatory2'].'"/>                                      
                                                                       
                                      <br>
                                      <img width="200px" height="80px" src="uploads/'.$certrow['signatory3'].'"/>
                                      
                                        Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                      </td>
                                      
                                      ';
                                    }
                                    
                                  echo '</tr>
                                  
                                    <tr>
                                    <th scope="row">LOGOS</th>';
                                    
                                    if($certrow['logo1'] == ' ' && $certrow['logo2'] == ' ' && $certrow['logo3'] == ' '){
                                      echo '<td>No logo uploaded. Upload <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>.
                                      </td>';
                                        
                                    }else if($certrow['logo1'] != null && $certrow['logo2'] == ' ' && $certrow['logo3'] == ' '){
                                      echo '<td><img width="200px" height="80px" src="uploads/'.$certrow['logo1'].'"/> <br>                                  
                                         Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                      </td>

                                      ';
                                    }else if($certrow['logo1'] == ' ' && $certrow['logo2'] != null && $certrow['logo3'] == ' '){
                                         echo '<td><img width="200px" height="80px" src="uploads/'.$certrow['logo2'].'"/> <br>                                  
                                      Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                      </td>';
                                    }else if($certrow['logo1'] != null && $certrow['logo2'] != null && $certrow['logo3'] == ' '){
                                      echo '<td><img width="200px" height="80px" src="uploads/'.$certrow['logo1'].'"/> <br>                                  
                                      Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                      </td>
                                      <br>
                                      <img width="200px" height="80px" src="uploads/'.$certrow['logo2'].'"/>
                                      <br>                                  
                                     
                                      </td>';
                                    }else if($certrow['logo1'] == ' ' && $certrow['logo2'] == ' ' && $certrow['logo3'] != null){
                                         echo '<td><img width="200px" height="80px" src="uploads/'.$certrow['logo3'].'"/> <br>                                  
                                      Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                      </td>';
                                    }else if($certrow['logo1'] != null && $certrow['logo2'] != null && $certrow['logo3'] != null){
                                      echo '<td><img width="200px" height="80px" src="uploads/'.$certrow['logo1'].'"/>                                  
                                      <br>
                                      <img width="200px" height="80px" src="uploads/'.$certrow['logo2'].'"/>                                      
                                                                       
                                      <br>
                                      <img width="200px" height="80px" src="uploads/'.$certrow['logo3'].'"/>
                                      <br>                                  
                                      Re-upload signatory images and logo <a href="uploadimgs.php?certid='.$certrow['certid'].'">here</a>
                                                                       
                                      </td>
                                      
                                      
                                      ';
                                    }
                                   
                                    
                                  echo '</tr>
                                  
                                  <tr>
                                    <th scope="row">REGISTRATION LINK</th>
                                    <td>
                                    <input type="text" id="participants" name="participants" value="localhost.000webhostapp.com/participantsform.php?certid='.$certrow['certid'].'" readonly>
                                    <label>Double click to highlight.</label>
                                    <hr>
                                    ';
                                        $nodt = '0000-00-00';
                                        $dispdate = date( "m-d-Y" , strtotime( $certrow['expdate'] ));
                                        if ($certrow['expdate'] == $nodt){
                                            echo "<p><i> No date set </i></p>";
                                        }else{
                                           echo "<p>
                                            Date set for expiry: ".$dispdate."</p>";
                                        }
                                    
                                    
                                    echo '<form action="viewcerts.php" method="POST">
                                      <label for="expdate">Set link expiry:</label>
                                      <br>
                                      <input type="hidden" id="'.$certrow['certid'].'" value="'.$certrow['certid'].'" name="certid">
                                      <input type="hidden" id="'.$certrow['eventname'].'" value="'.$certrow['eventname'].'" name="eventname">
                                      <input type="date" id="expdate" name="expdate">
                                      <input type="submit" class="btn btn-sm" value="Set" name="setexpdate">';
                                      if ($certrow['expdate'] !== $nodt){
                                          echo '<input type="submit" class="btn btn-sm ml-1" value="Clear Date" name="cleardt"></form>';
                                      }else{
                                          echo '</form>';
                                      }
                                    echo '
                                    
                                    
                                    <a href="viewparticipants.php?certid='.$certrow['certid'].'" id="certid"  name="viewparticipants" class="btn btn-primary btn-sm"><i class="fa fa-pdf"" aria-hidden="true"></i> 
                                      <i class="fas fa-edit"></i> View Registered Participants </a>
                                    </td>
                                  </tr>
                                  
                                   <tr>
                                    <td >
                                    <form name="deleterow" method="POST" action="viewcerts.php">
                                        <input type="hidden" id="certid" name="certid" value="'.$certrow['certid'].'" readonly>
                                        <input type="hidden" id="eventname" name="eventname" value="'.$certrow['eventname'].'" readonly>
                                        <input type="submit" id="certid" value="Delete event"  name="deletecert" class="btn btn-danger btn-sm" style="background-color: #d9534f !important; "  >
                                        </td>
                                    </form>
                                  </tr>
                                  

                                  
                                </tbody>
                              </table>
                                
                            </td>
                            <!----------END OF DETAILS------------->
                        </tr>';

                              }

                        echo '</div>
                         </tbody>
                    </table>
                    </div>';                                    
                        
                        }
                          ?>


                   

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
