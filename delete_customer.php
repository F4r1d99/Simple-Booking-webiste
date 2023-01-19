<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="view.css">
    </head>
</html>

<?php
    include ("customer_auth.php");
    include ('header_exist.html');

    echo "<h1>Edit Reservation</h1>";
    
    #check via post or get, for user id
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id'];
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
        $id = $_POST['id'];
    } else {
        exit();
    }
    
    require ('mysql_handle.php');
    
if (isset($_POST['submit'])) {

    $e='';

        $q = "SELECT reserve_id FROM roombooking WHERE email='$e'";
        $r = mysqli_query($conn, $q);

        if (mysqli_num_rows($r) == 0) {

            $q = "DELETE FROM roombooking
                    WHERE reserve_id='$id'";
            $r = mysqli_query($conn, $q);

            if (mysqli_affected_rows($conn) == 1) {
                echo '<p>The user has been deleted. </p>';
            }

            else {
            echo '<p>The user could not be edited due to a system error.
                     We apologize for any inconvenience. </p>';
            }
        
        }
        else {
            echo '<p> The email address has already been registered. </p>';
        }
    }
    
    $q = "SELECT * FROM roombooking, customer WHERE roombooking.reserve_id=$id";
    $r = @mysqli_query ($conn, $q);
    
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
    
        echo '<form action="delete_customer.php" method="post">
            <table>
                <tr>
                    <td>Email: <input type="text" name="email" value="' . $row['email'] . '" /></td>
                </tr>
                <tr>
                    <td>First Name: <input type="text" name="f_name" value="' . $row['f_name'] . '" /></td>
                </tr>
                <tr>
                    <td>Last Name: <input type="text" name="L_name" value="' . $row['L_name'] . '" /></td>
                </tr>
                <tr>
                    <td>Arrival Date: <input type="text" name="arrival_date" value="' . $row['arrival_date'] . '" /></td>
                </tr>
                <tr>
                    <td>Depart Date: <input type="text" name="depart_time" value="' . $row['depart_time'] . '" /></td>
                </tr>
                <tr>
                    <td>Adults: <input type="text" name="adults" value="' . $row['adults'] . '"/></td>
                </tr>
                <tr>
                    <td>Children: <input type="text" name="children" value="' . $row['children'] . '"/></td>
                </tr>
                <tr>
                    <td>Room Type: <input type="text" name="roomType" value="' . $row['roomType'] . '"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Delete" /></td>
                    <input type="hidden" name="id" value="' . $id . '" />
                </tr>
            </table>
        </form>';
    } else {}
    
    mysqli_close($conn);
    ?>