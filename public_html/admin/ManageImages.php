<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
<?php    
// load up your config file
	require_once("../../resources/config.php");	 
?>

<?php 
 	$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	$sql = 'SELECT * FROM images';
	$result = mysqli_query($conn, $sql);


	if ($result->num_rows > 0) {
	    // output data of each row
	    echo "<h2>Current images</h2> <br>";
	    while($row = $result->fetch_assoc()) {
	        echo ' - Date: ' . $row["name"]. '<button id='.$row["pkId"].'>Delete</button>' . '<br>';
	    }
	} else {
	    echo "0 Images at the moment";
	}
$conn->close();
?>

	<h2>Add new image</h2>
	<form action="../../resources/templates/AddImage.php" method="post">
			<span>Destination</span>
			<?php
				$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
				$getDestinations = "SELECT * FROM destinations";
				$destinationResult = $result = mysqli_query($conn, $getDestinations);

					if ($destinationResult->num_rows > 0) {
					    // output data of each row
					    echo '<select name="destination">';
					    while($row = $destinationResult->fetch_assoc()) {
					        echo '<option value='.$row["pkId"].'>'.$row["country"] .$row["area"].'</option>';
					    }
					    echo '</select>';
					}
				$conn->close();
			?>
			<span>Name</span>
			<input type="text" name="name">
			<span>Set as coverimage for destination</span>
			<input type="checkbox" name="isCover" value="1">
			<span>Image</span>
			<input type="file" name="filepath">
			<input type="submit">
	</form>
 </body>
</html>