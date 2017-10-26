<?php

$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);

$clientid = $_GET['id'];
$stmt=$dbh->prepare("SELECT * FROM clients where id In (:id)");
$stmt->bindParam(':id', $clientid);
$stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_ASSOC);
if(isset($_POST['submit'])){
	$clientid = $_GET['id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$website = $_POST['website'];

	$stmt=$dbh->prepare("UPDATE clients SET fname='$fname',lname='$lname',phone='$phone',email='$email',website='$website'WHERE id='$clientid'");
	$stmt->execute();
	header('Location: client.php');
	die();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Contact Manager</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
		<body>  	
		<h2>Update</h2>

		<form action='' id='add' method='POST'>
			<label>First Name: </label>
			<input type="text" name="fname" value=<?php echo '"'.$result[0]['fname'].'"'; ?> required/></br>
			<label>Last Name: </label>
			<input type="text" name="lname" value=<?php echo '"'.$result[0]['lname'].'"'; ?> required/></br>
			<label>Phone: </label>
			<input type="phone" name="phone" value=<?php echo '"'.$result[0]['phone'].'"'; ?> required/></br>
			<label>Email: </label>
			<input type="email" name="email" value=<?php echo '"'.$result[0]['email'].'"'; ?> required/></br>
			<label>Website: </label>
			<input type="text" name="website" value=<?php echo '"'.$result[0]['website'].'"'; ?> required/></br>
			<input type='submit' name='submit' value='Save' />
		</form>	
	</body>
</html>