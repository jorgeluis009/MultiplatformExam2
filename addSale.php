<!DOCTYPE html>
<html>
<head>
	<title>Add Sale</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<form method="post">
			<table>
				<tr>
					<td>
						Fill all the information
					</td>
				</tr>
				<tr>
					<td>
						Client Name
					</td>
					<td>
						<input type="text" name="Client" placeholder="Client Name" />
					</td>
				</tr>
				<tr>
					<td>
						Company Name
					</td>
					<td>
						<input type="text" name="Company" placeholder="Company Name" />
					</td>
				</tr>
				<tr>
					<td>
						Sale Concept
					</td>
					<td>
						<input type="text" name="Concept" placeholder="Sale Concept" />
					</td>
				</tr>
				<tr>
					<td>
						Sale Amount
					</td>
					<td>
						<input type="number" name="Amount" placeholder="Sale Amount" />
					</td>
				</tr>
				<tr>
					<td>
						Sale Date
					</td>
					<td>
						<input type="date" name="Date" placeholder="Sale Date" />
					</td>
					<tr>
						<td>
							<input type="submit" name="submitBtn" value="submit" />
						</td>
					</tr>
				</table>
			</form>
		</div>
		<form action="SalesAdmin.php">
			<input type="submit" name="submitBtn" value="Return" />
		</form>

		<?php
		function validateFields(){
			if(empty($_POST['Client'])){
				echo "Client is null or empty<br>";
				$isValid = false;
			}
			if(empty($_POST['Company'])){
				echo "Company is null or empty<br>";
				$isValid = false;
			}
			if(empty($_POST['Concept'])){
				echo "Concept is null or empty<br>";
				$isValid = false;
			}
			if(empty($_POST['Amount'])){
				echo "Amount is null or empty<br>";
				$isValid = false;
			}
			if(empty($_POST['Date'])){
				echo "Date is null or empty<br>";
				$isValid = false;
			}

			return $isValid;
		}

		if(isset($_POST['submitBtn'])) {

			$isValid = true;
			
			if(validateFields()) {
				$sql = "INSERT INTO sales (client, company, concept, amount, date,validated) VALUES ('" . trim($_POST['Client']) . "', '" . trim($_POST['Company']) . "', '" . trim($_POST['Concept']) . "', '" . $_POST['Amount'] . "', '" . $_POST['Date'] . "', 1)";

				$Servername = "localhost";
				$Username = "root";
				$Password = "";
				$DBName = "admindb";

				$conn = mysqli_connect($Servername,$Username,$Password,$DBName);

				if(!$conn)
				{
					die("Fallo la conexion:". mysqli_connect_error());
				}


				if(mysqli_query($conn,$sql)){
					echo "Registro insertado correctamente...";
				}else{
					echo "Error ". $sql . "<br>" . mysqli_error();
				}

				mysqli_close($conn);

			}
		}
		
		?>


	</body>
	</html>