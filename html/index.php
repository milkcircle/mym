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

    // get full name
    $user_info = query("SELECT * FROM user WHERE u_id = ?", $_SESSION["u_id"]);
    $full_name = $user_info[0]["full_name"];
 
    // render dashboard (the home page form), passing in information about EVERYTHING.
    render("dashboard_form.php", array("title" => "Dashboard", "full_name" => $full_name));

?>
