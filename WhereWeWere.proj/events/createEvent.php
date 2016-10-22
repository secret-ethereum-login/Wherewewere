<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 11:13 PM
     */
    include_once ('../headers/headerBase.php');

    ?>
    <!DOCTYPE html>
    <html>

    <body style="background-color:#CCC">
    <!-- Event takes the chosen event id, displays all info and messages about it,
            and accepts message input if the time is right -->
    <table style="width:100%;height:600px;text-align:center">

        <tr style="height:10%">
        </tr>
        <tr>
            <td>
                <form action="index.php">
                    <input type="submit" value="Go Home" style="font:10px openSansReg;border-radius:5px">
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                    $conn = new PDO('mysql:host=localhost;dbname=whatpzcp_wherewewere','root','');

                    $id = $_GET['id'];

                    /* Submit message to specific event table if given */
                    if (isset($_POST['sentMessage'])) {
                        $table_name = "'$id'";
                        $message = $_POST['sentMessage'];
                        $stmt = $conn -> prepare(
                            "INSERT INTO `$table_name`
				VALUES(:message)");
                        $stmt -> bindParam(':message', $message);
                        $stmt -> execute();
                    }

                    /* Select all info from events table then put into variables */
                    $qry = $conn -> prepare("SELECT * FROM `events` WHERE `id` LIKE :id");
                    $qry -> bindParam('id', $id);
                    $qry -> execute();
                    $eventInfo = $qry -> fetchAll();
                    $eventInfo = $eventInfo[0];

                    $title = $eventInfo['Title'];
                    $description = $eventInfo['Description'];
                    $place = $eventInfo['Place'];
                    $date = $eventInfo['Date'];
                    $times = $eventInfo['Times'];

                    // Create a new table for the event's messages
                    $qry = $conn -> prepare("SELECT `message` 
			FROM `:eventID`");
                    $qry -> bindParam(':eventID', $id);
                    $qry -> execute();
                    $messages = $qry -> fetchAll();
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
                <?php echo $times ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                    $start_stamp = time() - 100;
                    $end_stamp = time() + 100;

                    /* Print all the grabbed messages onto the event page */
                    print '<h1 style="font-size:150%"></br>Messages:</h1>';
                    print '<div style="height:100px;width:150px;margin:0 auto;overflow-y:auto">';
                    foreach ($messages as $message) {
                        print $message['message'];
                        print '</br></br>';
                    }
                    print '</div>';

                    /* Message box for when the time is right */
                    $table_name = "'$id'";
                    print '<form action="event.php?id='.$id.'" method="post">
						</br>Leave a message!</br>
						<input class="inputBox" type="text" name="sentMessage"></br>
						<input type="submit" value="Message" style="font:10px openSansReg;border-radius:5px;">
					</form>';
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
