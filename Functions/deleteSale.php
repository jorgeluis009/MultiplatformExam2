<?php
	$id = $_POST['idT'];  
    $deleteQuery = "DELETE from sales where id = '$id'";

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

	header("Location: SalesAdmin.php");
	die();
?>