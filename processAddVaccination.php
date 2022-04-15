<!-- If the patient selected by the user is in the database or has just been added to the database, direct the user to this page -->
<?php
    session_start();
?>
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
            <a class="active" href="vaccine.html">Record a Vaccination</a>
            <a href="location.php">Find a Vaccination Location</a>
            <a href="status.php">Search Vaccination Status</a>
            <a href="employees.php">Show Employees</a>
        </div>
    </head>
    <body>
            <?php
                include 'connectDB.php';
                echo "<br>";

                try 
                {
                    // Save all the entered information about the patient's vaccination
                    $DOV = $_POST["date"];
                    $TOV = $_POST["time"];
                    $OHIPNum = $_SESSION['OHIPNum'];
                    $lotNum = $_POST["lotNum"];
                    $location = $_POST["location"];

                    $FirstName = $_SESSION["FirstName"];
                    $MiddleName = $_SESSION["MiddleName"];
                    $LastName = $_SESSION["LastName"];

                    // Add the vaccination to the Vaccination table in the database
                    $sql = "INSERT INTO Vaccination (VaxDate, VaxTime, PatientOHIP, VaxLotID, VaxSiteName)
                    VALUES (\"$DOV\", \"$TOV\", \"$OHIPNum\", \"$lotNum\", \"$location\")";

                    $connection->exec($sql);
                } 
                catch(PDOException $e) 
                {
                    echo $sql . "<br>" . $e->getMessage();
                }

                echo "<h2>Showing Vaccinations For ".$FirstName." ".$MiddleName." ".$LastName.", OHIP # ".$OHIPNum."</h2><br>";

                echo "<table class=\"center\" style=\"width:80%\">
                    <tr>
                        <th>Vaccination Date</th>
                        <th>Vaccination Time</th>
                        <th>Lot ID</th>
                        <th>Vaccination Location</th>
                    </tr>";
                
                $query = "select * from Vaccination where PatientOHIP = '".$OHIPNum."'";
                $result = $connection->query($query);
                while ($row = $result->fetch())
                {
                    echo "<tr>";
                    echo "<td>".$row["VaxDate"]."</td>";
                    echo "<td>".$row["VaxTime"]."</td>";
                    echo "<td>".$row["VaxLotID"]."</td>";
                    echo "<td>".$row["VaxSiteName"]."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
    </body>
</html>