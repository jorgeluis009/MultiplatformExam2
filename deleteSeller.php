<?php
    $Servername = "localhost";
    $Username = "root";
    $pass = "";
    $database = "admindb";

    $conn = new mysqli($Servername,$Username,$pass,$database);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}	

	$id = $_POST['idT'];

    print_r($_POST);
    
    $deleteQuery = "DELETE from users where id = '$id'";
    $deleteQuery2 = "DELETE from sellers where userID = '$id'";
  	print_r($deleteQuery);

	if ($conn->query($deleteQuery)) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . mysqli_error($conn);
	}

	if ($conn->query($deleteQuery2)) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . mysqli_error($conn);
	}

	mysqli_close($conn);

	header("Location: sellerAdmin.php");
	die();
?>