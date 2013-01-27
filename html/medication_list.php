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

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // parse string
        $response = $_POST['submit'];
        $strings = explode("-", $response);
        $action = $strings[0];
        $a_id = $strings[1];
        
        // store relevant a_id in SESSION
        $_SESSION["a_id"] = $a_id;
        
        if ($action == "details")
        {
            redirect("edit_med_details.php");
        }
        else if ($action == "reminder")
        {
            redirect("reminder_list.php");
        }
        else if ($action == "delete")
        {
            redirect("delete_med.php");
        }
    }
    else
    {
        // retrieves a 2d array of information from the associative table
        $rows = query("SELECT * FROM user_medication WHERE u_id = ? AND b_hidden = 0", $_SESSION["u_id"]);
        
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
    }  
?>
 
