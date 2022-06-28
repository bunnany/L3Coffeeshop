<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "nyb", "password", "nyb_coffeeshop");
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Default value for page */
    if(isset($_GET['drink_sel'])) {
        $drink_id = $_GET['drink_sel'];
    } else {
        $drink_id = 1;
    }

    /* Query the database for a single drink */
    $this_drink_query = "SELECT * FROM drinks WHERE drinks.drink_id = '" .$drink_id . "'";
    $this_drink_result = mysqli_query($dbcon, $this_drink_query);
    $this_drink_record = mysqli_fetch_assoc($this_drink_result);

    /* Update drinks query */
    $update_drinks = "SELECT * FROM drinks";
    $update_drinks_records = mysqli_query($dbcon, $update_drinks);

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
    <main>
        <!--List the information of the selected drink record-->
        <h2>Drinks Information</h2>
        <?php
            echo "<p> Drink Name: " .$this_drink_record['drink']. "<br>";
            echo "Cost: $" .$this_drink_record['cost']. "</p>";
        ?>

        <!--Allow user to search for a drink-->
        <h2>Drink Search</h2>
        <form action="" method="post">
            <input type="text" name="search">
            <input type="submit" name="submit" value="Search">
        </form>

        <!--Display the search result-->
        <?php
            if(isset($_POST['search'])){
                $search = $_POST['search'];

                /* % represents zero or more characters before and after the search term */
                $search_query = "SELECT * FROM drinks WHERE drinks.drink LIKE '%$search%'";
                $search_result = mysqli_query($dbcon, $search_query);
                $search_records = mysqli_num_rows($search_result);

                /* If there are no results found */
                if($search_records == 0){
                    echo "There was no results found!";
                } else {    /* Print all results found */
                    while ($result_row = mysqli_fetch_array($search_result)) {
                        echo $result_row['drink'];
                        echo "<br>";    /* line break */
                    }
                }
            }
        ?>

        <!--Level 3 - INSERT -->
        <!--Adding a drink into the database-->
        <h2>Add Drink</h2>
        <form action="insert.php" method="post">
            <!--Post the value into the input name-->
            <label for="drink">Drink name:</label><br>
            <input type="text" id="drink" name="drink"><br>
            <label for="cost">Cost:</label><br>
            <input type="text" id="cost" name="cost">

            <!--Perform the form action goto insert.php-->
            <input type="submit" value="Submit">
        </form>

        <!--Level 3 - UPDATE and DELETE -->
        <!--Pull all data from drinks table and add to a table-->
        <table>
            <tr>    <!--Table Row-->
                <th>    <!--Table Header-->
                    Drink Information
                </th>
                <th>Cost</th>
            </tr>
            <!--Add a row for each record-->
            <?php

                while($row = mysqli_fetch_array($update_drinks_records)) {
                    /* Allow modifying the value in the database */
                    echo "<tr><form action=update.php method=post>";
                    echo "<td><input type=text name=drink value='". $row['drink'] ."'></td>";
                    echo "<td><input type=text name=cost value='". $row['cost'] ."'></td>";

                    /* Hidden field holding the PK of the record */
                    echo "<td><input type=hidden name=drink_id value='". $row['drink_id'] ."'></td>";

                    /* Add Submit button to perform the form action goto update.php */
                    echo "<td><input type=submit></td>";

                    /* Add Delete record button to goto drink.php with the drink_id */
                    echo "<td><a href=delete.php?drink_id=". $row['drink_id'] . ">Delete</a></td>";
                    echo "</form></tr>";
                }
            ?>
        </table>
    </main>
    <!--Delete me unless you are going to use Javascript-->
    <script src="js/rename-me.js"></script>
</body>
</html>