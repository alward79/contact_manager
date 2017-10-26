<?php 
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$stmt = $dbh->prepare("INSERT INTO clients (fname,lname,phone,email,website) VALUES (:fname, :lname, :phone, :email, :website);");
	$stmt->bindParam(':fname', $fname);
	$stmt->bindParam(':lname', $lname);
	$stmt->bindParam(':phone', $phone);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':website', $website);
	$stmt->execute();
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Contact Manager</title>
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Aguafina+Script' rel='stylesheet' type='text/css'>
</head>
<body><center>
	<header>
		<div class="page-header">
			<h1>Contact Manager</h1>
		</div>
	</header>

	<div id="contactform">
		<form action="client.php" method="POST">
			<fieldset>
				<legend>Add New Contact</legend>
			
				<label>First Name</label>
				<input type="text" id="firstname" name="fname" required> </br>
						
				<label>Last Name</label>
				<input type="text" id="lastname" name="lname" required></br>
						
				<label>Phone</label>
				<input type="phone" id="phone" name="phone" required></br>
						
				<label>Email</label>
				<input type="email" id="email" name="email" required></br>
						
				<label>Website</label>
				<input type="text" id="website" name="website" required></br>
						
				<input type="submit" name="submit" value="Submit">
			</fieldset>
		</form>
		 <?php if (count($_POST)>0) echo '<script>alert("Form Submitted!");</script>'; ?>
	</div>
	<table>
		<tr>
			<th>First Name </th>
			<th>Last Name </th>
			<th>Phone </th>
			<th>Email </th>
			<th>Website </th>
		</tr>
	
		<?php 
		$stmt = $dbh->prepare('SELECT * FROM clients;');
		$stmt->execute();
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			echo '<tr>
				<td>'.$row['fname'] .'</td>
				<td>'.$row['lname'] .'</td>
				<td>'.$row['phone'] . '</td>
				<td>'.$row['email']. '</td>
				<td>'.$row['website'].'</td>
				<td><a href="delete.php?id='.$row['id'].'">Delete</a></td>
				<td><a href="edit.php?id='.$row['id'].'"><button class="buttonR">Edit</button></a></td>
				</tr>';
		}
		?>
	</table>	
	<footer>
		<small>Developed and designed by Angelena Ward Copyright &copy 2015</small>
	</footer>	
</center></body>
</html>