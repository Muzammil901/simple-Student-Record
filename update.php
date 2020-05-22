<!DOCTYPE html>
<html>
<head>
	<title>Edit Student Record</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<?php
		$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

		include 'config_db/database.php';
		try{
			

			$query = "SELECT * FROM students WHERE id= ?";

			$stmt = $con->prepare($query);

			$stmt->bindParam(1,$id);

			$stmt->execute();


			$rows = $stmt->fetch(PDO::FETCH_ASSOC);

			$name = $rows['name'];
			$class = $rows['class'];
			$address = $rows['address'];
			$phoneNo = $rows['phoneNo'];
			


		}

		catch(PDOexception $e){
			die('ERROR: '. $e->getMessage());
		}

	?>
	<script type="text/javascript">

 
		function timedMsg()
		{
		var t=setTimeout("document.getElementById('myMsg').style.display='none';",4000);
		}

	</script>
		<div class="container">
			<div  class="pb-2 mt-4 mb-2 border-bottom">
				<h1>Update Student Record</h1>
			</div>

	<?php 

		if($_POST){
			try{
				$query = "UPDATE students SET name=:name, class=:class, address=:address, phoneNo=:phoneNo WHERE id=:id";

				$stmt = $con->prepare($query);


				//getting values from form down below
				$name = $_POST['name'];
				$class = $_POST['class'];
				$address = $_POST['address'];
				$phoneNo = $_POST['phoneNo'];


				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':class', $class);
				$stmt->bindParam(':address' ,$address);
				$stmt->bindParam(':phoneNo' ,$phoneNo);
				$stmt->bindParam(':id',$id);

			if($stmt->execute()){
				echo "<h4 id='myMsg'> Edit Successfull! </h4>";
				echo "<script language='JavaScript' type='text/javascript'>timedMsg()</script>";

			}
		}
		catch(PDOexception $e){
			die('ERROR: '. $e->getMessage());
		}
	}

	?>

		<form action="update.php?id=<?php echo $id ?>" method="POST">
			<table class="table table-bordered table-hover">
			<tr>
				<th scope="row"> Name </th>
				<td> <input type="text" name="name" value="<?php echo $name ?>" class="form-control"> </td>
			</tr>
			<tr>
				<th scope="row"> Class </th>
				<td> <input type="text" name="class" value="<?php echo $class ?>" class="form-control"> </td>
			</tr>
			<tr>
				<th scope="row"> Address </th>
				<td> <input type="text" name="address" value="<?php echo $address ?>" class="form-control"> </td>
			</tr>
			<tr>
				<th scope="row"> PhoneNo </th>
				<td> <input type="number" name="phoneNo" value="<?php echo $phoneNo ?>" class="form-control"> </td>
			</tr>
			<tr>
				<td colspan="2"> <a href="read.php" class="btn btn-primary">Read Student Record</a>
				<input type="submit" value="save" class="btn btn-primary"> </td>
			</tr>

		</table>
		</form>
	</div>
</body>
</html>