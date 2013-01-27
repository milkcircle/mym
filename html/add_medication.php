<?php

    /***********************************************************************
     * add_medication.php
     *
     * MYM
     *
     * Renders the form that allows users to add a medication, and 
     * adds the medication to the user_medication table if the medication 
     * has been submitted.
     **********************************************************************/

    // configuration
    require("../includes/config.php");

    // add to the user_medication table in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // simplify the variable name
        $medication_name = $_POST["medication_name"];
        
        // check that the user put something in the medication name slot
        if (empty($medication_name))
            apologize("Input a medication please!");

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
        $a_id = query("SELECT LAST_INSERT_ID() AS a_id");
        $_SESSION["a_id"] = $a_id[0]["a_id"];
        
        // render the form for extra details
        redirect("add_details.php");
    }    
    else
    {
        // render the form that allows users to input a medication.
        render("add_medication_form.php", array("title" => "Add a Medication"));
    }

    

?>
