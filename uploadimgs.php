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
            <h3 class="description"><a href="certs.php" title="Click to go back to account overview.">Certificates</a> / Create certificates</h3>
          </div>

          <div class="row">
            <div class="col-md-12">

              <!-- events container -->
              <div class="card text-center">
                <div class="card-header">
                    <?php

                        $certid = $_GET['certid'];
                        echo '
                     <a type="button" class="btn btn-sm btn-primary" href="editcert.php?certid='.$certid.'"><i class="fas fa-arrow-circle-left"></i> GO BACK</a> 
                  <!--
                  <input type="button" class="btn btn-sm float-left smbtn" value="MY CERTIFICATES" name="answer" onclick="showCerts()"/>
                  <input type="button" href="#" class="btn btn-sm float-left smbtn" value="CREATE" name="answer" onclick="showDiv()"/>
                  -->
                </div>
                <div class="card-body">
                  <div id="createform"  style="display:block;" class="answer_list" >
                    <h5> CREATE CERTIFICATE </h5>
                    <p>
                      <i class="fas fa-asterisk"></i> Upload your signatories here.
                    </p>
                    <hr>';
                     
                        $row = $funObj->certName($certid);
                            $target_dir = "uploads/";


                        //echo dirname(__FILE__);
                        
                        //echo "<p><b>Seminar: </b>".$row['eventname'];
                        
                        if(isset($_POST['upload1'])){
                            //$target_dir = "uploads/";

                          if(isset($_FILES['signatory1'])){
                              $signatory1 = $_FILES["signatory1"]["name"];
                              $signatorytmp = $_FILES["signatory1"]["tmp_name"];
                              $success1 = '';
                              $success2 = '';
                              $success3 = '';
                              $success4 = '';
                              $success5 = '';
                              $success6 = '';
                             

                              if (move_uploaded_file($signatorytmp,$target_dir.$signatory1)) {
                                $success1 = true; 
                                $upload = $funObj->upload1($signatory1, $certid); 
                                
                              }else{
                                echo  "<script>Image not uploaded.</script>";
                              }

                              

                              if(isset($_FILES['signatory2'])){
                                $signatory2 = $_FILES["signatory2"]["name"];
                              $signatorytmp = $_FILES["signatory2"]["tmp_name"];

                                if (move_uploaded_file($signatorytmp,$target_dir.$signatory2)) {
                                  $success2 = true; 
                                  $upload = $funObj->upload2($signatory2, $certid); 
                                  
                                }else{
                                  echo  "<script>Image not uploaded.</script>";
                                }
                              }

                             

                              if(isset($_FILES['signatory3'])){
                                $signatory3 = $_FILES["signatory3"]["name"];
                                $signatorytmp = $_FILES["signatory3"]["tmp_name"];
                                if (move_uploaded_file($signatorytmp,$target_dir.$signatory3)) {
                                  $success3 = true; 
                                  $upload = $funObj->upload3($signatory3, $certid); 
                                  
                                }else{
                                  echo  "<script>Image not uploaded.</script>";
                                }
                              }
                              
                              if(isset($_FILES['logo1'])){
                                $logo1 = $_FILES["logo1"]["name"];
                                $logotmp = $_FILES["logo1"]["tmp_name"];
                                if (move_uploaded_file($logotmp,$target_dir.$logo1)) {
                                  $success4 = true; 
                                  $upload4 = $funObj->upload4($logo1, $certid); 
                                  
                                }else{
                                  echo  "<script>Image not uploaded.</script>";
                                }
                              }
                              
                              if(isset($_FILES['logo2'])){
                                $logo2 = $_FILES["logo2"]["name"];
                                $logotmp = $_FILES["logo2"]["tmp_name"];
                                if (move_uploaded_file($logotmp,$target_dir.$logo2)) {
                                  $success5 = true; 
                                  $upload5 = $funObj->upload5($logo2, $certid); 
                                  
                                }else{
                                  echo  "<script>Image not uploaded.</script>";
                                }
                              }
                              
                              if(isset($_FILES['logo3'])){
                                $logo3 = $_FILES["logo3"]["name"];
                                $logotmp = $_FILES["logo3"]["tmp_name"];
                                if (move_uploaded_file($logotmp,$target_dir.$logo3)) {
                                  $success6 = true; 
                                  $upload6 = $funObj->upload6($logo3, $certid); 
                                  
                                }else{
                                  echo  "<script>Image not uploaded.</script>";
                                }
                              }

                              if(isset($success4) && ($success4!==false) || ($success1) && ($success1!==false) || ($success2) && ($success2!==false) || ($success3) && ($success3!==false) || ($success4) && ($success4!==false) || ($success5) && ($success5!==false) || ($success6) && ($success6!==false)){
                              echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image uploaded. View certificate <b><a href="viewcerts.php">here</a></b>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                              }




                              
                             
                          } 



                        }
                        
                        if(isset($_POST['dltimg1'])){
                            //$certid = $row['certid'];
                            $imgname = $row['logo1'];
                            
                            //echo $certid;
                            //echo $imagecol;
                            
                             $dltImg1 = $funObj->delImg1($imgname, $certid);
                             if(!$dltImg1){
                                 echo "nope";
                             }else{
                                  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image deleted. Please refresh.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                             }
                        }
                        
                        if(isset($_POST['dltimg2'])){
                            //$certid = $row['certid'];
                            $imgname = $row['logo2'];
                            
                            //echo $certid;
                            //echo $imagecol;
                            
                             $dltImg2 = $funObj->delImg2($imgname, $certid);
                             if(!$dltImg2){
                                 echo "nope";
                             }else{
                                  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image deleted. Please refresh.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                             }
                        }
                        
                        if(isset($_POST['dltimg3'])){
                            //$certid = $row['certid'];
                            $imgname = $row['logo3'];
                            
                            //echo $certid;
                            //echo $imagecol;
                            
                             $dltImg3 = $funObj->delImg3($imgname, $certid);
                             if(!$dltImg3){
                                 echo "nope";
                             }else{
                                  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image deleted. Please refresh.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                             }
                        }
                        
                        if(isset($_POST['dltsign1'])){
                            //$certid = $row['certid'];
                            $imgname = $row['signatory1'];
                            
                            //echo $certid;
                            //echo $imagecol;
                            
                             $dltSign1 = $funObj->delSign1($imgname, $certid);
                             if(!$dltSign1){
                                 echo "nope";
                             }else{
                                  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image deleted. Please refresh.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                             }
                        }
                        
                        if(isset($_POST['dltsign2'])){
                            //$certid = $row['certid'];
                            $imgname = $row['signatory2'];
                            
                            //echo $certid;
                            //echo $imagecol;
                            
                             $delSign1 = $funObj->delSign2($imgname, $certid);
                             if(!$delSign1){
                                 echo "nope";
                             }else{
                                  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image deleted. Please refresh.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                             }
                        }
                        
                        if(isset($_POST['dltsign3'])){
                            //$certid = $row['certid'];
                            $imgname = $row['signatory3'];
                            
                            //echo $certid;
                            //echo $imagecol;
                            
                             $dltImg3 = $funObj->delSign3($imgname, $certid);
                             if(!$dltImg3){
                                 echo "nope";
                             }else{
                                  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image deleted. Please refresh.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                             }
                        }
                        
                        if(isset($_POST['dltimg1'])){
                            //$certid = $row['certid'];
                            $imgname = $row['logo2'];
                            
                            //echo $certid;
                            //echo $imagecol;
                            
                             $dltImg1 = $funObj->delImg1($imgname, $certid);
                             if(!$dltImg1){
                                 echo "nope";
                             }else{
                                  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">Image deleted. Please refresh.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                             }
                        }

                        
                        

                        echo '


                   
                    <div class="row m-2">
                      <!---create cert form function--->
                       
                      <div class="col-md-2">
                      </div>

                      <div class="col-md-8">
                         
                        
                          <h5><i>'.$row['eventname'].'</i>: CERTIFICATE DETAILS</h5>
                        
                          
                        <form class="formrow" action="uploadimgs.php?certid='.$certid.'" method="post" enctype="multipart/form-data">
                          <div class="m-3">
                            <h6 for="eventname"><i class="fas fa-upload"></i> ' .$row['organizer1'].' - SIGNATURE</h6>
                            <input type="file" class="form-control text-center" id="signatory1" name="signatory1" accept="image/*" >
                            <label for="eventname">'; 
                               if($row['signatory1'] !== ' '){
                                echo 'File uploaded: ' . $row['signatory1'];
                                echo '<input type="submit" value="DELETE" class="btn btn-sm" name="dltsign1" title="Delete signatory1"/>';
                               }else{
                                echo 'No file uploaded';
                               }

                            echo '</label>
                           
                          </div>
                        
                        
                          <div class="m-3">
                            <h6 for="eventname"><i class="fas fa-upload"></i> ' .$row['organizer2'].' - SIGNATURE</h6>
                            <input type="file" class="form-control text-center" id="signatory2" name="signatory2" accept="image/*" >
                            <label for="eventname">';

                               if($row['signatory2'] !== ' '){
                                echo 'File uploaded: ' . $row['signatory2'];
                                echo '<input type="submit" value="DELETE" class="btn btn-sm" name="dltsign2" title="Delete signatory2"/>';
                               }else{
                                echo 'No file uploaded';
                               }

                            echo '</label>
                            
                          </div>
                        
                          <div class="m-3">
                            <h6 for="eventname"><i class="fas fa-upload"></i> ' .$row['organizer3'].' - SIGNATURE</h6>
                            <input type="file" class="form-control text-center" id="signatory3" name="signatory3" accept="image/*" >
                            <label for="eventname">'; 
                               if($row['signatory3'] !== ' '){
                                echo 'File uploaded: ' . $row['signatory3'];
                                echo '<input type="submit" value="DELETE" class="btn btn-sm" name="dltsign3" title="Delete signatory3"/>';

                               }else{
                                echo 'No file uploaded';
                               }

                            echo '</label>
                             </div>
                        
                          <div class="m-3">
                            <h6 for="logo1"><i class="fas fa-upload"></i> ' .$row['logo1'].' - LOGO 1</h6>
                            <label><i>Leftmost logo</i></label>
                            <input type="file" class="form-control text-center" id="logo1" name="logo1" accept="image/*" >
                            <label for="eventname">'; 
                               if($row['logo1'] !== ' '){
                                echo 'File uploaded: ' . $row['logo1'];
                                echo '<input type="submit" value="DELETE" class="btn btn-sm" name="dltimg1" title="Delete logo1"/>';

                               }else{
                                echo 'No file uploaded';
                               }

                            echo '</label>

                            
                          </div>
                          
                          <div class="m-3">
                            <h6 for="logo2"><i class="fas fa-upload"></i> ' .$row['logo2'].' - LOGO 2</h6>
                            <input type="file" class="form-control text-center" id="logo2" name="logo2" accept="image/*" >
                            <label><i>Middle logo</i></label>
                            <label for="eventname">'; 
                               if($row['logo2'] !== ' '){
                                echo 'File uploaded: ' . $row['logo2'];
                                echo '<input type="submit" class="btn btn-sm" value="DELETE" name="dltimg2" title="Delete logo2"/>';

                               }else{
                                echo 'No file uploaded';
                               }

                            echo '</label>

                            
                          </div>
                          
                          <div class="m-3">
                            <h6 for="logo3"><i class="fas fa-upload"></i> ' .$row['logo3'].' - LOGO 3</h6>
                            <label><i>Rightmost logo</i></label>
                            <input type="file" class="form-control text-center" id="logo3" name="logo3" accept="image/*" >
                            <label for="eventname">'; 
                               if($row['logo3'] !== ' '){
                                echo 'File uploaded: ' . $row['logo3'];
                                echo '<input type="submit" value="DELETE" class="btn btn-sm" name="dltimg3" title="Delete logo3"/>';

                               }else{
                                echo 'No file uploaded';
                               }

                            echo '</label>

                            
                          </div>
                          <input type="submit" value="UPLOAD" class="btn btn-sm smbtn btn-round" name="upload1" title="Upload your image."/>
                        </form>
                        ';
                        //end of echo
                        ?>
                      </div>
                      <div class="col-md-2">
                        
                      </div>
                                        
                    </div>
                    <!--- end of row --->


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
