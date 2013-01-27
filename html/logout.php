<?php

    /***********************************************************************
     * logout.php
     *
     * MYM
     *
     * Logs out the user.
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    // log out current user, if any
    logout();

    // redirect user
    redirect("index.php");

?>
