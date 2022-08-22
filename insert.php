<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "nyb", "password", "nyb_coffeeshop");
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Insert into drinks table Query */

    /*
    PHP Form Validation
    https://www.w3schools.com/php/php_form_validation.asp
    */
    // define variables and set to empty values
    $drink = $cost = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $drink = test_input($_POST["drink"]);
        $cost = test_input($_POST["cost"]);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function terminate_script() {
        /* Refresh the page after 2 seconds and return to the add_drinks.php page */
        header("refresh:2; url=add_drinks.php");
        exit();     /* Terminate script */
    }


    /* Check the length of the string */
    if (strlen($drink)>5) {
        echo 'Drink Name too long';
        terminate_script();
    }

    /*
    Validating the cost
    https://supunkavinda.blog/php/input-validation-with-php#user-inputs
    */
    if (!empty($cost)) {

        $number = filter_var($cost, FILTER_VALIDATE_INT);

        /* Checks the number is a number and is within range */
        if ($number === false or $cost < 0 or $cost > 99) {
            echo 'Invalid Integer' ;
            terminate_script();
        }

    }

    $insert_drink = "INSERT INTO drinks (drink, cost) VALUES('$drink', '$cost')";

    /* Check the data has been inserted */
    if(!mysqli_query($dbcon, $insert_drink)) {
        echo 'Inserted Failed!';
    } else {
        echo 'Insert Successful!';
    }

    /* End the script */
    terminate_script();

    ?>