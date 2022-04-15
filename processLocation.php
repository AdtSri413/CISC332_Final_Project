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
    </head>
    <body>
        <?php
            include 'connectDB.php';
            echo "<br>";

            $vaxType = $_POST["vaxType"];
            echo "<h1>Showing Locations Offering the ".$vaxType." Vaccine</h1>";

            echo "<table class=\"center\" style=\"width:80%\">";
            echo "<tr>
                    <th>Vaccination Site</th>
                    <th>Address</th>
                    <th>Number of Doses</th>
                </tr>";

            $query = "select distinct VaxSiteName from VaccineLot where CompanyName = '".$vaxType."'";
            $vaxSiteName = $connection->query($query);

            while ($row = $vaxSiteName->fetch())
            {
                $query2 = "select VaxLotNumDoses from VaccineLot where VaxSiteName = '".$row["VaxSiteName"]."' and CompanyName = '".$vaxType."'";
                $vaxLotNums = $connection->query($query2);

                $query3 = "select distinct * from VaccinationSite where VaxSiteName = '".$row["VaxSiteName"]."'";
                $vaxSiteAddress = $connection->query($query3);

                $count = 0;

                while($row2 = $vaxLotNums->fetch())
                {
                    $count = $count + $row2["VaxLotNumDoses"];
                }

                while ($row3 = $vaxSiteAddress->fetch())
                {   
                    echo "<tr>";
                    echo "<td>".$row3["VaxSiteName"]."</td>";
                    echo "<td>".$row3["VaxSiteStreetNum"]." ".$row3["VaxSiteStreet"].", ".$row3["VaxSiteCity"].", ".$row3["VaxSiteProvince"].", ".$row3["VaxSitePostalCode"]."</td>";
                    echo "<td>".$count."</td>";
                    echo "</tr>";
                }
            }
        ?>
    </body>
</html>