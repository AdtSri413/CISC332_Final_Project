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
    </head>
    <body>
        <?php
            include 'connectDB.php';

            $vaxSite = $_POST["vaxSite"];

            echo "<h1>Showing Employees Working at ".$vaxSite." </h1><br>";
            echo "<table class=\"center\" style=\"width:80%\">";
            echo "<caption><h3>Doctors</h3></caption>";
            echo "<tr>
                    <th>Name</th>
                    <th>ID Number</th>
                </tr>";

            $query = "select DoctorID from EmploysDoctor where VaxSiteName = '".$vaxSite."'";
            $DoctorID = $connection->query($query);

            while ($row = $DoctorID->fetch())
            {
                $query2 = "select DoctorLastName, DoctorFirstName, DoctorMiddleName from Doctor where DoctorID = '".$row["DoctorID"]."'";
                $DoctorName = $connection->query($query2);

                while ($row2 = $DoctorName->fetch())
                {   
                    echo "<tr>";
                    echo "<td>".$row2["DoctorFirstName"]." ".$row2["DoctorMiddleName"]." ".$row2["DoctorLastName"]."</td>";
                    echo "<td>".$row["DoctorID"]."</td>";
                    echo "</tr>";
                }
            }
            echo "<table class=\"center\" style=\"width:80%\">";
            echo "<caption><h3>Nurses</h3></caption>";
            echo "<tr>
                    <th>Name</th>
                    <th>ID Number</th>
                </tr>";

            $query = "select NurseID from EmploysNurse where VaxSiteName = '".$vaxSite."'";
            $NurseID = $connection->query($query);

            while ($row = $NurseID->fetch())
            {
                $query2 = "select NurseLastName, NurseFirstName, NurseMiddleName from Nurse where NurseID = '".$row["NurseID"]."'";
                $NurseName = $connection->query($query2);

                while ($row2 = $NurseName->fetch())
                {   
                    echo "<tr>";
                    echo "<td>".$row2["NurseFirstName"]." ".$row2["NurseMiddleName"]." ".$row2["NurseLastName"]."</td>";
                    echo "<td>".$row["NurseID"]."</td>";
                    echo "</tr>";
                }
            }
        ?>
        <style>
            table, th, td {
                width: 50%;
            }
        </style>
    </body>
</html>