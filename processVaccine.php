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

            $OHIPNum = $_POST["OHIP"];
            $_SESSION['OHIPNum'] = $OHIPNum;
            $result = $connection->query("select * from Patient");

            $flag = 0;
            while ($row = $result->fetch()) {
                if ($row["PatientOHIP"] == $OHIPNum)
                {
                    $flag = 1;
                }
            }
            
            if ($flag == 1)
            {
                $query = "select * from Patient where PatientOHIP = '".$OHIPNum."'";
                $patient = $connection->query($query);

                while ($row = $patient->fetch()) {
                    echo "<h2>Recording Vaccination for ".$row["PatientFirstName"]." ".$row["PatientMiddleName"]." ".$row["PatientLastName"].", OHIP # ".$row["PatientOHIP"]."</h2><br>";
                    
                    $_SESSION["FirstName"] = $row["PatientFirstName"];
                    $_SESSION["MiddleName"] = $row["PatientMiddleName"];
                    $_SESSION["LastName"] = $row["PatientLastName"];
                }
                
                echo "<form action=\"processAddVaccination.php\" method=\"post\">";

                echo "<p>Please Enter the Patient's Date of Vaccination:</p>";
                echo "<input type=\"date\" name=\"date\">";

                echo "<p>Please Enter the Patient's Time of Vaccination:</p>";
                echo "<input type=\"time\" name=\"time\">";

                echo "<p>Please Enter the Patient's Vaccine Lot Number:</p>";
                echo "<select id=\"lotNum\" name=\"lotNum\">";

                $result = $connection->query("select * from VaccineLot");
                while ($row = $result->fetch())
                {
                    echo "<option value=\"".$row["VaxLotID"]."\">".$row["VaxLotID"]."</option>";
                }
                echo "</select>";

                echo "<p>Please Select the Location of the Vaccination:</p>";
                echo "<select id=\"location\" name=\"location\">";

                $result = $connection->query("select * from VaccinationSite");
                while ($row = $result->fetch())
                {
                    echo "<option value=\"".$row["VaxSiteName"]."\">".$row["VaxSiteName"]."</option>";
                }
                echo "</select>";

                echo "<input type=\"submit\">";
                echo "</form>";
            }
            else
            {
                echo "<h2>Patient ".$OHIPNum." not Found. Please Register Patient Below:</h2><br>";

                echo "<form action=\"processAddPatient.php\" method=\"post\">";

                echo "<p>Please Enter the Patient's Last Name:</p>";
                echo "<input type=\"text\" name=\"LastName\">";

                echo "<p>Please Enter the Patient's First Name:</p>";
                echo "<input type=\"text\" name=\"FirstName\">";

                echo "<p>Please Enter the Patient's Middle Name:</p>";
                echo "<input type=\"text\" name=\"MiddleName\">";
                
                echo "<p>Please Enter the Patient's Date of Birth:</p>";
                echo "<input type=\"date\" name=\"DOB\">";

                echo "<input type=\"submit\">";
                echo "</form>";
            }
        ?>
    </body>
</html>