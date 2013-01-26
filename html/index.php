<?php

    /***********************************************************************
     * dashboard.php
     *
     * MYM
     *
     * Renders the home page.
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 


 
    // render dashboard (the home page form), passing in information about EVERYTHING.
    render("dashboard_form.php", array("title" => "Dashboard"));

?>
