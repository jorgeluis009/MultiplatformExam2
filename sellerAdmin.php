<!DOCTYPE html>
<html>
<head>
	<title>Seller Administrator</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
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
				$sql = "SELECT users.id,users.user, sellers.commission, sellers.totalSales FROM users INNER JOIN Sellers ON Sellers.userID=users.id";

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
							<td class="name">$<?php echo $row['totalSales']?></td>
							<td class="commission">$<?php echo $row['commission']?></td>
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
            <button type="button" class="btn btn-success btn-lg btn-lock addBtn">Add Seller</button>
        </div>
        <!-- ****************** MODAL ADD ****************** -->
        <div class="modal fade" id="AddModal" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content">          
        			<div class="modal-header">
        				<h4 class="modal-title">Add Sale</h4>
        				<button type="button" class="close" data-dismiss="modal">&times;</button>

        			</div>

        			<form action="addSaleToDB.php" method="post">
        				<div class="modal-body">           
        					<label>Client</label><br>
        					<input class="form-control" type="text" name="clientAdd" id="clientAddID">
        					<label>Company</label><br>
        					<input class="form-control" type="text" name="CompanyAdd" id="CompanyAddID">
        					<label>Concept</label><br>
        					<input class="form-control" type="text" name="ConceptAdd" id="ConceptAddID">   


        					<label>Amount</label><br>
        					<div class="input-group mb-3">
        						<div class="input-group-prepend">
        							<span class="input-group-text">$</span>
        						</div>
        						<input class="form-control" type="number"  min="0" name="AmountAdd" id="AmountAddID">   
        					</div>

        					<label>Date</label><br>
        					<input class="form-control" type="date" name="DateAdd" id="DateAddID">  <br>
        					<label>Validated</label><br>

        					<div class="custom-control custom-radio custom-control-inline">
        						<input type="radio" class="custom-control-input" id="validate1" value=1 name="ValidatedAdd">
        						<label class="custom-control-label" for="validate1">Yes</label>
        					</div>
        					<div class="custom-control custom-radio custom-control-inline">
        						<input type="radio" class="custom-control-input" id="validate0" value=0 name="ValidatedAdd">
        						<label class="custom-control-label" for="validate0">No</label>
        					</div>

        					<!-- <input class="form-control" type="number" step="10" name="ValidatedAdd" id="ValidatedAddID"> -->
        				</div>

        				<div class="modal-footer">
        					<input type="submit" class="btn btn-success" value="Submit">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				</div>
        			</form>
        		</div>

        	</div>
        </div> 
        <!-- ****************** END MODAL ADD *************************** -->

	</div>
	<script>

	(function(init) {
		init(window.jQuery, window, document);
	}(function($, window, document) {

	$(function() {
	   	// DOM ready!
	   	var addBtn 	= $(".addBtn");
	   	var editBtn = $(".editBtn");

	   	addBtn.on("click", function() {
	   		$('#AddModal').modal('toggle');
	   	});

	   	editBtn.on("click", function() {
	   		var aux  = $(this).closest("tr").find(".client").text();
	   		var aux2 = $(this).closest("tr").find(".company").text();
	   		var aux3 = $(this).closest("tr").find(".concept").text();
	   		var aux4 = $(this).closest("tr").find(".amount").text();
	   		var aux5 = $(this).closest("tr").find(".date").text();
	   		var aux6 = $(this).closest("tr").find(".validated").text();
	   		var aux7 = $(this).closest("tr").find(".id").text();

	   		var amount = aux4.substring(1);
	   		console.log(aux+' '+aux2+' '+aux3+' '+aux4+ ' '+ aux5+' '+ aux6+' id->'+ aux7);
	   		$('#clientEditID').val(aux);
	   		$('#CompanyEditID').val(aux2);
	   		$('#ConceptEditID').val(aux3);
	   		$('#amountEditID').val(amount);
	   		$('#dateEditID').val(aux5);
	   		if(aux6 == 1)
	   			$('#validateEdit1ID').prop("checked", true);
	   		else
	   			$('#validateEdit0ID').prop("checked", true);

	   		$('#idEditID').val(aux7);

	   		$('#EditModal').modal('toggle'); 
   	});		

   });

		}));

	</script>   
</body>
</html>