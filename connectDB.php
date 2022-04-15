<!-- Script to connect to database -->
<?php
    try {
        $connection = new PDO('mysql:host=localhost;dbname=covidDB', "root", "");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error!: ". $e->getMessage(). "<br/>";
        die();
    }
?>