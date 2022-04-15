<!-- Once the user has entered the new patient's information, direct the user to this page -->
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
            try 
            {
                include 'connectDB.php';
                echo "<br>";

                // Save the information provided by the user
                $OHIPNum = $_SESSION["OHIPNum"];  
                $LastName = $_POST["LastName"];
                $FirstName = $_POST["FirstName"];
                $MiddleName = $_POST["MiddleName"];
                $DOB = $_POST["DOB"];

                $_SESSION["FirstName"] = $FirstName;
                $_SESSION["MiddleName"] = $MiddleName;
                $_SESSION["LastName"] = $LastName;

                // Add the new patient to the Patient table in the database
                $sql = "INSERT INTO Patient (PatientOHIP, PatientLastName, PatientFirstName, PatientMiddleName, PatientBirthday)
                VALUES (\"$OHIPNum\", \"$LastName\", \"$FirstName\", \"$MiddleName\", \"$DOB\")";

                $connection->exec($sql);
            } 
            catch(PDOException $e) 
            {
                echo $sql . "<br>" . $e->getMessage();
            }

            $query = "select * from Patient where PatientOHIP = '".$OHIPNum."'";
            $patient = $connection->query($query);

            while ($row = $patient->fetch()) {
                echo "<h2>Recording Vaccination for ".$row["PatientFirstName"]." ".$row["PatientMiddleName"]." ".$row["PatientLastName"].", OHIP # ".$row["PatientOHIP"]."</h2><br>";
            }
        ?>

        <!--  Ask the user to enter in the newly added patient's vaccination information. Once submitted, redirect to processAddVaccination.php -->
        <form action="processAddVaccination.php" method="post">

            <p>Please Enter the Patient's Date of Vaccination:</p>
            <input type="date" name="date">

            <p>Please Enter the Patient's Time of Vaccination:</p>
            <input type="time" name="time">

            <p>Please Enter the Patient's Vaccine Lot Number:</p>
            <select id="lotNum" name="lotNum">
                <?php
                    $result = $connection->query("select * from VaccineLot");
                    while ($row = $result->fetch())
                    {
                        echo "<option value=\"".$row["VaxLotID"]."\">".$row["VaxLotID"]."</option>";
                    }
                    echo "</select>";
                ?>
            
            <p>Please Select the Location of the Vaccination:</p>
            <select id="location" name="location">
                <?php
                    $result = $connection->query("select * from VaccinationSite");
                    while ($row = $result->fetch())
                    {
                        echo "<option value=\"".$row["VaxSiteName"]."\">".$row["VaxSiteName"]."</option>";
                    }
                ?>
            </select>
            <input type="submit">
        </form>
    </body>
</html>