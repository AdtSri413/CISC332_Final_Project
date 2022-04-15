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
            <a class="active" href="status.php">Search Vaccination Status</a>
            <a href="employees.php">Show Employees</a>
        </div>
    </head>
    <body>
        <?php
            include 'connectDB.php';
            echo "<br>";

            $OHIPNum = $_POST["OHIPNum"];

            $query = "select * from Patient where PatientOHIP = '".$OHIPNum."'";
            $patient = $connection->query($query)->fetch();

            echo "<h1>Showing Vaccinations for ".$patient["PatientFirstName"]." ".$patient["PatientMiddleName"]." ".$patient["PatientLastName"].", OHIP # ".$patient["PatientOHIP"]."</h1>";

            echo "<table class=\"center\" style=\"width:80%\">
                    <tr>
                        <th>Vaccination Date</th>
                        <th>Vaccination Time</th>
                        <th>Lot ID</th>
                        <th>Vaccination Type</th>
                    </tr>";

            $query = "select VaxDate, VaxTime, VaxLotID from Vaccination where PatientOHIP = '".$OHIPNum."'";
            $vaccinations = $connection->query($query);
            while($row = $vaccinations->fetch())
            {
                $query = "select CompanyName from VaccineLot where VaxLotID = '".$row["VaxLotID"]."'";
                $vaxType = $connection->query($query)->fetch();

                echo "<tr>";
                echo "<td>".$row["VaxDate"]."</td>";
                echo "<td>".$row["VaxTime"]."</td>";
                echo "<td>".$row["VaxLotID"]."</td>";
                echo "<td>".$vaxType["CompanyName"]."</td>";
                echo "</tr>";
            }
        ?>
        </table>
    </body>
</html>