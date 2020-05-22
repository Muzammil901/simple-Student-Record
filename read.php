<!DOCTYPE html>
<html>
<head>
	<title>Feeds</title>
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
			<h1>Read Student Records</h1>
		</div>
	<?php
	try{
		include'config_db/database.php';

		//deletion alert
		$action = isset($_GET['action']) ? $_GET['action'] : "";
		if($action == 'deleted'){
			echo "<div class='alert alert-danger' role='alert'>";
			echo "<h4 id='myMsg'> Delete Successfull! </h4>";
			echo "<script language='JavaScript' type='text/javascript'>timedMsg()</script>";
			echo "</div>";
		}
		

		$query = "SELECT * FROM students";
		$stmt = $con->prepare($query);

		$stmt->execute();

		 $row = $stmt->rowCount();

		 echo "<table class='table table-bordered'> <thead class='thead-light'> <tr> <th scope='col'> Id </th> <th scope='col'> Name </th> <th scope='col'> Class </th> <th scope='col'> Address </th> <th scope='col'> PhoneNo </th> <th scope='col' colspan='2'></th> </tr> </thead>";

		 for($j=0; $j<$row; $j++){
		 	$rows = $stmt->fetch(PDO::FETCH_ASSOC);

		 	echo "<tbody>";
		 	echo"<tr>";
			
			echo"<th scope='row'>{$rows['id']}</th>";
			echo"<td>{$rows['name']}</td>";
			echo"<td>{$rows['class']}</td>";
			echo"<td>{$rows['address']}</td>";
			echo"<td>{$rows['phoneNo']}</td>";

			echo "<td> <a href='update.php?id={$rows['id']}' class='btn btn-primary' >Edit</a> </td>";

			echo "<td> <a href='delete.php?id={$rows['id']}' class='btn btn-danger'>Delete</a> </td>";
			
		 	echo "</tr>";
		 	echo "</tbody>";

		 }
		 echo "<td colspan='7'> <a href='create.php' class='btn btn-primary'> Add new student </a> </td>";
		 echo"</table>";



		
	}
	catch(PDOexception $e){
		die('ERROR: '. $e->getMessage());
	}

		?>
	</div>

	<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "http://localhost/crudp2/read.php");
    }
</script>
	

</body>
</html>