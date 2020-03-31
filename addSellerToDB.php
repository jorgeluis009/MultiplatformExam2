<?php
    $Servername = "localhost";
    $Username = "root";
    $pass = "";
    $database = "admindb";

    $conn = new mysqli($Servername,$Username,$pass,$database);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}	

	$id = $_POST['idUserAdd'];

    $insertSellerQ = "INSERT INTO `sellers` (`commission`, `totalSales`, `userID`) VALUES ('0', '0', '$id');";

	if (mysqli_query($conn, $insertSellerQ)) {
	    echo "New record added successfully";
	} else {
	    echo "Error adding record: " . mysqli_error($conn);
	}

	mysqli_close($conn);

	header("Location: sellerAdmin.php");
	die();
?>