<?php    
// load up your config file
	require_once("../../resources/config.php");
	include("includes/AdminHeader.php");	 
?>


<?php 
	if(!empty($_GET['destination'])) {
		$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
		// Check connection
		if ($conn->connect_error) {
	    	die("Connection failed: " . $conn->connect_error);
		}

		$destinationId = $_GET['destination'];
		$destination_info = mysqli_query($conn, "SELECT * FROM destinations WHERE pkId = '$destinationId' LIMIT 1");
		$destination_info_row = mysqli_fetch_assoc($destination_info);

		echo 	
		 		'<h1>Manage destination</h1>' .
		 		'<div class="manage-desitnation">' .
				'<h2>Destination information</h2>' .
				'<span>Country: ' . $destination_info_row['country'] . '</span>' .
				'<span>Area: ' . $destination_info_row['area'] . '</span>' .
				'<span>Traveldate: ' . $destination_info_row['date'] . '</span>' .
				'</div>';

		$images = "SELECT * FROM images WHERE destinationId = '$destinationId'";
		$images_result = mysqli_query($conn, $images);


		if ($images_result->num_rows > 0) {
		    // output data of each row

		    echo 	'<div class="manage-desitnation-images">' .
		    	 	'<h2>Current images</h2>'; 	    		
		    while($row = $images_result->fetch_assoc()) {
		        echo '<img src=" ../../resources/uploads/' . $row['filepath'] . '" />';
		    }
		    echo 	'</div>';
		} else {
		    echo "0 Images at the moment";
		}

	$conn->close();

	}
	else {
		echo "Destination doesn't seem to exist!";
	}
?>

<div class="image-bank-sidebar">
	
</div>

<h2>Add new image</h2>
<form class="manage-destination-new-image" action="../../resources/templates/AddImage.php" method="post" enctype="multipart/form-data">
		<span>Destination</span>
		<?php
			$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
			$getDestinations = "SELECT * FROM destinations";
			$destinationResult = $result = mysqli_query($conn, $getDestinations);

				if ($destinationResult->num_rows > 0) {
				    // output data of each row
				    echo '<select name="destination">';
				    while($row = $destinationResult->fetch_assoc()) {
				        echo '<option value='.$row["pkId"].'>'.$row["country"] . " - " .$row["area"].'</option>';
				    }
				    echo '</select>';
				}
			$conn->close();
		?>
		<span>Set as coverimage for destination</span>
		<input type="checkbox" name="isCover" value="1">
		<span>Image</span>
		<input type="file" name="file">
		<input type="submit" name="submit" value="Submit">
</form>


<?php include("includes/AdminFooter.php"); ?>