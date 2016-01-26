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
 	$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password']);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
?> 
 </body>
</html>