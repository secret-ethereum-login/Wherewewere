<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/25/2016
     * Time: 8:10 PM
     */
    date_default_timezone_set('America/Chicago');
    $today = date('Y-m-d H:i:s');
    $id = $_GET['id'];

    ?>

    <div class="insert-message-body col-xs-12 col-sm-12 col-lg-12">

        <div class="insert-message-name col-xs-12 col-sm-12 col-lg-12">
            <input type="text" id="new-message-name" name="new-message-name" placeholder="Enter Name">
        </div>
        <div class="insert-message-message col-xs-12 col-sm-12 col-lg-12">
            <input type="text" id="new-message-message" name="new-message-message" placeholder="Enter Message">
            <input type="hidden" id="new-message-date" name="new-message-date" value="<?php echo $today; ?>">
            <input type="hidden" id="new-message-eventid" name="new-message-eventid" value="<?php echo $id; ?>">

        </div>
            <button type="submit" id="message-submit-button" class="btn-primary">Add Message</button>

    </div>


<?php
    //                    /* Submit message to specific event table if given */
    //                    if (isset($_POST['sentMessage'])) {
    //                        $table_name = "'$id'";
    //                        $message = $_POST['sentMessage'];
    //                        $stmt = $conn -> prepare(
    //                            "INSERT INTO `$table_name`
    //				VALUES(:message)");
    //                        $stmt -> bindParam(':message', $message);
    //                        $stmt -> execute();
    //                    }
    //
    //                    /* Select all info from events table then put into variables */
    //                    $qry = $conn -> prepare("SELECT * FROM `events` WHERE `id` LIKE :id");
    //                    $qry -> bindParam('id', $id);
    //                    $qry -> execute();
    //                    $eventInfo = $qry -> fetchAll();
    //                    $eventInfo = $eventInfo[0];
    //
    //                    $title = $eventInfo['Title'];
    //                    $description = $eventInfo['Description'];
    //                    $place = $eventInfo['Place'];
    //                    $date = $eventInfo['Date'];
    //                    $times = $eventInfo['Times'];
    //
    //                    // Create a new table for the event's messages
    //                    $qry = $conn -> prepare("SELECT `message`
    //			FROM `:eventID`");
    //                    $qry -> bindParam(':eventID', $id);
    //                    $qry -> execute();
    //                    $messages = $qry -> fetchAll();