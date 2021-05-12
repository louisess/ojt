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
       
        if(!$auth){
            echo "<script>alert('Email/ Password Not Match')</script>";
            echo '<script>console.log("failed wtf")</script>';
            //header('location:index.php');
            
        }
        else{
            $_SESSION['user'] = $auth;
            //$_SESSION['user'] = true;
            
            header('location:certs.php');
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
        <title>Login and Registration Form with HTML5 and CSS3</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />  
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />  
        <meta name="author" content="Codrops" />  

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href="/assets/css/style.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    </head>  
    <body>  
    	<div class="container">
    		<div class="row">
    			<header> <h1 align="center">CertiCreate</h1></header>
    		</div>
    	</div>
        <div class="container"> 
        <div class="row">
		    <div class="col">
		    	<a class="hiddenanchor" id="toregister"></a>  
                <a class="hiddenanchor" id="tologin"></a>  
                 
		      <div id="login" class="animate form">  
                           <form name="login" method="post" action="index.php">  
                                <h1>Log in</h1>   
                                <p>   
                                    <label for="emaillogin" class="youmail" data-icon="e" > Your email</label>  
                                    <input id="emaillogin" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>   
                                </p>  
                                <p>   
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>  
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />   
                                </p>  
                                <p class="login button">   
                                    <input type="submit" name="login" value="Login" />   
                                </p>  
                                <p class="change_link">  
                                    Not a member yet ?  
                                    <a href="#toregister" class="to_register">Join us</a>  
                                </p>  
                            </form>  
                        </div>  
		    </div>
		    <div class="col">
		      <div id="register" class="animate form">  
                            <form name="login" method="post" action="index.php">  
                                <h1> Sign up </h1>   
                                <p>   
                                    <label for="fnamesignup" class="fname" data-icon="u">Your first name</label>  
                                    <input id="fnamesignup" name="fname" required="required" type="text" placeholder="jon" />  
                                </p>  
                                <p>   
                                    <label for="lnamesignup" class="lname" data-icon="u">Your last name</label>  
                                    <input id="lnamesignup" name="lname" required="required" type="text" placeholder="snow" />  
                                </p>  
                                <p>   
                                    <label for="emailsignup" class="email" data-icon="e" > Your email</label>  
                                    <input id="emailsignup" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>   
                                </p>  
                                <p>   
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>  
                                    <input id="passwordsignup" name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>  
                                </p>  
                                <p>   
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>  
                                    <input id="passwordsignup_confirm" name="confirm_password" required="required" type="password" placeholder="eg. X8df!90EO"/>  
                                </p>  
                                <p class="signin button">   
                                    <input type="submit" name="register" value="Sign up"/>   
                                </p>  
                                <p class="change_link">    
                                    Already a member ?  
                                    <a href="#tologin" class="to_register"> Go and log in </a>  
                                </p>  
                            </form>  
                        </div>  
		    </div>
		  </div>
            
                
         
            <section>               
                <div id="container_demo" >  
                     
                    
                        
  
                        
                          
                    </div>  
                </div>    
            </section>  
        </div>  
    </body>  
</html>  