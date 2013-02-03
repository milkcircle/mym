<?php

    /***********************************************************************
     * edit_med_details.php
     *
     * MYM
     *
     * Either updates medication details, or renders the form.
     * $_SESSION["a_id"] MUST CONTAIN A VALUE.
     * 
     * TODO: MAKE SURE END THERAPY DATE IS AFTER BEGINNING THERAPY DATE!!!
     * 
     **********************************************************************/

    // configuration
    require("../includes/config.php");

    // global constant that sets limit in number of rows
    define("ROW_LIMIT", 7);

    // add to the user_medication table in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $a_id = $_SESSION["a_id"];

        // simplify variables, gather input
        $refill_date = $_POST["refill_date"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $details = $_POST["details"];
        
        // update the table with new information
        if (!empty($refill_date))
        {
            query("UPDATE user_medication SET refill = ? WHERE a_id = ?", $refill_date, $a_id);
        }

        if (!empty($start_date))
        {
            query("UPDATE user_medication SET start = ? WHERE a_id = ?", $start_date, $a_id);
        }

        if (!empty($end_date))
        {
            query("UPDATE user_medication SET end = ? WHERE a_id = ?", $end_date, $a_id);
        }

        if (!empty($details))
        {
            query("UPDATE user_medication SET details = ? WHERE a_id = ?", $details, $a_id);
        }
        
        redirect("set_reminders.php");
    }    
    else
    {
        // retrieve relevant a_id
        $a_id = $_SESSION["a_id"];
        
        // use the a_id to query the user_medication form
        
        $association_info = query("SELECT * FROM user_medication WHERE a_id = ?", $a_id);
        
        // make variables to pass into form
        $refill_placeholder = $association_info[0]["refill"];
        if (empty($refill_placeholder))
            $refill_placeholder = "Refill Date";
        
        $start_placeholder = $association_info[0]["start"];
        
        $end_placeholder = $association_info[0]["end"];
        if (empty($end_placeholder))
            $end_placeholder = "End Date";
        
        $details_placeholder = $association_info[0]["details"];
        if (empty($details_placeholder))
            $details_placeholder = "ex) Two capsules at a time, take with food, etc..";
            
        // pass in medication name
        $name = query("SELECT proprietary_name, proprietary_name_suffix FROM medication WHERE
            m_id = ?", $association_info[0]["m_id"]);
            
        $proprietary_name = $name[0]["proprietary_name"];
        $proprietary_name_suffix = $name[0]["proprietary_name_suffix"];
      
        // render the form that allows users to input a medication.
        render("edit_med_details_form.php", array("title" => "Update Details", "a_id" => $a_id, 
            "refill_placeholder" => $refill_placeholder, "start_placeholder" => $start_placeholder,
            "end_placeholder" => $end_placeholder, "details_placeholder" => $details_placeholder,
            "proprietary_name" => $proprietary_name, "proprietary_name_suffix" => $proprietary_name_suffix));
    }


?>
