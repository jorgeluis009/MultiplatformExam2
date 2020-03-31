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

    // $sql = "UPDATE tabla_clientes SET nombre='$nombre', email='$email' WHERE id_cliente='$id'";
    
    $insertQuery = "INSERT INTO sales (client, company, concept, amount, date, validated) VALUES ('$client','$company','$concept','$amount','$date','$validated');";
    
    if($validated == 1) {
    	$newCom = $amount/10;
    	$commissionQuery = "SELECT commission from sellers WHERE userID='$id'";
		$result = $conn->query($sql);

    	while ($row = mysqli_fetch_assoc($result)) {
    		$commission = $row['commission'] + $newCom;
    		$updateQuery = "UPDATE `sellers` SET `commission` = '$commission' WHERE `sellers`.`userID` = '$id';";
			$result2 = $conn->query($sql);
    	}	
    }

	if (mysqli_query($conn, $insertQuery)) {
	    echo "New record added successfully";
	} else {
	    echo "Error adding record: " . mysqli_error($conn);
	}

	mysqli_close($conn);

	header("Location: salesAdmin.php");
	die();
?>