<?php

require_once "functions.php";

$dbHostname = "localhost";
$dbDatabase = "burgers";
$dbUsername = "root";
$dbPassword = "";

$connection = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbDatabase);

if ($connection->connect_error) {
	die("failed connection (" . $connection->connect_errno . ")" . PHP_EOL . $connection->connect_error);
}

$users = getUsers($connection);
$orders = getOrders($connection);
$connection->close();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/admin.css">
    <title>burgers admin</title>
</head>
<body>
<div class="container">
    <div class="container__tables">
    <div class="table">
        <h2>Клиенты</h2>

        <table id="table" >
            <thead>
            <tr>
                <th>ID клиента</th>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Телефон</th>
                <th>Улица</th>
                <th>Дом</th>
                <th>Корпус</th>
                <th>Квартира</th>
                <th>Этаж</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($users as $row) {
	            echo "<tr><td>", $row["id_user"], "</td>\n",
	            "<td>", $row["name"], "</td>\n",
	            "<td>", $row["email"], "</td>\n",
	            "<td>", $row["phone"], "</td>\n",
	            "<td>", $row["street"], "</td>\n",
	            "<td>", $row["home"], "</td>\n",
	            "<td>", $row["part"], "</td>\n",
	            "<td>", $row["appt"], "</td>\n",
	            "<td>", $row["floor"], "</td></tr>\n";
            }
            ?>
            </tbody>
        </table>
    </div>


    <div class="table">
        <h2>Заказы</h2>
        <table id="table">
            <thead>
            <tr>
                <th>ID заказа</th>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Телефон</th>
                <th>Заказ</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($orders as $row) {
	            echo "<tr><td>", $row["id_order"], "</td>\n",
	            "<td>", $row["name"], "</td>\n",
	            "<td>", $row["email"], "</td>\n",
	            "<td>", $row["phone"], "</td>\n",
	            "<td>", "DarkBeefBurger за 500 рублей, 1 шт", "</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>


