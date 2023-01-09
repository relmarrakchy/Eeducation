<?php
    require "../phpFiles/login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - eEducation</title>
    <link rel="stylesheet" href="styleLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
</head>
<body>
    <div class="limiter" id="login">
        <div class="container-login100" style="background-image:url(Pics/students.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="login_topimg"> </div>
                        <div class="wrap-login100">
                            <form action="../phpFiles/login.php" method="post" class="login100-form validate-form"> 
                                <span class="login100-form-title "> Authentification </span> 
                                <span class="login100-form-subtitle m-b-16"> sur votre compte </span>

                                <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz"> 
                                    <input class="input100" type="text" name="id" placeholder="CNE / ID"> 
                                    <span class="focus-input100"></span> 
                                    <span class="symbol-input100"> 
                                        <span class="glyphicon glyphicon-user"></span> 
                                    </span> 
                                </div>
                                <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required"> 
                                    <input class="input100" type="password" name="pass" placeholder="Mot de passe"> 
                                    <span class="focus-input100"></span> <span class="symbol-input100"> 
                                        <span class="glyphicon glyphicon-lock"></span> 
                                    </span> 
                                </div>
                                <div class="test">
                                    <div class="container-login100-form-btn ok p-t-25"> <input type="submit" name="sub" class="login100-form-btn" value="Connexion"></div>
                                    <br>
                                    <div style="text-align: center;">
                                        <?php
                                            if (isset($_SESSION['msg'])) {
                                                echo $_SESSION['msg'];
                                            }
                                        ?>
                                    </div>
                                    <!-- <div> <a href="#" class="oktext"> Vous n'avez pas un compte ? <br> contactez le responsable</a> </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
</html>