<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 11:13 PM
     */
    include ('../headers/headerBase.php');
    include_once ('../dbInteractions/connection.php');
    include_once ('../dbInteractions/query.php');
    include_once ('../environment/env.php');

?>
    <!DOCTYPE html>
    <html>

    <body style="background-color:#CCC">
    <!-- Event takes the chosen event id, displays all info and messages about it,
            and accepts message input if the time is right -->

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
                                            //format the incoming timestamp
                                            $date = $message['date'];
                                            $messageDate = date($date);
                                            $day = date("F d, Y", strtotime("$messageDate"));
                                            $time = date("H:i:s", strtotime("$messageDate"));

                                            ?>
                                            <div class="single-message col-xs-12 col-sm-12 col-lg-12">
                                            <div class="message-header col-xs-12 col-sm-12 col-lg-12">
                                                <div
                                                    class="message-date-time col-xs-4 col-sm-4 col-lg-4"><?php echo $day . ' - ' . $time; ?></div>
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
                                            </div>
                                            <?php
                                        }

                                    ?>
                                </div>
                                <div class="insert-new-message-container col-xs-12 col-sm-12 col-lg-12">
                                    <?php include_once ('../messages/addMessage.php'); ?>
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


    ?>
    </body>
    </html>

<?php

    include_once ('../footers/footerBase.php');
