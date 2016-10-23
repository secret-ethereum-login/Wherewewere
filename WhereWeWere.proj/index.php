<?php
    session_start();
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 10:33 PM
     */
    include_once ('curl/locationCurl.php');
    include_once ('dbInteractions/connection.php');
    include_once ('environment/env.php');
    include_once ('dbInteractions/query.php');

    $ip_address =  $_SERVER['REMOTE_ADDR'];
    $user_info = curl_get_location($ip_address);
    $city = $user_info['city'];
    $cookie_name = "city";
    $cookie_value = $city;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
   include_once ('headers/headerBase.php');



    ?>
<html>



<body class="body-basic col-xs-12 col-sm-12 col-lg-12">

<!--<h2 id="theHeader">The standard Lorem Ipsum passage, used since the 1500s</h2>-->
<div class="theContent col-xs-12 col-sm-12 col-lg-8 rounded" style="">

    A one-time time-capsule of information stored into the blockchain that can only be created by participants during the event (2-5 hrs) via smart contract.

    (no accounts or anything for the proof-of-concept), one can make an event or see other events on it. When an event is made, a corresponding smart contract will be made with the title and description and a QR code will be given to the host. When the event time starts, people who follow the correct URL at the right time can post to the site which the posts a TX with the message from the site address to the event address. The event address will only accept input from the sitewide site address.
</div>
<div class="the-event-listing col-xs-12 col-sm-12 col-lg-3 center rounded">
    <?php

        $connections= dbConnection();
        $theEvents = get_all_events($connections);
        dbConnectionClose($connections);

    ?>
    <div class="the-event-header col-xs-12 col-sm-12 col-lg-12">
        Recent Events :
    </div>
    <!-- Write all event titles as hyperlinks to their info/messages -->
    <div class="the-event-links col-xs-12 col-sm-12 col-lg-12">
        <?php

            $events = $theEvents;
            if($events != NULL) {
                foreach ($events as $event) {
                    $eventID = $event['id'];
                    $title = $event['title'];
                    ?><a href="/WhereWeWere.proj/events/event.php?id=<?php echo $eventID ?>"><?php echo $title ?></a><br />
                        <?php

                }
            }
        ?>
    </div>
</div>
</body>
</html>
<?php
    include_once ('footers/footerBase.php');