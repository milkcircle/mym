<?php

    /***********************************************************************
     * add.php
     *
     * Computer Science 50
     * Final Project
     *
     * Adds a medicine to the database.
     * hcs.harvard.edu/~cs50-mym/add.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["med"]))
        {
            apologize("You must provide a medicine.");
        }
        else if (strpos($_POST["med"], "'") !== false)
        {
            apologize("Invalid medicine. Make sure it doesn't have special characters, like apostrophes!");
        }
        else if (empty($_POST["dosage"]))
        {
            apologize("You must provide the dosage.");
        }
        else if (empty($_POST["freq"]) || $_POST["freq"] < 1)
        {
            apologize("Please provide a valid number in the last field.");
        }
        else if (!is_int($_POST["freq"] + 1 - 1))
        {
            apologize("Please provide a valid integer in the last field.");
        }
        
        // add information into meds database
        $check = query("INSERT INTO meds (id, name, dosage, freq, current) VALUES(?, ?, ?, ?, ?)", $_SESSION["id"],
            $_POST["med"], $_POST["dosage"], $_POST["freq"], $_POST["freq"]);
        
        // check that it worked...otherwise, it must already be there.
        if ($check === false)
        {
            apologize("This medicine is already in your inventory.");
        }
        
        // if it worked, update the count (which tells how many meds the user has)
        else
        {
            query("UPDATE users SET count = count + 1 WHERE id = ?", $_SESSION["id"]);
            
            $email_info = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
            $email_info = $email_info[0];
            $primary = $email_info["email"];
            $alt = $email_info["alt_email"];
            
            $counter = 0;
            
            // also, create null reminders for the medicine in the reminders database.
            while ($counter < $_POST["freq"])
            {
                query("INSERT INTO reminders (id, email, med, dosage, time, send, alt_email, counter) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", $_SESSION["id"], $primary, $_POST["med"], $_POST["dosage"], $counter, 0, $alt, $counter);
                $counter++;
            }
           
            // store the following in a global variable so it can be accessed by reminder.php
            $_SESSION["med"] = $_POST["med"];
            $_SESSION["freq"] = $_POST["freq"];
            $_SESSION["dosage"] = $_POST["dosage"];
            $_SESSION["primary"] = $primary;
            $_SESSION["alt"] = $alt;
            
            // redirect to the reminder form, if the user checked the box to set reminders.
            if (!empty($_POST["reminder"]))
                redirect("reminder.php");
            else
                redirect("add.php");
        }
        
    }
    else
    {
        // else render form
        render("add_form.php", array("title" => "Add a medicine"));
    }

?>
