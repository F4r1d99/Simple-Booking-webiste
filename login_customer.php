<!DOCTYPE html>
<html>
    <head>
        <title> User Login </title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <?php
        session_start();
        require ('mysql_handle.php');
        include('header_reg.html');
        
        if (isset($_POST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($conn, $username);

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            $query = "SELECT * FROM customer WHERE username='$username'
                        and password='$password'";
            
            $result = mysqli_query($conn, $query);

            $rows = mysqli_num_rows($result);
                if ($rows == 1) {
                    $_SESSION['username'] = $username;

                    header ("Location: index_login.html");
                }
                else {echo "<div class='form'>
                          <h3> Username or Password is incorrect ! </h3>
                          <br/>
                          Click here to <a href='login_customer.php'> Login </a>
                          </div>";
                }
        }
        else {
            ?> 
            <div id="container" >
                <form action="" method="post" name="login">
                    <h1> User Login </h1>
                    <p><input type="text" name="username" placeholder="Username" required /></p>
                    <p><input type="password" name="password" placeholder="Password" required /></p>
                    <input name="submit" type="submit" value="Login" />
                </form>
                <p> Not registered yet ? <a href="register_cust.php"> Register Here </a></p>
                <?php } ?>
            </div>
    </body>
</html>