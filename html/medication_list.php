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

    // retrieves a 2d array of a_id values
    $rows = query("SELECT a_id FROM user_medication WHERE u_id = ?", $_SESSION["u_id"]);
    
    // makes $rows into a single-dimension array called $a_id
    $a_id = array();
    $counter = 0;
    foreach($rows as $row)
    {
        $a_id[$counter] = $row["a_id"];
        $counter++;
    }
 
    dump($a_id);
    
    // render dashboard (the home page form), passing in information about EVERYTHING.
    render("medication_list_form.php", array("title" => "Medication List", "user_meds" => $user_meds));


?>
 
