<?php
	$eventID = $_POST['eventID'];
	$message = $_POST['message'];
	
	$conn = new PDO("mysql:host='127.0.0.1';dbname='wherewewere'");
    $stmt = $conn -> prepare("INSERT INTO `$eventID` VALUES(:message)");
	$stmt -> bindParam(':message', $message);
	$stmt -> execute();
?>