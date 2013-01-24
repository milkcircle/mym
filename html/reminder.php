<?php

    /***********************************************************************
     * reminder.php
     *
     * Computer Science 50
     * Final Project
     *
     * Lets user set reminder.
     * hcs.harvard.edu/~cs50-mym/reminder.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
        
    // if form was submitted...
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // initiate a counter
        $counter = 0;
        
        // retrieve the frequency of the medicine
        $freq = $_SESSION["freq"];
        
        // iterates through all of the inputs
        while ($counter < $freq)
        {
            // calculates hours in 24-hour format
            if($_POST["$counter-h"] == 12)
                $_POST["$counter-h"] = 0;
            
            if ($_POST["$counter-pm"] == "pm")
                $_POST["$counter-h"] = $_POST["$counter-h"] + 12;
                
            // makes that reminder
            $m_id = query("SELECT m_id FROM meds WHERE id = ? AND name = ?", $_SESSION["id"], $_SESSION["med"]);
            $m_id = $m_id["m_id"];
            query("UPDATE reminders SET send = ?, time = ? WHERE id = ? AND m_id = ? AND counter = ?", $_POST["$counter-e"], 3600 * $_POST["$counter-h"] + 60 * $_POST["$counter-m"], $_SESSION["id"], $m_id, $counter);
            $counter++;
        }
        
        // redirect to portfolio
        redirect("index.php");
    }
    
    else
    {    
        // render form
        render("reminder_form.php", array("title" => "Set Reminders", "med" => $_SESSION["med"], "freq" => $_SESSION["freq"], "dosage" => $_SESSION["dosage"], "primary" => $_SESSION["primary"], "alt" => $_SESSION["alt"]));
    }
    
?>
