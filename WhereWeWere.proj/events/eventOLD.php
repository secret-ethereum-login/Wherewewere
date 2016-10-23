<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 11:13 PM
     */
    include_once ('../headers/headerBase.php');
    include_once ('../dbInteractions/connection.php');
    include_once ('../dbInteractions/query.php');
    include_once ('../environment/env.php');

    ?>
    <!DOCTYPE html>
    <html>

    <body style="background-color:#CCC">
    <!-- Event takes the chosen event id, displays all info and messages about it,
            and accepts message input if the time is right -->
<!--    <table style="width:100%;height:600px;text-align:center">-->
<!---->
<!--        <tr style="height:10%">-->
<!--        </tr>-->
<!---->
<!--        <tr>-->
<!--            <td>-->
                <?php
                    $connections= dbConnection();
                    $id = $_GET['id'];
                    $theEvents = get_specific_event($connections, $id);
                    dbConnectionClose($connections);

                    $connections= dbConnection();
                    $theMessages = get_all_events_messages($connections, $id);
                    dbConnectionClose($connections);



                    $events = $theEvents;
                    $messages = $theMessages;
                    ?>
                <div class="event-content col-xs-12 col-sm-12 col-lg-12">
                    <div class="single-event-left-sidebar col-xs-0 col-sm-0 col-lg-2" ></div>
                <?php
                    if($events != NULL) {
                        foreach ($events as $event) {
                            $eventID = $event['id'];
                            $title = $event['title'];
                            $description = $event['description'];
                            ?>

                            <div class="single-event-listing col-xs-12 col-sm-12 col-lg-8 middle center rounded" >
                            <div class="event-title-and-id col-xs-12 col-sm-12 col-lg-12 ">
                                <div class="event-id col-xs-12 col-sm-12 col-lg-2 ">Event
                                    # <?php echo $eventID; ?></div>
                                <div
                                    class="event-title col-xs-12 col-sm-12 col-lg-10 center"><?php echo $title; ?></div>
                            </div>
                            <div class="event-description col-xs-12 col-sm-12 col-lg-12 center">
                                <?php
                                    echo $description;
                                ?>
                            </div>
                            <?php
                            if ($theMessages) {
                                ?>
                                <div class="event-messages col-xs-12 col-sm-12 col-lg-12 center">
                                <h2 class="col-xs-12 col-sm-12 col-lg-12 center">Messages :</h2>
                                <?php
                                foreach ($messages as $message) {
                                    ?>

                                    <div class="message-header col-xs-12 col-sm-12 col-lg-12">
                                        <div
                                            class="message-date-time col-xs-4 col-sm-4 col-lg-4"><?php echo $message['date'] . ' - ' . $message['time']; ?></div>
                                        <div class="message-user col-xs-8 col-sm-8 col-lg-8">
                                            <?php
                                                //get the user associated with the message
                                                $userid= $message['userid'];
                                                $connections= dbConnection();
                                                $theUser = get_a_user_for_a_message($connections, $userid);
                                                dbConnectionClose($connections);
                                                foreach ($theUser as $user) {
                                                    echo $user['name'];
                                                }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="message-body  col-xs-12 col-sm-12 col-lg-12">
                                        <?php echo $message['message']; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                                    <?php
                                     }
                                     ?>
                            </div>

                            <?php
                        }
                    }
?>
                    <div class="single-event-right-sidebar col-xs-0 col-sm-0 col-lg-2" ></div>
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
//                ?>
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                <p>Title:</p>-->
<!--                --><?php //echo $title ?>
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                <p>Description:</p>-->
<!--                --><?php //echo $description ?>
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                <p>Place:</p>-->
<!--                --><?php //echo $place ?>
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                <p>Date:</p>-->
<!--                --><?php //echo $date ?>
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                <p>Time:</p>-->
<!--                --><?php //echo $times ?>
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                --><?php
//                    $start_stamp = time() - 100;
//                    $end_stamp = time() + 100;
//
//                    /* Print all the grabbed messages onto the event page */
//                    print '<h1 style="font-size:150%"></br>Messages:</h1>';
//                    print '<div style="height:100px;width:150px;margin:0 auto;overflow-y:auto">';
//                    foreach ($messages as $message) {
//                        print $message['message'];
//                        print '</br></br>';
//                    }
//                    print '</div>';
//
//                    /* Message box for when the time is right */
//                    $table_name = "'$id'";
//                    print '<form action="event.php?id='.$id.'" method="post">
//						</br>Leave a message!</br>
//						<input class="inputBox" type="text" name="sentMessage"></br>
//						<input type="submit" value="Message" style="font:10px openSansReg;border-radius:5px;">
//					</form>';
//                ?>
<!--            </td>-->
<!--        </tr>-->
<!--        <tr style="height:10%">-->
<!--        </tr>-->
<!--    </table>-->

    </body>
    </html>

<?php

    include_once ('../footers/footerBase.php');
