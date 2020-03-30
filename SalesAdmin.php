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
					<th scope="col">#</th>
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
							<td class="id"><?php echo $row['id']?></td>
							<td class="client"><?php echo $row['client']?></td>
							<td class="company"><?php echo $row['company']?></td>
							<td class="concept"><?php echo $row['concept']?></td>
							<td class="amount">$<?php echo $row['amount']?></td>
							<td class="date"><?php echo $row['date']?></td>
							<td class="validated"><?php echo $row['validated']?></td>
							<td><button type="button" class="btn btn-primary editBtn" value="<?php echo $row['id'] ?>">
                            Edit</button></td>
                            <form action="deleteSaleFromDB.php" method="post">
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
		<div class="text-center">			
			<button type="button" class="btn btn-success btn-lg btn-lock addBtn">New Sale</button>
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

		<!-- *************** MODAL EDIT*************** -->
		<div class="modal fade" id="EditModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">          
					<div class="modal-header">
						<h4 class="modal-title">Edit Section</h4>    
						<button type="button" class="close" data-dismiss="modal">&times;</button>     
					</div>
					<form action="updateSaleFromDB.php" method="post">
						<div class="modal-body">           
							<label>Client</label><br>
							<input class="form-control" type="text" name="clientEdit" id="clientEditID">
							<label>Company</label><br>
							<input class="form-control" type="text" name="companyEdit" id="CompanyEditID">
							<label>Concept</label><br>
							<input class="form-control" type="text" name="conceptEdit" id="ConceptEditID">   
							
							<label>Amount</label><br>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input class="form-control" type="number" min="0" name="amountEdit" id="amountEditID">   
							</div>

							<label>Date</label><br>
							<input class="form-control" type="Date" name="dateEdit" id="dateEditID">  <br>
							
							<label>Validated</label><br>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="validateEdit1ID" value=1 name="validatedEdit">
								<label class="custom-control-label" for="validateEdit1ID">Yes</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="validateEdit0ID" value=0 name="validatedEdit">
								<label class="custom-control-label" for="validateEdit0ID">No</label>
							</div>
							<input type="hidden" name="idEdit" id="idEditID"> 
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
   		var addBtn 	  = $(".addBtn");
   		var editBtn   = $(".editBtn");

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

<footer class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3">Github Link:
    <a href="https://github.com/jorgeluis009/MultiplatformExam2"> Apps Multiplataforma 2020</a>
  </div>
</footer>
</body>
</html>