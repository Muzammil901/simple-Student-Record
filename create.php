<!DOCTYPE html>
<html>
<head>
	<title>Add New Students</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<script type="text/javascript">

 
		function timedMsg()
		{
		var t=setTimeout("document.getElementById('myMsg').style.display='none';",4000);
		}

	</script>
	<div class="container">
		<div  class="pb-2 mt-4 mb-2 border-bottom">
			<h1>Add New Student</h1>
		</div>

	<?php
		include 'config_db/database.php';

		try{
			$query = "INSERT INTO students SET name=:name, class=:class, address=:address, phoneNo=:phoneNo";
			$stmt = $con->prepare($query);

			$name = $_POST['name'];
			$class = $_POST['class'];
			$address = $_POST['address'];
			$phoneNo = $_POST['phoneNo'];


			$stmt->bindParam(':name' ,$name);
			$stmt->bindParam(':class' ,$class);
			$stmt->bindParam(':address' ,$address);
			$stmt->bindParam(':phoneNo' ,$phoneNo);

			if($stmt->execute()){
				echo "<div class='alert alert-success' role='alert'>";
				echo "<h5 id='myMsg'> student Added! </h5>";

				echo "<script language='JavaScript' type='text/javascript'>timedMsg()</script>";
				echo "</div>";

			}
		}
		catch(PDOexception $e){
			die('ERROR: '. $e->getMessage());
		}

	?>

	<form action="create.php" method="post">
		<table class="table table-bordered table-hover">
			<tr>
				<th scope="row"> Name </th>
				<td> <input type="text" name="name" class="form-control"> </td>
			</tr>
			<tr>
				<th scope="row"> Class </th>
			 	<td> <input type="text" name="class" class="form-control"> </td>
			</tr>
			<tr>
				<th scope="row"> Address </th>
				<td> <input type="text" name="address" class="form-control"> </td>
			</tr>
			<tr>
				<th scope="row"> PhoneNo </th>
				<td> <input type="number" name="phoneNo" class="form-control"> </td>
			</tr>
			<tr>
				<td colspan="2"> <a href="read.php" class='btn btn-primary'>Read Student Record</a>
				<input type="submit" value="save" class='btn btn-primary'> </td>
			</tr>

		</table>
	</form>
</div>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</body>
</html>