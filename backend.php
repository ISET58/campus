<?php session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/login-index.css?v1">
    <link rel="shortcut icon" href="images/sis-favicon.ico" type="image/x-icon">
    <title>Login - Campus Virtual ISET 58</title>
</head>
<body class="bg">
    
    <div class="logincard-bck">
        <!--Only For Login card Background-->
    </div>
    <div class="logincard">
        <form action="validate.php" method="post" autocomplete="off">
            <div class="container-login-title">Login
            </div>
            <div class="container-input-fields">
                <input type="text" placeholder="email" onfocus="this.placeholder = 'email'" onblur="this.placeholder = 'email'" name="uname" required="required">
                <input type="password" placeholder="Password" onfocus="this.placeholder = 'Password'" onblur="this.placeholder = 'Password'" name="upass" required="required">
                <button type="submit">Ingresar</button>
                <a class="login-error">
                    <?php
                    if (isset($_SESSION['login-error']))
                    {
                        echo $_SESSION['login-error'];
                        unset($_SESSION['login-error']);
                    }
                    if (isset($_SESSION['logedout'])) {
                        echo $_SESSION['logedout'];
                        unset($_SESSION['logedout']);
                        # code...
                    }
                    ?>
                </a>
<a href="forgotpassword.php"><img src="images/ic-fp.png" id="forgotpassword"></a>

            </div>
            <div class="forgotpassword" >

            </div>
        </form>
    </div>
    <div class="footer">
        <p> Copyright <?=date('Y');?> www.estudiodoa.com</p>
    </div>
</body>
</html>
<?php
session_unset();
?>
