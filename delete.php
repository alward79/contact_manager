<?php
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);


$id = $_GET['id'];

$stmt = $dbh->prepare("DELETE FROM clients WHERE id = :id;");
$stmt->bindParam(':id', $id);

$stmt->execute();
header('Location: client.php');

die();

?>