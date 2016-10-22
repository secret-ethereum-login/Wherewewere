<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/21/2016
     * Time: 11:22 PM
     */
    function getTheEnvironment()
    {
        $theRoot = dirname($_SERVER['DOCUMENT_ROOT']);
        $getTheEnv = file_get_contents($theRoot . '/wherewewere.json');


        if (!$getTheEnv) {
            $getTheEnv ="No env.json found";
            return $getTheEnv;
        }
        else{
            $theEnvironment = json_decode($getTheEnv);
            return $theEnvironment;
        }

    }