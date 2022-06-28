<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "nyb", "password", "nyb_coffeeshop");

    /* Checks if DB connection was successful */
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Get from the order id from index page else set default */
    if(isset($_GET['order_sel'])) {
        $order_id = $_GET['order_sel'];
    } else {
        $order_id = 1;
    }
    echo $order_id;

    /* Create the SQL query */
    $this_order_query = "SELECT orders.order_id, customers.fname, customers.lname, drinks.drink
                         FROM customers, orders, drinks 
                         WHERE customers.cust_id = orders.cust_id
                         AND orders.drink_id = drinks.drink_id
                         AND orders.order_id = '". $order_id ."'";

    /* Perform the query against the database */
    $this_order_result = mysqli_query($dbcon, $this_order_query);

    /* Fetch the result into an associative array */
    $this_order_record = mysqli_fetch_assoc($this_order_result);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>

        <meta name="description" content="">
        <link href="css/styles.css" rel="stylesheet">

    </head>
    <body>
        <h1>Coffee Shop</h1>
        <h2>Drinks Information</h2>
        <!--Order info $this_order_record is the associative array, italicise the value-->
        <?php

            echo "<h3> Order Number: <em>". $this_order_record['order_id'] ."</em></h3><br>";
            echo "Customer First Name: <em>". $this_order_record['fname'] ."</em><br>";
            echo "Customer Last Name: <em>" . $this_order_record['lname'] ."</em><br>";
            echo "Drink: <em>". $this_order_record['drink'] ."</em></p>";

        ?>


        <!-- Delete this unless you are going to use Javascript -->
        <script src="js/rename-me.js"></script>
    </body>
</html>