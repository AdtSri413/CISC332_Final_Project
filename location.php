<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="styles.css">
    <head>
        <title>
            Covid Database
        </title>
        <div class="topnav">
            <a href="covid.html">Home</a>
            <a href="about.html">About</a>
            <a href="vaccine.html">Record a Vaccination</a>
            <a class="active" href="location.php">Find a Vaccination Location</a>
            <a href="status.php">Search Vaccination Status</a>
            <a href="employees.php">Show Employees</a>
        </div>
        <h1>
            Find A Vaccination Location
        </h1>  
    </head>
    <body>
        <!-- Go to processLocation.php to process the user's selection -->
        <form action="processLocation.php" method="post">
            <?php
                include 'connectDB.php';

                // Ask user to select a vaccine company
                echo "<p>Please Select a Type of Vaccine:</p>";
                echo "<div id=\"radio\">";

                // Vaccine companies are taken from the Company table
                $result = $connection->query("select * from Company");
                while ($row = $result->fetch())
                {
                    echo "<input type=\"radio\" name=\"vaxType\" value=\"".$row["CompanyName"]."\">".$row["CompanyName"]."<br>";
                }
                echo "</div><br>";
            ?>
            <br>
            <input type="submit">
        </form>
    </body>
</html>