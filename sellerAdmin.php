<!DOCTYPE html>
<html>
<head>
	<title>Seller Administrator</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	  

</head>
<body>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Commission</th>
					<th scope="col">Edit</th>
					<th scope="col">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$Servername = "localhost";
				$Username = "root";
				$Password = "";
				$DBName = "admindb";

				$conn = mysqli_connect($Servername,$Username,$Password,$DBName);
				$sql = "SELECT users.id,users.user, sellers.commission FROM users INNER JOIN Sellers ON Sellers.userID=users.id";

				if(!$conn)
				{
					die("Connection error:". mysqli_connect_error());
				}
				$result = $conn->query($sql);
				if($result){
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td class="client"><?php echo $row['id']?></td>
							<td class="name"><?php echo $row['user']?></td>
							<td class="commission"><?php echo $row['commission']?></td>
							<td><button type="button" class="btn btn-primary edit" value="<?php echo $row['id'] ?>">
                            Edit</button></td>
                            <form action="deleteSeller.php" method="post">
                            <input type="hidden" name="idT" id="idT" value="<?php echo $row['id']?>">   
                                <td><button type="submit" class="btn btn-danger deleteBTN">Delete</button></td>
                            </form>
						</tr>
						<?php
					}
				}else{
					echo "No Results";
				}

				$conn->close();
				?>
			</tbody>
		</table>
		  <div class="pull-right">
            <button type="button" class="btn btn-success btn-lg btn-lock add">Add Seller</button>
        </div>
	</div>

</body>
</html>