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
    
    // append important information from the medication table
    foreach($rows as &$row)
    {
        // search from medication table
        $query = query("SELECT * FROM medication WHERE m_id = ?", $row["m_id"]);
        
        // simplify variables
        $proprietary_name = $query[0]["proprietary_name"];
        $proprietary_name_suffix = $query[0]["proprietary_name_suffix"];
        
        $row["proprietary_name"] = $proprietary_name;
        $row["proprietary_name_suffix"] = $proprietary_name_suffix;
    }
    
    // render dashboard (the home page form), passing in information about EVERYTHING.
    render("medication_list_form.php", array("title" => "Medication List", "rows" => $rows));
    
?>
 
