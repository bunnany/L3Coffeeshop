<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "nyb", "password", "nyb_coffeeshop");

    /* If connection fails, exit nicely */
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* 1 - DRINKS DROPDOWN */
    /* Create a query to get all drinks and perform against the db */
    $all_drinks_query = "SELECT drink_id, drink FROM drinks";
    $all_drinks_result = mysqli_query($dbcon, $all_drinks_query);


    /* 2- ORDERS DROPDOWN */
    /* Create a query to get all orders and perform against the db */
    $all_orders_query = "SELECT order_id FROM orders ORDER BY order_id ASC";
    $all_orders_result = mysqli_query($dbcon, $all_orders_query);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mr Ny's Cafe</title>
    </head>
    <body>
        <nav>
            <a href="drinks.php">Drinks</a>
        </nav>
        <main>
            <!-- 1- DRINKS DROPDOWN FORM-->
            <!--name: for php; id: for css; action: page we go to when button clicked-->
            <form name='drinks_form' id='drinks_form'
                  method='get' action='drinks.php'>
                <!--Dropdown menu-->
                <select name='drink_sel' id='drink_sel'>
            <!--Options-->
                    <?php
                    /* Display the query results into an option tag*/
                    while($all_drinks_record = mysqli_fetch_assoc($all_drinks_result)){
                        echo "<option value ='".$all_drinks_record['drink_id'] ."'>";
                        echo $all_drinks_record['drink'];   // Show the drink name in the option box
                        echo "</option>";
                    }
                    ?>
                </select>
                <!--Show drink button-->
                <input type="submit" name="drinks_button" value="Show drink info">
            </form>


            <!-- 2 - DRINKS DROPDOWN FORM-->
            <form name='orders_form' id='orders_form' method='get' action='orders.php'>
                <select name='order_sel' id='order_sel'>
                    <!--Options-->
                    <?php
                    while($all_orders_record = mysqli_fetch_assoc($all_orders_result)){
                        echo "<option value = '". $all_orders_record['order_id'] . "'>";
                        echo $all_orders_record['order_id'];
                        echo "</option>";
                    }
                    ?>
                </select>
                <!--Show order button-->
                <input type="submit" name="orders_button" value="Show order info">
            </form>
        </main>
    </body>
</html>
