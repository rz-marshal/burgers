<?php

require_once "functions.php";

$name = mb_strtolower(strip_tags($_POST['name']));
$email = mb_strtolower(strip_tags($_POST['email']));
$phone = mb_strtolower(strip_tags($_POST['phone']));
$street = mb_strtolower(strip_tags($_POST['street']));
$home = mb_strtolower(strip_tags($_POST['home']));
$part = mb_strtolower(strip_tags($_POST['part']));
$appt = mb_strtolower(strip_tags($_POST['appt']));
$floor = mb_strtolower(strip_tags($_POST['floor']));

$address = [
    "street" => $street,
    "home" => $home,
    "part" => $part,
    "appt" => $appt,
    "floor" => $floor
];

$dbHostname = "localhost";
$dbDatabase = "burgers";
$dbUsername = "root";
$dbPassword = "";

$connection = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbDatabase);

if ($connection->connect_error) {
    die("failed connection (" . $connection->connect_errno . ")" . PHP_EOL . $connection->connect_error);
}

$userId = getUserId($connection, $email);
$ordersCount = getOrdersCount($connection, $userId);

if (is_null($userId)) {
    $query = "INSERT INTO users 
	SET 
	email ='$email',
	name = '$name',
	phone = '$phone',
	street = '$street',
	home = '$home',
	part = '$part',
	appt = '$appt',
	floor = '$floor'";
}
    $order = insertNewOrder($connection, $userId);
    writeOrderForSend($order["id_order"], $ordersCount, $address);

$connection->close();

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Заказ произведён!</title>
</head>
<body>
<div class="container">

</div>
</body>
</html>
