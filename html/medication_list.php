<?php

    /***********************************************************************
     * medication_list.php
     *
     * MYM
     *
     * Renders the medication list.
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    $user_meds = query("SELECT * FROM user_medication WHERE u_id = ?", $_SESSION["u_id"]);
 
    // render dashboard (the home page form), passing in information about EVERYTHING.
    render("dashboard_form.php", array("title" => "Dashboard", "full_name" => $full_name));


?>
