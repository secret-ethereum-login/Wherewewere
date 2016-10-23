<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/21/2016
     * Time: 11:41 PM
     */
    function get_all_events($connections)
    {

        $events = mysqli_query($connections, "SELECT * FROM events ");
       // $return['data'] = $events;
       // $return['number'] = mysqli_num_rows($events);
        //return $return;
        return $events;

    }
    function get_specific_event($connections, $id)
    {
        $event = mysqli_query($connections, "SELECT * FROM events where id = $id");
        return $event;
    }
    function get_all_events_messages($connections, $eventid)
    {
        $eventMessages = mysqli_query($connections, "SELECT * FROM messages where eventId = $eventid");
        return $eventMessages;
    }
    function get_a_user_for_a_message($connections, $userid)
    {
        $user  = mysqli_query($connections, "SELECT * FROM user where id = $userid");
        return $user;
    }