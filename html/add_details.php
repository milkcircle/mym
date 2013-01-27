<?php

    /***********************************************************************
     * add_details.php
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
      
        // render the form that allows users to input a medication.
        render("add_details_form.php", array("title" => "Update Details", "a_id" => $a_id, 
            "refill" => $refill, "start" => $start, "end" => $end, "details" => $details));
    }


?>
