<?php
include('connection.php');
//fetch.php

$menu=$_GET["m"];

$query = "SELECT * FROM products where main_menu='".$menu."'";
//$query = "SELECT * FROM products";
$statement = $connect->prepare($query);
$statement->execute();
while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
}

echo json_encode($data);

?>