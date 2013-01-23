<?php
    /********************************************************************
    * today.php
    * 
    * Computer Science 50
    * Final Project
    *
    * Displays medicines for the day. When a medicine is clicked, counts
    * down the number of doses remaining for the day and counts up the
    * user's score.
    * hcs.harvard.edu/~cs50-mym/today.php
    ********************************************************************/
    
    // configuration
    require("../includes/config.php"); 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // subtract from this medicine's doses for today
        query("UPDATE meds SET current = current - 1 WHERE id = ? AND name = ?", $_SESSION["id"], $_POST["minus"]);
        
        // add to the user's score for taking a medicine
        query("UPDATE users SET score = score + 1 WHERE id = ?", $_SESSION["id"]);
        
        // sends medicine info for this user to the today form
        $rows = query("SELECT * FROM meds WHERE id = ?", $_SESSION["id"]);
        render("today_form.php", array("title" => "Today's List", "rows" => $rows));
    }
    
    else
    {
        // retrieve all information corresponding to the user's ID from the med table
        $rows = query("SELECT * FROM meds WHERE id = ?", $_SESSION["id"]);
        
        // render form
        render("today_form.php", array("title" => "Today's List", "rows" => $rows));
    }
?>

