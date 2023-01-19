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
        echo "<p class='error'>This page has error(s).</p>";
        exit();
    }
    
    require ('mysql_handle.php');
    
    if (isset($_POST['submit'])) {
        $errors = array();
    
        if (empty($_POST['f_name'])) {
            $errors[] = "You forgot to enter your first name.";
        } else {
            $f_name = ($_POST['f_name']);
        }
    
        if (empty($_POST['L_name'])) {
            $errors[] = "You forgot to enter your last name.";
        } else {
            $l_name = ($_POST['L_name']);
        }
    
        if (empty($_POST['email'])) {
            $errors[] = "You forgot to enter your email.";
        } else {
            $email = ($_POST['email']);
        }

        if (empty($_POST['arrival_date'])) {
            $errors[] = "Please Enter The Arrival Date Correctly.";
        } else {
            $a = ($_POST['arrival_date']);
        }

        if (empty($_POST['depart_time'])) {
            $errors[] = "Please Enter The Departure Date Correctly.";
        } else {
            $d = ($_POST['depart_time']);
        }

        if (empty($_POST['adults'])) {
            $errors[] = "Please Enter The Number of Adults Correctly.";
        } else {
            $adults = ($_POST['adults']);
        }

        if (empty($_POST['children'])) {
            $errors[] = "Please Enter The Number of Children Correctly.";
        } else {
            $children = ($_POST['children']);
        }

        if (empty($_POST['roomType'])) {
            $errors[] = "Please Enter The Room Type Correctly.";
        } else {
            $roomtype = ($_POST['roomType']);
        }

        if (empty($errors)) {
            $q = "SELECT arrival_date, depart_time, adults, children, roomType 
                    FROM roombooking where email='$email' AND reserve_id!='$id'";
            $r = mysqli_query($conn, $q);
            
            if (mysqli_num_rows($r) == 0) {
                $q = "UPDATE roombooking SET arrival_date='$a', depart_time='$d',
                    adults='$adults', children='$children', roomType='$roomtype'
                        WHERE reserve_id=$id LIMIT 1";
                $r = mysqli_query ($conn, $q);
    
                if (mysqli_affected_rows($conn) == 1) {
                    echo "<p>The user has been edited</p>";
                } else {
                    echo "<p class='error'>The user could not be edited.
                            We apologize for the inconvenience.</p>";
                }
            } else {
                echo "<p class='error'>The email has been registered.</p>";
            }
        } else {
            echo "<p class='error'>The following error(s) occured: <br />";
            foreach ($errors as $msg) {
                echo " - $msg<br />\n";
            }
            echo "</p><p>Please try again.</p>";
        }
    }
    
    $q = "SELECT * FROM roombooking, customer WHERE roombooking.reserve_id=$id";
    $r = mysqli_query ($conn, $q);
    
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
    
        echo '<form action="edit_customer.php" method="post">
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
                    <td>Children: <input type="number" name="children" value="' . $row['children'] . '"/></td>
                </tr>
                <tr>
                    <td>Room Type: <input type="text" name="roomType" value="' . $row['roomType'] . '"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Submit" /></td>
                    <input type="hidden" name="id" value="' . $id . '" />
                </tr>
            </table>
        </form>';
    } else {
        echo "<p class='error'>This page has an error.</p>";
    }
    
    mysqli_close($conn);
    ?>