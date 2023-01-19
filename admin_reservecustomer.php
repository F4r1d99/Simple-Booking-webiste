<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="admin.css">
</html>

<?php

include("header.html");
include ("admin_auth.php");


echo '<h1>Booking Details</h1>';

if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
}
elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
}
else {
    echo '<p This page has been accessed in error. </p>';
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
                echo '<p style="font-size:20px; text-align:center ; margin-top:3%;">
                The reservation has been deleted. </p>';
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

$q = "SELECT roombooking.email, CONCAT (customer.f_name, ' ', customer.L_name) AS name,
        customer.mobilehp, roombooking.adults, roombooking.children, roombooking.roomType
        FROM roombooking, customer
        WHERE roombooking.email=customer.email
        AND roombooking.reserve_id=$id";

$r = mysqli_query($conn, $q);

if (mysqli_num_rows($r) > 0) {
    
    $row = mysqli_fetch_assoc($r);

    echo '<form action="admin_reservecustomer.php" method="POST">
        <table id="container">
            <tr>
                <td style="text-align: left;">Email</td>
                <td><input type="text" size="30" maxlength="30" value=" '.$row['email'] .'"/></td>
            </tr>
            <tr>
                <td style="text-align: left;">Name</td>
                <td><input type="text" size="30" maxlength="30" value=" '.$row['name'] .'" /></p></td>
            </tr>
            <tr>
                <td style="text-align: left;">Phone Number</td>
                <td><input type="text" size="30" maxlength="30" value=" '.$row['mobilehp'] .'" /></p></td>
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
        </table>

        <input style="margin-top:400%" type="submit" name="submit" value="Delete" />

        <input type="hidden" name="id" value="' . $id .'" />
        </form>';
}

else {
}

mysqli_close($conn);

?>
