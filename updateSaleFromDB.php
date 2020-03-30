<?php
	$Servername = "localhost";
    $Username = "root";
    $pass = "";
    $database = "admindb";

    $conn = new mysqli($Servername,$Username,$pass,$database);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}	

	$client = $_POST['clientEdit'];
	$company = $_POST['companyEdit'];
    $concept = $_POST['conceptEdit'];
    $amount = $_POST['amountEdit'];
	$date = $_POST['dateEdit'];
    $validated = $_POST['validatedEdit'];
	$id = $_POST['idEdit'];
	echo $id;

	// $sql = "UPDATE sales SET client='$client', company='$company', concept='$concept', amount='$amount', date='$date', validated='$validated' WHERE id=2";
	
	$sql = "UPDATE sales SET client='$client', company='$company', concept='$concept', amount='$amount', date='$date', validated='$validated' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . mysqli_error($conn);
	}

	mysqli_close($conn);

	header("Location: SalesAdmin.php");
	die();

?>