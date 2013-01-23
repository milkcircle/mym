<?php

    /***********************************************************************
     * list_change.php
     *
     * Computer Science 50
     * Final Project
     *
     * Changes the information about a given notification.
     * hcs.harvard.edu/~cs50-mym/list_change.php
     **********************************************************************/
     
    // configuration
    require("../includes/config.php"); 
        
    // if something from the form has been submitted...
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // retrieve the notification identifier (counter) and the relevant medicine
        $counter = $_SESSION["counter"];
        $med = $_SESSION["med"];
        
        // calculate the hour in a 24-hour system
        if($_POST["h"] == 12)
            $_POST["h"] = 0;
        
        if ($_POST["pm"] == "pm")
            $_POST["h"] = $_POST["h"] + 12;
        
        // change the information about the notification in the SQL database
        query("UPDATE reminders SET send = ?, time = ? WHERE id = ? AND med = ? AND counter = ?", $_POST["e"], 3600 * $_POST["h"] + 60 * $_POST["m"], $_SESSION["id"], $med, $counter);
    
        // redirect
        redirect("list.php");
    }
    
    else
    {
        render("list_change_form.php", array("title" => "Change Reminder", "med" => $_SESSION["med"]));
    }
?>
