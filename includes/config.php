<?php

    /***********************************************************************
     * config.php
     *
     * MYM
     *
     * Configures pages.
     **********************************************************************/

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("functions.php");

    // enable sessions
    session_start();

    // require authentication for most pages (altered to accomodate About Us and Using This Site)
    if (!preg_match("{(?:login|logout|register|about|howto)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["u_id"]))
        {
            redirect("login.php");
        }
    }

?>
