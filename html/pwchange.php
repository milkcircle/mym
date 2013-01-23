<?php

    /***********************************************************************
     * pwchange.php
     *
     * Computer Science 50
     * Final Project
     *
     * Changes a user's password
     * hcs.harvard.edu/~cs50-mym/pwchange.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
    
    // retrieves the user's password.
    $hash = query("SELECT hash FROM users WHERE id = ?", $_SESSION["id"]);
    $hash = $hash[0]["hash"];

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {    
        // validate inputs
        if (empty($_POST["current"]))
        {
            apologize("You must enter your password.");
        }
        else if (crypt($_POST["current"], $hash) != $hash)
        {
            apologize("Password incorrect.");
        }
        else if (empty($_POST["new"]))
        {
            apologize("You must enter a new password.");
        }
        else if (empty($_POST["confirmation"]) || $_POST["new"] != $_POST["confirmation"])
        {
            apologize("Those passwords did not match.");
        }
        
        // update password
        query("UPDATE users SET hash = ? WHERE id = ?", crypt($_POST["new"]), $_SESSION["id"]);

        // redirect to portfolio
        redirect("index.php");
    }
    else
    {
        // else render form
        render("pwchange_form.php", array("title" => "Change Password"));
    }

?>
