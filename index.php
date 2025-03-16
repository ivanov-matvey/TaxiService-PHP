<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Taxi</title>
</head>
<body>
    <h1>Taxi Web</h1>

    <p>
        <?php
            include_once 'db_connection.php';

            $connection = new mysqli(hostname, username, password, database);

            if($connection->connect_error){
                die('Connection failed: ' . $connection->connect_error);
            }
            echo "Connected successfully!";
        ?>
    </p>
</body>
</html>