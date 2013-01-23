<?php

    /***********************************************************************
     * medlist.php
     *
     * Computer Science 50
     * Final Project
     *
     * Renders a list of medicine for a given user.
     * hcs.harvard.edu/~cs50-mym/medlist.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
    
    // retrieve all information corresponding to the user's ID from the med table
    $rows = query("SELECT * FROM meds WHERE id = ?", $_SESSION["id"]);
    
    // if the delete dropdown menu has been used...
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // delete the medicine from the dropdown list, from both the meds and reminders tables
        query("DELETE FROM meds WHERE id = ? AND name = ?", $_SESSION["id"], $_POST["med"]);
        query("DELETE FROM reminders WHERE id = ? AND med = ?", $_SESSION["id"], $_POST["med"]);
        
        // retrieve all the information about the user's medications
        $rows = query("SELECT * FROM meds WHERE id = ?", $_SESSION["id"]);
        
        // render form, and pass in the medicine information
        render("medlist_form.php", array("title" => "Medicine Inventory", "rows" => $rows));
    }
    
    else
    {
        // render form
        render("medlist_form.php", array("title" => "Medicine Inventory", "rows" => $rows));
    }
    
?>
