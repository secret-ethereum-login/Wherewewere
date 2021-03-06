<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 10:46 PM
     */
    include_once ('../headers/headerBase.php');
    //need to abstract this out some and create a controller that handles the dB interactions
    ?>
    <!DOCTYPE html>
    <html>

    <body style="background-color:#CCC">
    <!-- new comes after create and will only be seen once by the creator -->
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
                    $conn = new PDO('mysql:host=localhost;dbname=whatpzcp_wherewewere','root','');

                    /* Get all info, create full_info variable, and display QR code */
                    $new = $_GET['new'];
                    $title = $_GET['title'];
                    $description = $_GET['description'];
                    $place = $_GET['place'];
                    $date = $_GET['date'];
                    $startTime = $_GET['startTime'];
                    $endTime = $_GET['endTime'];
                    $timeDuration = $startTime . '-' . $endTime;

                    $fullInfo = "$title $description taking place at $place on $date from $startTime to $endTime";

                    if ($new) echo "<img src='createQr.php?fullInfo=$fullInfo' style='border-radius:5px'>";

                    /* Select last ID from database so we can make a new ID */
                    $findID = $conn -> prepare("SELECT `id` FROM `events` ORDER BY `id` DESC LIMIT 1;");
                    $findID -> execute();
                    $lastID = $findID -> fetchAll();
                    $lastID = $lastID[0]['id'];
                    $newID = (int)$lastID + 1;

                    /* Add the new event to the events table */
                    $addID = $conn -> prepare("INSERT INTO `events` 
			VALUES(:newID,
			:title,
			:description,
			:place,
			:date,
			:timeDuration);");
                    $addID -> bindParam(':newID', $newID);
                    $addID -> bindParam(':title', $title);
                    $addID -> bindParam(':description', $description);
                    $addID -> bindParam(':place', $place);
                    $addID -> bindParam(':date', $date);
                    $addID -> bindParam(':timeDuration', $timeDuration);
                    $addID -> execute();

                    /* Create a new table for the event's messages */
                    $create_event = $conn -> prepare("CREATE TABLE 
			`:newID`
			(`message` VARCHAR(256));");
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
                        $table_name = "'$newID'";
                        print '<form action="event.php?id='.$newID.'" method="post">
						</br>Leave a message!</br>
						<input class="inputBox" type="text" name="sentMessage"></br>
						<input type="submit" value="Message" style="font:10px openSansReg;border-radius:5px;">
					</form>';
                    }
                ?>
            </td>
        </tr>
        <tr style="height:10%">
        </tr>
    </table>

    </body>
    </html>

<?php
    include_once ('../footers/footerBase.php');

