<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="indexstyle.css">
</head>
<body style="background-color:#CCC">

<table style="width:100%;height:600px;text-align:center">
	
	<tr style="height:10%">
	</tr>
	<tr>
		<td>
			<form action="index.html">
					<input type="submit" value="Go Home" style="font:10px openSansReg;border-radius:5px">
			</form>
		</td>
	</tr>
	<tr>
		<td>
		<?php
			// "Get" all info, create full_info variable, and QR code with info
			$title = $_GET['title'];
			$description = $_GET['description'];
			$place = $_GET['place'];
			$date = $_GET['date'];
			$startTime = $_GET['startTime'];
			$endTime = $_GET['endTime'];
			$timeDuration = $startTime . '-' . $endTime;
			
			$fullInfo = "$title $description taking place at $place on $date from $startTime to $endTime";
			
			echo "<img src='createQr.php?fullInfo=$fullInfo' style='border-radius:5px'>";
			
			$conn = new PDO('mysql:host=localhost;dbname=wherewewere','root','');
			
			//Select last ID from database so we can find the new ID
			$findID = $conn -> prepare("SELECT `id` FROM `events` ORDER BY `id` DESC LIMIT 1;");
			$findID -> execute();
			$lastID = $findID -> fetchAll();
			$lastID = $lastID[0]['id'];
			$newID = (int)$lastID + 1;
			
			// Add the new event to the events table
			$addID = $conn -> prepare("INSERT INTO `events` VALUES($newID,$title,$description,$place,
			$date,$timeDuration);");
			$addID -> bindParam(':newID', $newID);
			$addID -> bindParam(':title', $title);
			$addID -> bindParam(':description', $description);
			$addID -> bindParam(':place', $place);
			$addID -> bindParam(':date', $date);
			$addID -> bindParam(':timeDuration', $timeDuration);
			$addID -> execute();
			
			// Create a new table for the event's messages
			$create_event = $conn -> prepare("CREATE TABLE `event_:newID` values(`id` INTEGER(255), `message` VARCHAR(256));");
			$create_event -> bindParam(':newID', $newID);
			$create_event -> execute();
		?>
		</td>
	</tr>
	<tr>
		<td>
			<p>Title:</p>
			 <?php echo $title ?>
		</td>
	</tr>
	<tr>
		<td>
			<p>Description:</p>
			 <?php echo $description ?>
		</td>
	</tr>
	<tr>
		<td>
			<p>Place:</p>
			 <?php echo $place ?>
		</td>
	</tr>
	<tr>
		<td>
			<p>Date:</p>
			 <?php echo $date ?>
		</td>
	</tr>
	<tr>
		<td>
			<p>Time:</p>
			 <?php echo $timeDuration ?>
		</td>
	</tr>
	<tr>
		<td>		
		<?php
			//$qry = "SELECT `times` FROM `$eventid`";
			//$start_time = $qry['start_time'];
			//$end_time = $qry['end_time'];
			$start_stamp = time() - 100;
			//$start_stamp = date(strtotime("$start_time");
			//$end_stamp = date(strtotime("$end_time");
			$end_stamp = time() + 100;
		
			$current_stamp = time();
			if ($current_stamp <= $start_stamp) print "This event has not started!";
			elseif ($current_stamp >= $end_stamp) print "This event has ended!";
			else {
				print "</br>Leave a message!</br><input class='inputBox' type='text' name='title'></br>
						<form action='message.php'>
							<input type='submit' value='message' style='font:10px openSansReg;border-radius:5px;'>
						</form>";
			}
		?>
		</td>
	</tr>
	<tr style="height:10%">
	</tr>
</table>

</body>
</html>
