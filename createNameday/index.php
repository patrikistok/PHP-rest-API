<?php
    //https://codeofaninja.com/2017/02/create-simple-rest-api-in-php.html
    header('Access-Control-Allow-Origin: ');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require_once "../config.php";
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        echo "Pripojenie zlyhalo: " . $exception->getMessage();
    }

    $data = json_decode(file_get_contents("php://input"));

    if($data != NULL){
        $meno = $data->name;
        $den = $data->day;
        $mesiac = $data->month;

        $statement = $connection->prepare("SELECT id FROM days WHERE days.day = ? AND days.month = ?");
        $statement->bindParam(1, $den);
        $statement->bindParam(2, $mesiac);
        $statement->execute();
        $den_id = $statement->fetch(PDO::FETCH_ASSOC)["id"];
        
        $statement = $connection->prepare("INSERT INTO records (day_id, country_id, value, type) VALUES ( :den_id, 4, :value, 'nameday')");
        $statement->bindParam("den_id", $den_id);
        $statement->bindParam("value", $meno);
        $statement->execute();

        http_response_code(201);
        echo json_encode(array('message' => 'Name added'));
    }
    else{
        http_response_code(503);
        echo json_encode(array('message' => 'Post Not Created'));
    }
?>