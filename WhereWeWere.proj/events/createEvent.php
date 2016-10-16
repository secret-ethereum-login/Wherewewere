<?php
    /**
     * Created by PhpStorm.
     * User: Olaf Broms
     * Date: 10/15/2016
     * Time: 11:13 PM
     */
    include_once ('../headers/headerBase.php');

    ?>
    <!DOCTYPE html>
    <html>
    <head>

    </head>
    <body style="background-color:#CCC">

    <table style="width:100%;height:600px;text-align:center">
        <tr style="height:20%"></tr>

        <tr>
            <th style="font-size:20px"> MAKE AN EVENT! </br></th>
        </tr>
        <form method="get" action="eventBase.php">
            <tr>
                <td>
                    <p>Title:</p>
                    <input class="inputBox" type="text" name="title">
                </td>
            </tr>
            <tr>
                <td>
                    <p>Description:</p>
                    <input class="inputBox" type="text" name="description">
                </td>
            </tr>
            <tr>
                <td>
                    <p>Place:</p>
                    <input class="inputBox" type="text" name="place">
                </td>
            </tr>
            <tr>
                <td>
                    <p>Date and Time:</p>
                    <input class="inputBox" type="text" name="date"> </br></br>
                    <input class="inputBox" type="text" name="startTime">  to
                    <input class="inputBox" type="text" name="endTime">
                </td>
            </tr>
            <td></td>
            </tr>
            <tr>
                <td>
                    </br></br><input type="submit" style="font:12px openSansReg" value="Create">
                </td>
            </tr>
        </form>
        <tr style="height:20%"></tr>
    </table>

    </body>
    </html>

<?php

    include_once ('../footers/footerBase.php');
