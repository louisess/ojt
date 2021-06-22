<?php 
    include ('db/dbcon.php');
    include_once('db/dbFunction.php');  

    $database = new Database();
    $db = $database->getConnection();
    $funObj = new dbFunction($db);  

    if(isset($_POST['login'])){  
        $email = $_POST['email'];  
        $password = $_POST['password'];  
   
        $auth = $funObj->check_login($email, $password);
       
        if($auth){
            $_SESSION['user'] = $auth;
            echo "<script>window.location.href='certs.php';</script>";
            
        }
        else{
            //$_SESSION['user'] = $auth;
            echo '<script>console.log("Login failed. Check your email and password.")</script>';
        }
    }  

    if(isset($_POST['register'])){  
        $fname = $_POST['fname'];  
        $lname = $_POST['lname'];  
        $email = $_POST['email'];  
        $password = $_POST['password'];  
        $confirmPassword = $_POST['confirm_password'];  
        if($password == $confirmPassword){  
            //$email = $funObj->isUserExist($email); 
            $stmt1 = $funObj->checkDuplicates($email);
            $check1 = $stmt1->rowCount();

            $register = $funObj->UserRegister($fname, $lname, $email, $password); 

            if($check1>0){
                echo "<script>alert('Email already exists!')</script>"; 
            }else{
               if($register){  
                echo "<script>alert('Registration Successful. Please log in.')</script>";  
                }else{  
                    echo "<script>alert('Registration Not Successful')</script>";  
                }    
            }
            
          
        }  else{
            echo "<script>alert('Password does not match')</script>";  
        }
    }  
?>  
<!DOCTYPE html>  
 <html lang="en" class="no-js">  
 <head>  
        <meta charset="UTF-8" />  
        <title>Login and Registration Form</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />  
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />  
        <meta name="author" content="Codrops" />  

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <link href="./assets/css/style.css" rel="stylesheet" />
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="./assets/demo/demo.css" rel="stylesheet" />
    </head>  
    <body> 
        <div class="container mt-5 text-center">
            <img src="assets/img/logotiny.png">
        </div>
    	
        <div class="container mt-5"> 
        <div class="row">
		    <div class="col">
		    	<a class="hiddenanchor" id="toregister"></a>  
                <a class="hiddenanchor" id="tologin"></a>  
                 
		      <div id="login" class="animate form">  
                           <form name="login" method="post" action="index.php">  
                                <h3>Log in</h3>   
                                <p>   
                                    <label for="emaillogin" class="youmail" data-icon="e" > Your email</label>  
                                    <input id="emaillogin" class="form-control mb-2 text-center" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>   
                                </p>  
                                <p>   
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>  
                                    <input id="password" class="form-control mb-2 text-center" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />   
                                </p>  
                                <p class="login button"> 
                               
                                    <input type="submit" class="btn btn-md btn-round btn-success" name="login" value="Login" />   

                                </p>  
                            </form>  
                        </div>  
                        <p>VERIFY VALIDITY OF CERTIFICATE <a href="certcheck.php" target="_blank"><b>HERE.</b></a></p>
		    </div>
		    <div class="col">
		      <div id="register" class="animate form">  
                            <form name="login" method="post" action="index.php">  
                                <h3>Sign up </h3>   
                                <p>   
                                    <label for="fnamesignup" class="fname" data-icon="u">Your first name</label>  
                                    <input id="fnamesignup" class="form-control mb-2 text-center" name="fname" required="required" type="text" placeholder="jon" />  
                                </p>  
                                <p>   
                                    <label for="lnamesignup" class="lname" data-icon="u">Your last name</label>  
                                    <input id="lnamesignup" class="form-control mb-2 text-center" name="lname" required="required" type="text" placeholder="snow" />  
                                </p>  
                                <p>   
                                    <label for="emailsignup" class="email" data-icon="e" > Your email</label>  
                                    <input id="emailsignup" class="form-control mb-2 text-center" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>   
                                </p>  
                                <p>   
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>  
                                    <input id="passwordsignup" class="form-control mb-2 text-center" name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>  
                                </p>  
                                <p>   
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>  
                                    <input id="passwordsignup_confirm" class="form-control mb-2 text-center" name="confirm_password" required="required" type="password" placeholder="eg. X8df!90EO"/>  
                                </p>  
                                <p class="signin button">   
                                    <input type="submit" class="btn btn-md btn-round btn-primary" name="register" value="Sign up"/>   
                                </p>  
                            </form>  
                        </div>  
		    </div>
		  </div>
            
                
         
            
        </div>  
    </body>  
</html>  