<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <?php

        session_start();
        require ("mysql_handle.php");
        if (isset($_POST["username"])) {
            $username = stripslashes($_REQUEST["username"]);

            $username = mysqli_real_escape_string($conn, $username);

            $password = stripslashes($_REQUEST["password"]);

            $password = mysqli_real_escape_string($conn,$password);

            $query = "SELECT * FROM admin WHERE username='$username' and password='$username'";
            
            $result = mysqli_query($conn, $query);

            $rows = mysqli_num_rows($result);
                if ($rows == 1) {
                    $_SESSION['username'] = $username;

                    header ("Location: admin_index.php");
                }
                else {
                    echo "<div>
                          <h3> Username or Password is incorrect ! </h3>
                          <br/>
                          Click here to <a href='admin_login.php'> Login </a>
                          </div>";
                }
        }
        else {
            ?> 
            <div id="container" >
                <form action="" method="POST" name="login">
                    <h2>Administrator Login</h2>
                    <p><input type="text" name="username" placeholder="Username" required /></p>
                    <p><input type="password" name="password" placeholder="Password" required /></p>
                    <input name="submit" type="submit" value="Login" />
                    <a href="index.html" target="_blank" rel="noopener noreferrer">Main Page</a>
                </form>
                <?php } ?>
            </div>
    </body>
</html>
