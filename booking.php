<?php
    include ("customer_auth.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Booking </title>
        <link rel="stylesheet" href="reg.css">
    </head>
    <body>
        <?php
        require ('mysql_handle.php');
        include ('header_exist.html');
        
        if (isset($_POST['submitted'])) {
            $arrival_date = stripslashes(($_REQUEST['arrival_date']));
            $arrival_date = mysqli_real_escape_string($conn, $arrival_date);
            
            $depart_time = stripslashes(($_REQUEST['depart_time']));
            $depart_time = mysqli_real_escape_string($conn, $depart_time);

            $f_name = stripslashes(($_REQUEST['f_name']));
            $f_name = mysqli_real_escape_string($conn, $f_name);

            $l_name = stripslashes(($_REQUEST['l_name']));
            $l_name = mysqli_real_escape_string($conn, $l_name);

            $email = stripslashes(($_REQUEST['email']));
            $email = mysqli_real_escape_string($conn, $email);

            $mobilehp = stripslashes(($_REQUEST['mobilehp']));
            $mobilehp = mysqli_real_escape_string($conn, $mobilehp);

            $adults = stripslashes(($_REQUEST['adults']));
            $adults = mysqli_real_escape_string($conn, $adults);

            $children = stripslashes($_REQUEST['children']);
            $children = mysqli_real_escape_string($conn, $children);

            $roomType = stripslashes($_REQUEST['roomType']);
            $roomType = mysqli_real_escape_string($conn, $roomType);
                
            #booking
            $query = "INSERT INTO roombooking
                (arrival_date, depart_time, adults, children, roomType, email)
                VALUES ('$arrival_date', '$depart_time', '$adults', '$children', '$roomType', '$email')";

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<div>
                    <h3> Booking Status </h3>
                    <p> Your reservation for Room $roomType is success. </p>
                    <br/>
                    </div>";
            }
        }
        else {
            ?> 
            <div id="container" >
                <form action="" method="post" name="booking">
                    <h1> Reservation </h1>
                    <br>
                    <input type="date" name="arrival_date" placeholder="Arrival Date" required/>
                    <input type="date" name="depart_time" placeholder="Depart Date" required/>
                    <input type="text" name="f_name" placeholder="First Name" required />
                    <input type="text" name="l_name" placeholder="Last Name" required />
                    <input type="text" name="email" placeholder="Email" required /> 
                    <input type="number" name="mobilehp" placeholder="Phone Number" required />
                    <input type="number" name="adults" placeholder="Adults" required />
                    <input type="number" name="children" placeholder="Children" required />
                    <input type="text" name="roomType" placeholder="Room Type" required />
                    <!--<input type="text" name="roomType" placeholder="Room Type" required />-->
                    <input name="submit" type="submit" value="Reserve">
                    <input type="hidden" name="submitted" value="TRUE" />
                </form>
                <?php } ?>
            </div>
    </body>
</html> 
    <!--
    <select name="roomType">
        <option value="Single"> Single </option>
        <option value="Double"> Double </option>
        <option value="Twin"> Twin </option>
        <option value="Deluxe"> Deluxe </option>
        <option value="Suite"> Suite </option>
    </select>
    -->