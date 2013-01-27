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

    // add to the user_medication table in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // simplify variables, gather input
        $refill_date = $_POST["refill_date"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $details = $_POST["details"];
        
        if (!empty($refill_date))
        {
            query("UPDATE user_medication SET refill = ?", $refill_date);
        }

        if (!empty($start_date))
        {
            query("UPDATE user_medication SET start = ?", $start_date);
        }

        if (!empty($end_date))
        {
            query("UPDATE user_medication SET end = ?", $end_date);
        }

        if (!empty($details))
        {
            query("UPDATE user_medication SET details = ?", $details);
        }

        // insert into the user_medication table
        $check = query("UPDATE user_medication SET refill = ?, start = ?, end = ?, details = ? WHERE
            a_id = ?", $refill_date, $start_date, $end_date, $details, $_SESSION["a_id"]);
        if ($check === false)
        {
            echo "Update failed, for some reason.";
        }
        
        redirect("index.php");
    }    
    else
    {
        // retrieve relevant a_id
        $a_id = $_SESSION["a_id"];
        
        // use the a_id to query the user_medication form
        
        $association_info = query("SELECT * FROM user_medication WHERE a_id = ?", $a_id);
        
        // make variables to pass into form
    
        $refill = $association_info[0]["refill"];
        if (empty($refill))
            $refill = "Refill Date";
        
        $start = $association_info[0]["start"];
        
        $end = $association_info[0]["end"];
        if (empty($end))
            $end = "End Date";
        
        $details = $association_info[0]["details"];
        if (empty($details))
            $details = "Dosage and other information";
            
        // pass in medication name
        $name = query("SELECT proprietary_name, proprietary_name_suffix FROM medication WHERE
            m_id = ?", $association_info[0]["m_id"]);
            
        $proprietary_name = $name[0]["proprietary_name"];
        $proprietary_name_suffix = $name[0]["proprietary_name_suffix"];
      
        // render the form that allows users to input a medication.
        render("edit_med_details_form.php", array("title" => "Update Details", "a_id" => $a_id, 
            "refill" => $refill, "start" => $start, "end" => $end, "details" => $details, 
            "proprietary_name" => $proprietary_name, "proprietary_name_suffix" => $proprietary_name_suffix));
    }


?>
