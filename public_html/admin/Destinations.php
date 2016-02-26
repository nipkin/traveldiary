<?php    
// load up your config file
	require_once("../../resources/config.php");
	include("includes/AdminHeader.php");	 
?>

<?php 
 	$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	$sql = 'SELECT * FROM destinations';
	$result = mysqli_query($conn, $sql);


	if ($result->num_rows > 0) {
	    // output data of each row
	    echo "<h2>Current destinations</h2>";
	    echo '<ul class="destination-list">';
	    while($row = $result->fetch_assoc()) {
	        echo '<li class="destination-list__item"><a href="ManageDestination.php?destination=' . $row["pkId"] . '">Country: ' . $row["country"] . ' - Area: ' . $row["area"] . '</a></li>';
	    }
	    echo "</ul>";
	} else {
	    echo "0 Destinations at the moment";
	}
$conn->close();
?>

	<h2>Add new destination</h2>
	<form class="destinations-add-new" action="../../resources/templates/AddDestination.php" method="post">
			<span>Country:</span>
			<input type="text" name="country">
			<span>Area</span>
			<input type="text" name="area">
			<span>Date(yyyy-mm-dd)</span>
			<input type="text" name="date">
			<input type="submit" value="Save">
	</form>

<?php include("includes/AdminFooter.php"); ?>