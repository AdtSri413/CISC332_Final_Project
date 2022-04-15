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
        <h1>
            Check a Patient's Vaccination Status
        </h1>  
    </head>
    <body>
        <p>Please Select a Patient:</p>

        <form action="processStatus.php" method="post">
            <table class="center" style="width:80%">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>OHIP Number</th>
                </tr>
            <?php
                include 'connectDB.php';
                echo "<br>";

                $result = $connection->query("select * from Patient");
                
                while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo "<td><input type=\"radio\" name=\"OHIPNum\" value=\"".$row["PatientOHIP"]."\"></td>";
                    echo "<td>".$row["PatientFirstName"]." ".$row["PatientMiddleName"]." ".$row["PatientLastName"]."</td>";
                    echo "<td>".$row["PatientOHIP"]."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
            <input type="submit">
        </form>
    </body>
</html>