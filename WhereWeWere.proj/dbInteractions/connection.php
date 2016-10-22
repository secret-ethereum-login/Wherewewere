<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/21/2016
     * Time: 11:12 PM
     */


    function dbConnection()
    {
        $theEnv = getTheEnvironment();

        $user = $theEnv->database->dbuser;
        $password = $theEnv->database->dbpass;
        $dbname = $theEnv->database->dbname;
        $dbdomain = $theEnv->database->domain;
        $mysqli = new mysqli($dbdomain, $user, $password, $dbname);

        return $mysqli;
    }
    function dbConnectionClose($connections)
    {
        mysqli_close ( $connections );
    }