<?php
	require_once("../config.php");

	$conn = new mysqli($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);
	
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}

	//Get Values
	$country = $_POST["country"];
	$date = $_POST["date"];
	$area = $_POST["area"];

	//Insert into database
	$stmt = $conn->prepare("INSERT INTO destinations (country, date, area) VALUES (?, ?, ?)");
	$stmt->bind_param('sss', $country, $date, $area);
	$stmt->execute();

	$conn->close();
?>