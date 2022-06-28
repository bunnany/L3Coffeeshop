<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "nyb", "password", "nyb_coffeeshop");
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Insert into drinks table Query */
    $drink = $_POST['drink'];
    $cost = $_POST['cost'];

    $insert_drink = "INSERT INTO drinks (drink, cost) VALUES('$drink', '$cost')";

    /* Check the data has been inserted */
    if(!mysqli_query($dbcon, $insert_drink)) {
        echo 'Inserted Failed!';
    } else {
        echo 'Insert Successful!';
    }

    /* Refresh the page after 2 seconds and return to the add_drinks.php page */
    header("refresh:2; url=add_drinks.php");

    ?>