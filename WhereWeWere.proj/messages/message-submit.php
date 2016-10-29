<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/25/2016
     * Time: 10:09 PM
     */
    $name = $_POST['new-message-name'];
    $message = $_POST['new-message-message'];
    $event = $_POST['new-message-eventid'];
    $timestamp = $_POST['new-message-date'];

    echo $name;
    echo $event;
    echo $timestamp;
    echo $message;