<?php

    /***********************************************************************
     * add_details.php
     *
     * MYM
     *
     * Either updates medication details, or renders the form.
     * $_SESSION["a_id"] MUST CONTAIN A VALUE.
     **********************************************************************/

    // configuration
    require("../includes/config.php");

    // add to the user_medication table in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // simplify the variable name
        $medication_name = $_POST["medication_name"];

        /* check if the medication name is custom or not */

        // retrieve m_id of entries that match medication_name from database
        $results = query("SELECT m_id FROM medication WHERE CONCAT(proprietary_name, ' ', proprietary_name_suffix) = ?", $medication_name);

        // if results is empty, add custom entry onto medication table
        if (empty($results))
        {
            $check = query("INSERT INTO medication (proprietary_name, creator_id) VALUES (?, ?)", $medication_name, $_SESSION["u_id"]);
            $results = query("SELECT m_id FROM medication WHERE proprietary_name = ?", $medication_name);
        }

        // set m_id as m_id of the first entry of results (multiple results may have been returned)
        $m_id = $results[0]["m_id"];
        
        // now, insert this information into user_medication table
            // represent today's date as SQL format
            $today = date("Y-m-d");
        
        // insert information into association table
        $check = query("INSERT INTO user_medication (u_id, m_id, start, b_hidden) VALUES (?, ?, ?, ?)", $_SESSION["u_id"], $m_id, $today, 0);
        if ($check === false)
        {
            echo "Something went wrong inserting into association array.";
        }
        
        // query the thing we JUST inserted, so that we can store that in SESSION
        $a_id = mysql_insert_id();
        $_SESSION["a_id"] = $a_id;
        
        // render the form for extra details
        redirect("add_details.php");
    }    
    else
    {
        // retrieve relevant a_id
        $a_id = $_SESSION["a_id"];
        
        // use the a_id to query the user_medication form
        
        $association_info = query("SELECT * FROM user_medication WHERE a_id = ?", $a_id);
        
        // make variables to pass into form
    
        $refill = $association_info[0]["refill"];
        $start = $association_info[0]["start"];
        $end = $association_info[0]["end"];
        $details = $association_info[0]["details"];
      
        // render the form that allows users to input a medication.
        render("add_medication_form.php", array("title" => "Update Details", "a_id" => $a_id, 
            "refill" => $refill, "start" => $start, "end" => $end, "details" => $details));
    }


?>
