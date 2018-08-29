<?php

/**
 * @param mysqli $connection
 * @param int $userId
 * @return array
 */
function insertNewOrder(mysqli $connection, $userId)
{
	$query = "INSERT INTO orders SET id_user =" . $userId . ";";

	if ($connection->query($query)) {
		$query = "SELECT MAX(orders.id_order) as id_order, id_user FROM orders WHERE id_user = $userId;";

		return $connection->query($query)->fetch_assoc();
	}
}

/**
 * @param mysqli $connection
 * @param string $email
 * @return null|array
 */
function getUserId(mysqli $connection, $email)
{
	$query = "SELECT id_user FROM users WHERE email='" . $email . "';";

	if ($connection->query($query)) {
		return $connection->query($query)->fetch_assoc()["id_user"];
	}
}

/**
 * @param mysqli $connection
 * @param int $userId
 * @return null|array
 */
function getOrdersCount(mysqli $connection, $userId)
{
	$query = "SELECT COUNT(1) as count FROM orders WHERE id_user =" . $userId . ";";

	if ($connection->query($query)) {
		return $connection->query($query)->fetch_assoc()["count"];
	}
}

/**
 * @param int $orderId
 * @param int $ordersCount
 * @param $array
 */
function writeOrderForSend($orderId, $ordersCount, $array)
{

	$address = "ул. " . $array["street"] . ", " . $array['home'] . ", корп. " . $array['part']
		. ", " . $array['floor'] . " этаж, кв. " . $array['appt'];

	$countString = "Спасибо - это ваш первый заказ!";

	if ($ordersCount > 0) {
		$countString = "Спасибо! Это уже $ordersCount заказ";
	}

	$data = [
		0 => "Заголовок - заказ №$orderId",
		1 => "Ваш заказ будет доставлен по адресу $address",
		2 => "DarkBeefBurger за 500 рублей, 1 шт",
		3 => $countString
	];

	$sendContent = null;
	foreach ($data as $value) {
		$sendContent .= "<p>" . $value . "</p>";
	}

	$sendTime = date("d.m.Y H-i", time());
	file_put_contents("orders/$sendTime.txt", $sendContent);

	//ob_start();

	echo $sendContent;
}

/**
 * @param mysqli $connection
 * @return bool|mysqli_result
 */
function getUsers(mysqli $connection)
{
	$query = "SELECT * FROM users;";

	if ($connection->query($query)) {
		return $connection->query($query);
	}
}

/**
 * @param mysqli $connection
 * @return bool|mysqli_result
 */
function getOrders(mysqli $connection)
{
	$query = "select id_order, email, name, phone from orders, users WHERE users.id_user = orders.id_user;";

	if ($connection->query($query)) {
		return $connection->query($query);
	}
}
