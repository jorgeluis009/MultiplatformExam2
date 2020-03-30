<!DOCTYPE html>
<html>
<head>
	<title>Sales Admin</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="jumbotron text-center">
		<h1 class="display-1">Sales Administrator</h1>
		<h5>You can add/edit/delete all sales here.</h5>
		<footer class="blockquote-footer">By <cite title="Source Title">Jorge Villalobos</cite></footer>
	</div>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Client</th>
					<th scope="col">Company</th>
					<th scope="col">Concept</th>
					<th scope="col">Amount</th>
					<th scope="col">Date</th>
					<th scope="col">Validated</th>
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
				$sql = "SELECT * FROM `sales`";

				if(!$conn)
				{
					die("Connection error:". mysqli_connect_error());
				}
				$result = $conn->query($sql);
				if($result){
					while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td class="client"><?php echo $row['client']?></td>
							<td class="company"><?php echo $row['company']?></td>
							<td class="concept"><?php echo $row['concept']?></td>
							<td class="amount"><?php echo $row['amount']?></td>
							<td class="date"><?php echo $row['date']?></td>
							<td class="validated"><?php echo $row['validated']?></td>
							 <td><button type="button" class="btn btn-primary edit" value="<?php echo $row['id_cliente'] ?>">
                            Edit</button></td>
                            <form action="deleteFromDB.php" method="post">
                            <input type="hidden" name="idT" id="idT" value="<?php echo $row['id_cliente']?>">   
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
		<div class="text-center">			
			<button type="button" class="btn btn-success btn-lg btn-lock addBtn">New Sale</button>
		</div> <br
>
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
							<input class="form-control" type="number" name="AmountAdd" id="AmountAddID">   
							<label>Date</label><br>
							<input class="form-control" type="date" name="DateAdd" id="DateAddID">  
							<label><strong>Validated</strong></label><br>
							
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="validate1" value=1 name="ValidatedAdd">
								<label class="custom-control-label" for="validate1">Yes</label>
							</div>
						    <div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="validate0" value=0 name="ValidatedAdd">
								<label class="custom-control-label" for="validate0">No</label>
							</div>

							<!-- <input class="form-control" type="number" name="ValidatedAdd" id="ValidatedAddID"> -->
						</div>

						<div class="modal-footer">
							<input type="submit" class="btn btn-success" value="Submit">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
   		var addBtn 	  = $(".addBtn");
   		var editBtn   = $(".editBtn");
   		var deleteBtn = $(".deleteBtn");

		addBtn.on("click", function() {
			console.log("jeje");
	   		$('#AddModal').modal('toggle');
			console.log("jeje2");
	   		// $('#id').val($(this).val());
		});

   });

   }));

	</script>   
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Link de Github:
    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>