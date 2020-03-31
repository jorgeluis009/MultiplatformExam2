<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<br>
<div class="container">



	<div class="card">
		<article class="card-body">
			<h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
			<hr>
			<p class="text-success text-center">Please enter your information.</p>
				<form method="post">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Username</label>
	    <input type="text" class="form-control" name="userInput" aria-describedby="UserHelp" placeholder="Enter user" value="">
	  </div>
	  <div class="form-group">
	    <label for="PasswordID">Password</label>
	    <input type="password" class="form-control" name="passInput" placeholder="Password" value="">
	  </div>

	  <button type="submit" id="submitID" name="submitBtn" class="btn btn-primary">Submit</button>
	</form>
		</article>
	</div> 


	<?php
		if(isset($_POST['submitBtn'])){
			$Servername = "localhost";
			$Username = "root";
			$Password = "";
			$DBName = "admindb";
			$conn = mysqli_connect($Servername,$Username,$Password,$DBName);

			if(!$conn)
			{
		   		die("Fallo la conexion:". mysqli_connect_error());
			}
			

		   	$sql = "SELECT * FROM users WHERE user = '" . $_POST['userInput'] . "' AND pass = '" . $_POST['passInput']."'";
		   	
		  	$result = $conn->query($sql);
		  	if($result && $result->num_rows == 1) {
		  		while ($row = mysqli_fetch_assoc($result)) {
		  			$idT = $row['id'];
		  			$sql2 = "SELECT managers.userID as id FROM managers where managers.userID = '$idT'";
		  			$result2 = $conn->query($sql2);
	  				
	  				session_start();
	  				if($result2 && $result2->num_rows > 0) {
						$_SESSION['role'] = 'manager';
	  				}
	  				else{
	  					$_SESSION['role'] = 'seller';
	  				}
		  		}
   				header("Location: salesadmin.php");
		   	}
		   	else {
	   			echo "User not found";
		   	}
		    $conn->close();
		}
	?>
</div>
</body>
</html>