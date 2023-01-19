<?php
    include ("customer_auth.php");
    include ('header_exist.html');
?>

<!DOCTYPE html> 
<html>
    <head>
        <link rel="stylesheet" href="view.css">
    </head>
    <body>
    <?php
    require ('mysql_handle.php');

    echo '<h1>Reservation</h1>';
    

    $u = $_SESSION['username'];

    $query = "SELECT email FROM customer WHERE username='$u'";

    $result = mysqli_query($conn, $query);

    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $q = "SELECT CONCAT (customer.f_name, ' ', customer.L_name) AS name,
                customer.customer_id, roombooking.adults, roombooking.children, 
                roombooking.roomType, roombooking.reserve_id
                FROM roombooking
                INNER JOIN customer 
                ON roombooking.email=customer.email
                WHERE customer.username='$u'";
        
        $r = mysqli_query($conn, $q);

        $num = mysqli_num_rows($r);

        if ($num > 0) {
    
            $row = mysqli_fetch_assoc($r);
        
            echo '<form action="view_customer.php" method="POST">
                <table>
                    <tr>
                        <td style="text-align: left;">Name</td>
                        <td><input type="text" size="30" maxlength="30" value=" '.$row['name'] .'" /></p></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Adults</td>
                        <td><input type="text" size="30" maxlength="30" value=" '.$row['adults'] .'" /></p></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Children</td>
                        <td><input type="text" size="30" maxlength="30" value=" '.$row['children'] .'" /></p></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Room Preference</td>
                        <td><input type="text" size="30" maxlength="30" value=" '.$row['roomType'] .'" /></p></td>
                    </tr>
                    <tr>
                        <td><a href="edit_customer.php?id=' . $row['reserve_id'] . '">Edit</a></td>
                        <td><a href="delete_customer.php?id=' . $row['reserve_id'] . '">Delete</a></td>
                    </tr>
                </table>
                </form>';
                
        }
        

    mysqli_close($conn);
    }
?>
    </body>
</html>

