<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 10:36 PM
     */
    include_once ('/../curl/locationCurl.php');

    $ip_address =  $_SERVER['REMOTE_ADDR'];
    $user_info = curl_get_location($ip_address);
    $city = $user_info['city'];
    ?>
<!--we want jquery for dom accessing-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--this is the project js files-->
<script type="text/javascript" src="../../front-end-tools/javascript/production-javascript/functions.min.js"></script>
<!-- Latest compiled JavaScript bootstrap.....We want bootstrap for grid and some of their widgets-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>


</script>

<!-- Latest compiled and minified CSS bootsrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../front-end-tools/styles/css/style.css">
<head>
    <meta charset="UTF-8">
    <title>Where We Were</title>
</head>
<div class="header-basic col-xs-12 col-sm-12 col-lg-12">
    <span class="site-title">WHERE WE WERE</span>
    <span class="x"></span>
    <span class="location">||| Residents from <?php echo $city ?> are welcome to this event</span>
<!--    <nav class="navbar navbar-default col-xs-12 col-sm-12 col-lg-12">-->
<!--        <div class="container-fluid">-->
<!--            <div class="navbar-header ">-->
<!--                <a class="navbar-brand" href="#">We Were There</a>-->
<!--            </div>-->
<!--            <ul class="nav navbar-nav col-xs-12 col-sm-12 col-lg-12">-->
    <div class="navigation">
                <span class="nav-item col-xs-6 col-sm-6 col-lg-3"><a class="nav-link" href="/WhereWeWere.proj/index.php">Home</a></span>
                <span class="nav-item col-xs-6 col-sm-6 col-lg-3"><a class="nav-link" href="/WhereWeWere.proj/events/eventBase.php">Events</a></span>
                <span class="nav-item col-xs-6 col-sm-6 col-lg-3"><a  class="nav-link" href="/WhereWeWere.proj/events/createEvent.php">Create Event</a></span>
                <span class="nav-item col-xs-6 col-sm-6 col-lg-3"><a class="nav-link" href="#">Page 3</a></span>
<!--            </ul>-->
<!--        </div>-->
<!--    </nav>-->
    </div>
</div>
