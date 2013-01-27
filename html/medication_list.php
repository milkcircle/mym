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

    // retrieves a 2d array of information from the associative table
    $rows = query("SELECT * FROM user_medication WHERE u_id = ?", $_SESSION["u_id"]);
    
    // render dashboard (the home page form), passing in information about EVERYTHING.
    render("medication_list_form.php", array("title" => "Medication List", "rows" => $rows));
    
?>
 
