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

        /* check if the medication name is custom or not */

        // retrieve m_id of entries that match medication_name from database
        $results = query("SELECT m_id FROM medication WHERE CONCAT(proprietary_name, ' ', proprietary_name_suffix) = ?", $medication_name);

        // if results is empty, add custom entry onto medication table
        if (empty($results))
        {
            $check = query("INSERT INTO medication (proprietary_name, creator_id) VALUES (?, ?)", $medication_name, $_SESSION["u_id"]);
            $results = query("SELECT LAST_INSERT_ID() AS m_id");
            echo "hi";
        }

        // set m_id as m_id of the first entry of results (multiple results may have been returned)
        $m_id = $results[0]["m_id"];

        echo $m_id;
    }    
    else
    {
        // render the form that allows users to input a medication.
        render("add_medication_form.php", array("title" => "Add a Medication"));
    }

    

?>
