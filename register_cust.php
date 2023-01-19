<!DOCTYPE html>
<html>
    <head>
        <title> User Sign Up </title>
        <link rel="stylesheet" href="reg.css">
    </head>
    <body>
        <?php
        require ('mysql_handle.php');

        include('header_reg.html');
  
        if (isset($_REQUEST['submit'])) {
            $f_name = stripslashes(($_REQUEST['f_name']));
            $f_name = mysqli_real_escape_string($conn, $f_name);

            $l_name = stripslashes(($_REQUEST['l_name']));
            $l_name = mysqli_real_escape_string($conn, $l_name);

            $mobilehp = stripslashes(($_REQUEST['mobilehp']));
            $mobilehp = mysqli_real_escape_string($conn, $mobilehp);

            $email = stripslashes(($_REQUEST['email']));
            $email = mysqli_real_escape_string($conn, $email);

            $username = stripslashes(($_REQUEST['username']));
            $username = mysqli_real_escape_string($conn, $username);

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            $trn_date = date("Y-m-d H_i_s");

                $query = "INSERT INTO customer (f_name, l_name, mobilehp, email, username, password)
                        VALUES ('$f_name', '$l_name', '$mobilehp', '$email', '$username', '$password')";
            
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "<div>
                        <h3> You are registered successfully. </h3>
                        </div>";
                }
        }
        else {
            ?> 
            <div id="container" >
                <form name="registration" action="" method="post">
                    <h1> User Sign Up </h1>
                    <br>
                    <p><input type="text" name="f_name" placeholder="Fisrt Name" required /></p>
                    <p><input type="text" name="l_name" placeholder="Last Name" required /></p>
                    <p><input type="text" name="mobilehp" placeholder="Mobile Number" required /></p>
                    <p><input type="text" name="email" placeholder="Email" required /></p>
                    <p><input type="text" name="username" placeholder="Username" required /></p>
                    <p><input type="password" name="password" placeholder="Password" required /></p>
                    <p><input name="submit" type="submit" value="Register" /></p>
                </form>
            </div>
            <?php } ?>
    </body>
</html>