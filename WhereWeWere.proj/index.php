<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 10:33 PM
     */
    include_once ('curl/locationCurl.php');
   $ip_address =  $_SERVER['REMOTE_ADDR'];
   $user_info = curl_get_location($ip_address);
    $city = $user_info['city'];

   include_once ('headers/headerBase.php');
    ?>
<html>



<body class="body-basic col-xs-12 col-sm-12 col-lg-12">

<!--<h2 id="theHeader">The standard Lorem Ipsum passage, used since the 1500s</h2>-->
<div class="theContent col-xs-12 col-sm-12 col-lg-12" style="">
<button onclick="myFunction()">Click me</button>
"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
</div>
<div class="the-event-listing">
    <?php
        $conn = new PDO("mysql:host=127.0.0.1;dbname=whatpzcp_wherewewere","root","");
        $stmt = $conn -> prepare("SELECT `id`, `Title`
				FROM `events` ORDER BY `id` DESC");
        $stmt -> execute();
        $events = $stmt -> fetchAll();
    ?>
    <!-- Write all event titles as hyperlinks to their info/messages -->
    <text style="float:left;height:400px;padding-left:10px;overflow-y:auto">
        <?php
            foreach($events as $event) {
                $eventID = $event['id'];
                $title = $event['Title'];
                print "<a href='event.php?id=$eventID'>$title</a>";
                print "</br>";
            }
        ?>
    </text>
</div>
</body>
</html>
<?php
    include_once ('footers/footerBase.php');