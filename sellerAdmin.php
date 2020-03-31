<!DOCTYPE html>
<html>
<head>
	<title>Seller Administrator</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

	<div class="jumbotron text-center" style="margin-bottom:0; ">
		<div class="container">
			<h3 class="display-1">Seller Administrator For Managers</h3>
			<h5>You can add/edit/delete all sales here.</h5>
			<footer class="blockquote-footer">By <cite title="Source Title">Jorge Villalobos</cite></footer>

		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
		<a class="navbar-brand" href="#">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="salesAdmin.php">Sales Admin. <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Features</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="">Log-out</a>
				</li>
			</ul>
		</div>
	</nav>	  


</head>
<body>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Seller</th>
					<th scope="col">Total sales</th>
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
				$sql = "SELECT sellers.id,users.user, sellers.commission, sellers.totalSales FROM users INNER JOIN Sellers ON Sellers.userID=users.id";

				if(!$conn)
				{
					die("Connection error:". mysqli_connect_error());
				}
				$result = $conn->query($sql);
				if($result){
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td class="idInput"><?php echo $row['id']?></td>
							<td class="name"><?php echo $row['user']?></td>
							<td class="totalSalesInput">$<?php echo $row['totalSales']?></td>
							<td class="commissionInput">$<?php echo $row['commission']?></td>
							<td><button type="button" class="btn btn-primary editBtn" value="<?php echo $row['id'] ?>">
                            Edit</button></td>
                            <form action="deleteSellerFromDB.php" method="post">
                            <input type="hidden" name="idDeleteSeller" value="<?php echo $row['id']?>">   
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
            <button type="button" class="btn btn-success btn-lg btn-lock addBtn">Add Seller</button>
        </div>

        <!-- ****************** MODAL ADD ****************** -->
        <div class="modal fade" id="AddModal" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content">          
        			<div class="modal-header">
        				<h4 class="modal-title">Add Seller</h4>
        				<button type="button" class="close" data-dismiss="modal">&times;</button>

        			</div>

        			<form action="addSellerToDB.php" method="post">
        				<div class="modal-body">           
        					<label>User</label><br>
        					<select id='mySelect' name="idUserAdd" class="form-control" style="width: 100%">
        						<option></option>
        					</select><br>
        				</div>

        				<div class="modal-footer">
        					<input type="submit" class="btn btn-success" value="Add Seller">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				</div>
        			</form>
        		</div>

        	</div>
        </div> 
        <!-- ****************** END MODAL ADD *************************** -->

        <!-- *************** MODAL EDIT*************** -->
        <div class="modal fade" id="EditModal" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content">          
        			<div class="modal-header">
        				<h4 class="modal-title">Edit Section</h4>    
        				<button type="button" class="close" data-dismiss="modal">&times;</button>     
        			</div>
        			<form action="updateSellerFromDB.php" method="post">
        				<div class="modal-body">           
        					<label>Total Sales</label><br>
        					<input class="form-control" type="number" name="totalSalesEdit" id="totalSalesEditID">
        					<label>Commission</label><br>
        					<input class="form-control" type="number" name="commissionEdit" id="commissionEditID">

        					<input type="hidden" name="idEditSeller" id="idEditID"> 
        				</div>
        				<div class="modal-footer">
        					<input type="submit" class="btn btn-success" value="Submit">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				</div>
        			</form>

        		</div>
        	</div>
        </div> 
        <!-- *************** END MODAL EDIT*************** -->
    </div>
	<script>

	(function(init) {
		init(window.jQuery, window, document);
	}(function($, window, document) {

	$(function() {
	   	// DOM ready!
	   	var addBtn 	= $(".addBtn");
	   	var editBtn = $(".editBtn");

		$("#mySelect").select2({
			placeholder: 'Select User',
			allowClear: true,
			ajax: { 
				url: "getUsers.php",
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
		      searchTerm: params.term // search term
			  };
			},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});

	   	addBtn.on("click", function() {
	   		$('#AddModal').modal('toggle');
	   	});

	   	editBtn.on("click", function() {
	   		var aux  = $(this).closest("tr").find(".totalSalesInput").text();
	   		var aux2 = $(this).closest("tr").find(".commissionInput").text();
	   		var aux7 = $(this).closest("tr").find(".idInput").text();


	   		$('#totalSalesEditID').val(aux);
	   		$('#commissionEditID').val(aux2);


	   		$('#idEditID').val(aux7);

	   		$('#EditModal').modal('toggle'); 
   		});		

   });

		}));

	</script>   
</body>
</html>