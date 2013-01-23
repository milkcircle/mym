<?php

    /***********************************************************************
     * list_add.php
     *
     * Computer Science 50
     * Final Project
     *
     * Adds a notification for a medicine.
     * hcs.harvard.edu/~cs50-mym/list_add.php
     **********************************************************************/

    // require config
    require("../includes/config.php");
    
    // if something from the form was submitted...
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // calculate the hour (in a 24-hour system) from the information that was passed in
        $_POST["h"] = $_POST["h"] + 0;
        
        if($_POST["h"] == 12)
        {
            $_POST["h"] = 0;
        }
        
        if ($_POST["pm"] == "pm")
        {
            $_POST["h"] = $_POST["h"] + 12;
        }
        
        // select a row that hasn't been used for notification
        $counter = query("SELECT counter FROM reminders WHERE id = ? AND med = ? AND send = 0", $_SESSION["id"], $_SESSION["med"]);
        $counter = $counter[0]["counter"];
        
        // use that row to set a notification for the medication
        query("UPDATE reminders SET send = ?, time = ? WHERE id = ? AND med = ? AND counter = ?", $_POST["e"], 3600 * $_POST["h"] + 60 * $_POST["m"], $_SESSION["id"], $_SESSION["med"], $counter);
                
        // redirect to portfolio
        redirect("list.php");
    }
    else
    {
        // retrieve the medicine for which a notification should be created
        $med = $_SESSION["med"];
        
        // render form
        render("list_add_form.php", array("title" => "Add Notification", "med" => $med));
    }

?>
