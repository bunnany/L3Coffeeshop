<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "nyb", "password", "nyb_coffeeshop");
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Update drink and cost query */
    $delete_drink = "DELETE FROM drinks WHERE drink_id='$_GET[drink_id]'";

    /* Check the record has been deleted */
    if(!mysqli_query($dbcon, $delete_drink)) {
        echo 'Delete Failed';
    } else {
        echo 'Delete Successful';
    }

    /* Refresh the page and redirect */
    header("refresh:2; url=add_drinks.php");
    ?>