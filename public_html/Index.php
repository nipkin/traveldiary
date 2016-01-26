<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
<?php    
// load up your config file
	require_once("../resources/config.php");	 
?>
 <?php 
 	$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";

	$sql = 'SELECT * FROM destinations';
	$result = mysqli_query($conn, $sql);


	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "Country: " . $row["country"]. " - Area: " . $row["area"]. " Date " . $row["date"]. "<br>";
	    }
	} else {
	    echo "0 results";
	}
$conn->close();
?> 
 </body>
</html>