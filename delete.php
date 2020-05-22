
<?php 

	include'config_db/database.php';

	try{

		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		else{
			echo "RECORD ID NOT FOUND: ";
		}

		$query = "DELETE FROM students WHERE id=?";

		$stmt= $con->prepare($query);

		$stmt->bindParam(1,$id);


		if($stmt->execute()){
			header('location: read.php?action=deleted');
		}	



	}
	catch(PDOexception $e){
		die('ERROR: '. $e->getMessage());
	}



?>

