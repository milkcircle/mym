<?php

    /***********************************************************************
     * list.php
     *
     * Computer Science 50
     * Final Project
     *
     * Renders list of notifications.
     * hcs.harvard.edu/~cs50-mym/list.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
      
    // if a form has been submitted...  
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if the "add" button was pressed...
        if (empty($_POST["delete"]) && empty($_POST["change"]))
        {
            // make the relevant medicine a global variable
            $_SESSION["med"] = $_POST["add"];
            
            // and redirect to list_add.php
            redirect("list_add.php");
        }
        
        // if the "delete" button was pressed...
        else if (empty($_POST["add"]) && empty($_POST["change"]))
        {
            // parse the value that was passed in (it should contain the
            // med name and the counter (notification identifier)
            $explosion = explode('\'', $_POST["delete"]);
            $_SESSION["counter"] = $explosion[0];
            $_SESSION["med"] = $explosion[1];
            
            // and redirect to list_delete.php
            redirect("list_delete.php");
        }
        
        // if the "change" button was pressed...
        else if (empty($_POST["add"]) && empty($_POST["delete"]))
        {
            // parse the value that was returned (again, it contains the 
            // med name and the notification identifier
            $explosion = explode('\'', $_POST["change"]);
            $_SESSION["counter"] = $explosion[0];
            $_SESSION["med"] = $explosion[1];
            
            // redirect to list_change.php
            redirect("list_change.php");
        }  
    }
    
    else
    {    
        // $rows contains ALL the reminders associated with this user
        $rows = query("SELECT * FROM reminders WHERE id = ? ORDER BY time ASC", $_SESSION["id"]);
        
        // $meds contains ALL the meds associated with this user
        $meds = query("SELECT * FROM meds WHERE id = ?", $_SESSION["id"]);
        
        // create an array called send that counts the number of unused notifications per medicine
        $send = array(); 
        
        // for each medication, find the number of unused notifications and pass that into the send array
        foreach ($meds as $med)
        {
            $name = $med["name"];
            $zeros = query("SELECT * FROM reminders WHERE id = ? AND med = ? AND send = 0", $_SESSION["id"], $name);
            $send["$name"] = count($zeros);
        }
        
        // render form
        render("list_form.php", array("title" => "Manage Notifications", "rows" => $rows, "send" => $send, "meds" => $meds));
    }
    
?>
