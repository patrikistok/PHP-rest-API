<?php
    require_once "../config.php";
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        echo "Pripojenie zlyhalo: " . $exception->getMessage();
    }
    header('Content-Type: application/json');
    if (isset($_GET["name"]) && isset($_GET["code"])){
            $meno = $_GET["name"];
            $kod = $_GET["code"];
            $statement = $connection->prepare("SELECT records.id, days.day, days.month, countries.title as country, records.value as nameday FROM records INNER JOIN countries ON countries.id = records.country_id INNER JOIN days ON days.id = records.day_id WHERE records.value = ? AND countries.code = ? AND records.type = 'nameday'");
            $statement->bindParam(1, $meno);
            $statement->bindParam(2, $kod);
            $statement->execute();
            $meniny = $statement->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($meniny);
    }
    else {
        $statement = $connection->prepare("SELECT records.id, days.day, days.month, countries.title as country, records.value as nameday FROM records INNER JOIN countries ON countries.id = records.country_id INNER JOIN days ON days.id = records.day_id WHERE records.type = 'nameday'");
        $statement->execute();
        $sviatky = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($sviatky);
    }
?>