<?php
    $Servername = "localhost";
    $Username = "root";
    $pass = "";
    $database = "admindb";

    $conn = new mysqli($Servername,$Username,$pass,$database);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}	

	$id = $_POST['idAdd'];
	$client = $_POST['clientAdd'];
	$company = $_POST['CompanyAdd'];
    $concept = $_POST['ConceptAdd'];
    $amount = $_POST['AmountAdd'];
	$date = $_POST['DateAdd'];
    $validated = $_POST['ValidatedAdd'];

    ///////////////////////////////////////////////////////////////////////////

    $getTotalSales = "SELECT totalSales from sellers WHERE userID='$id'";
    $aux = $conn->query($getTotalSales);

    while ($row = mysqli_fetch_assoc($aux)) {
    	$totalSales = $row['totalSales'] + $amount;
    	$updateTotalSales = "UPDATE `sellers` SET `totalSales` = '$totalSales' WHERE `sellers`.`userID` = '$id';";
    	if ($conn->query($updateTotalSales)) {
    		echo "Record updated successfully";
    	} else {
    		echo "Error updating record: " . mysqli_error($conn);
    	}
    }	
    ////////////////////////////////////////////

    if($validated == 1) {
    	$newCom = $amount/10;
    	$commissionQuery = "SELECT commission from sellers WHERE userID='$id'";
		$result = $conn->query($commissionQuery);

    	while ($row = mysqli_fetch_assoc($result)) {
    		$commission = $row['commission'] + $newCom;
    		$updateQuery = "UPDATE `sellers` SET `commission` = '$commission' WHERE `sellers`.`userID` = '$id';";
			if ($conn->query($updateQuery)) {
				echo "Record updated successfully";
			} else {
				echo "Error updating record: " . mysqli_error($conn);
			}
    	}	
    }
    
    $insertQuery = "INSERT INTO sales (client, company, userID, concept, amount, date, validated) VALUES ('$client','$company','$id','$concept','$amount','$date','$validated');";

	if (mysqli_query($conn, $insertQuery)) {
	    echo "New record added successfully";
	} else {
	    echo "Error adding record: " . mysqli_error($conn);
	}

	mysqli_close($conn);

	header("Location: salesAdmin.php");
	die();
?>