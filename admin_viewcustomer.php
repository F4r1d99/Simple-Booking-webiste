<!DOCTYPE html> 
<html>
    <head>
        <link rel="stylesheet" href="admin.css">
    </head>
</html>

<?php

    require_once ('mysql_handle.php');
    include ("header.html");
    include ("admin_auth.php");

    echo '<h1>Reservation</h1>';

    $query = "SELECT * FROM roomBooking";

    $result = mysqli_query($conn, $query);

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        echo '<table>
        <tr>
            <td><b>ID</b></td>
            <td><b>Arrival</b></td>
            <td><b>Departure</b></td>
            <td><b>Room Preference</b></td>
        </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                <td><a href="admin_reservecustomer.php?id=' . $row['reserve_id']
                 . '">'. $row['email'] .'</td>
                <td>' . $row['arrival_date'] . '</td>
                <td>' . $row['depart_time'] . '</td>
                <td>' . $row['roomType'] . '</td>
            </tr>';
        }
        '</table>';


        mysqli_free_result($result);
    }
    else {
        echo '<p> There are currently no reserved cutomer. </p>';
    }

    mysqli_close($conn);

?>
