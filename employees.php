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
            <a href="location.php">Find a Vaccination Location</a>
            <a href="status.php">Search Vaccination Status</a>
            <a class="active" href="employees.php">Show Employees</a>
        </div>
        <h1>
            Show all Employees Working at a Vaccination Site
        </h1>  
    </head>
    <body>
        <!-- Go to processEmployees.php to process the user's selection -->
        <form action="processEmployees.php" method="post">
            <?php
                include 'connectDB.php';

                // Ask user to select a vaccination site
                echo "<p>Please Select a Vaccination Site:</p>";
                echo "<div id=\"radio\">";

                // Vaccination sites are taken from the VaccinationSite table
                $result = $connection->query("select VaxSiteName from VaccinationSite");
                while ($row = $result->fetch())
                {
                    echo "<input type=\"radio\" name=\"vaxSite\" value=\"".$row["VaxSiteName"]."\">".$row["VaxSiteName"]."<br>";
                }
                echo "</div><br>";
            ?>
            <br>
            <input type="submit">
        </form>
    </body>
</html>