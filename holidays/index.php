<?php
    require_once "../config.php";
        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Pripojenie zlyhalo: " . $exception->getMessage();
        }
    header('Content-Type: application/json');

    if(isset($_GET['code'])){
        $kod = $_GET["code"];
        $statement = $connection->prepare("SELECT records.id, days.day, days.month, countries.title as country, records.value as holiday FROM records INNER JOIN countries ON countries.id = records.country_id INNER JOIN days ON days.id = records.day_id WHERE countries.code = ? AND records.type = 'holiday'");
        $statement->bindParam(1, $kod);
        $statement->execute();
        $sviatky = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($sviatky);
    }
    else {
        $statement = $connection->prepare("SELECT records.id, days.day, days.month, countries.title as country, records.value as holiday FROM records INNER JOIN countries ON countries.id = records.country_id INNER JOIN days ON days.id = records.day_id WHERE records.type = 'holiday'");
        $statement->execute();
        $sviatky = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($sviatky);
    }