<?php

echo '<h1>Delete</h1>';

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

if (isset($_POST['delete'])) {

    $errors = array();

    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    }
    else {
        $e = $_POST['email'];
    }

    if (empty($_POST['mobilehp'])) {
        $errors[] = 'You forgot to enter your phone number.';
    }
    else {
        $e = $_POST['mobilehp'];
    }

    if (empty($errors)) {

        $query = "SELECT customer_id FROM customer WHERE email='$e' AND customer_id !='$id'";
        $res = mysqli_query($conn, $query);

        if (mysqli_num_rows($res) == 0) {

            $q = "DELETE FROM customer WHERE customer_id='$id'";
            $r = mysqli_query($conn, $q);

            if (mysqli_affected_rows($conn) == 1) {
                echo '<p>The reservation has been deleted. </p>';
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
    else {
        echo '<p>The following error(s) occured: </p>';
        foreach ($errors as $msg) {
        echo "<p>-$msg \n</p>";
        }

    echo '<p> Please try again. </p>';
    }
}

$q = "SELECT CONCAT (f_name, ' ', L_name) AS name, email, mobilehp FROM customer WHERE customer_id=$id";
$r = mysqli_query($conn, $q);

if (mysqli_num_rows($r) == 1) {
    
    $row = mysqli_fetch_array($r);

    echo '<form action="admin_delete.php" method="POST">
        <p>Name: <input type="text" name="first_name" size="30" maxlength="30" value=" '.$row['name'] .'"/></p>

        <p>Email: <input type="text" name="last_name" size="30" maxlength="30" value=" '.$row['email'] .'" /></p>

        <p>Phone Number: <input type="text" name="email" size="30" maxlength="30" value=" '.$row['mobilehp'] .'" /></p>

        <input type="submit" name="delete" value="Delete" />

        <input type="hidden" name="customer_id" value="' . $id .'" />
        </form>';
}

else {
}

mysqli_close($conn);

?>
