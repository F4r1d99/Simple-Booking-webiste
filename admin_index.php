<?php

include ("admin_auth.php");
include ("header.html");

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Welcome Home </title>
        <link rel="stylesheet" href="admin.css">
    </head>

    <body>
        <div class="intro">
            <p> Welcome ! 
                <?php
                    echo  $_SESSION["username"] ;
                ?>
            </p>
            
        </div>  
    </body>
</html>