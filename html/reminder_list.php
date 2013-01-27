<?php

    /***********************************************************************
     * reminder_list.php
     *
     * MYM
     *
     * Renders the reminder list.
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

    }
    
    else
    {
        $a_id = $_SESSION["a_id"];
        
        $m_id = query("SELECT m_id FROM user_medication WHERE a_id = ?", $a_id);
        $m_id = $m_id[0]["m_id"];
        $medication = query("SELECT * FROM medication WHERE m_id = ?", $m_id);
        $proprietary_name = $medication[0]["proprietary_name"];
        $proprietary_name_suffix = $medication[0]["proprietary_name_suffix"];
        
        $reminders = query("SELECT * FROM recurring_reminders WHERE a_id = ?", $a_id);
        $overrides = query("SELECT * FROM reminder_override WHERE a_id = ? AND b_on = 1", $a_id);
        
        // render the reminder list, passing in information about everything about the medication.
        render("reminder_list_form.php", array("title" => "Reminders about $proprietary_name $proprietary_name_suffix",
            "reminders" => $reminders, "overrides" => $overrides, "medication" => $medication));
    }

?>
