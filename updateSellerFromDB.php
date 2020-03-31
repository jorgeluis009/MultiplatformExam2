<?php
	$Servername = "localhost";
    $Username = "root";
    $pass = "";
    $database = "admindb";

    $conn = new mysqli($Servername,$Username,$pass,$database);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}	

	$id = $_POST['idEditSeller'];
	$totalSalesEdit = $_POST['totalSalesEdit'];
	$commissionEdit = $_POST['commissionEdit'];
	echo $id;
	
	$sql = "UPDATE sellers SET totalSales='$totalSalesEdit', commission='$commissionEdit' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . mysqli_error($conn);
	}

	mysqli_close($conn);
	header("Location: SellerAdmin.php");
	die();

?>