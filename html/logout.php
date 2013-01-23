<?php

    /***********************************************************************
     * logout.php
     *
     * Computer Science 50
     * Final Project
     *
     * Logs out the user.
     * hcs.harvard.edu/~cs50-mym/logout.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    // log out current user, if any
    logout();

    // redirect user
    redirect("index.php");

?>
