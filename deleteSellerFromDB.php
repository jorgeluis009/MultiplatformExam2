<?php
    $Servername = "localhost";
    $Username = "root";
    $pass = "";
    $database = "admindb";

    $conn = new mysqli($Servername,$Username,$pass,$database);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}	

	$id = $_POST['idDeleteSeller'];

    print_r($_POST);
    
    $deleteQuery = "DELETE FROM `sellers` WHERE `sellers`.`userID` = '$id'";

  	print_r($deleteQuery);

	if ($conn->query($deleteQuery)) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . mysqli_error($conn);
	}


	mysqli_close($conn);

	header("Location: SellerAdmin.php");
	die();
?>