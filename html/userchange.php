<?php

    /********************************************************************
    * userchange.php
    * 
    * Computer Science 50
    * Final Project
    *
    * Updates the user name to a new value given by a submitted form.
    * hcs.harvard.edu/~cs50-mym/userchange.php
    ********************************************************************/

    // configuration
    require("../includes/config.php"); 
    
    // find appropriate hash data from SQL table
    $hash = query("SELECT hash FROM users WHERE id = ?", $_SESSION["id"]);
    $hash = $hash[0]["hash"];

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {    
        // validate inputs
        if (empty($_POST["password"]))
        {
            apologize("You must enter your password.");
        }
        else if (crypt($_POST["password"], $hash) != $hash)
        {
            apologize("Password incorrect.");
        }
        else if (empty($_POST["new"]))
        {
            apologize("You must enter a new username.");
        }
        else if (empty($_POST["confirmation"]) || $_POST["new"] != $_POST["confirmation"])
        {
            apologize("Those usernames did not match.");
        }
        
        // update the SQL table with the new username
        $check = query("UPDATE users SET username = ? WHERE id = ?", htmlspecialchars($_POST["new"]), $_SESSION["id"]);
        if ($check === false)
            apologize("This username is already being used.");

        // redirect to portfolio
        redirect("index.php");
    }
    else
    {
        // else render form
        render("userchange_form.php", array("title" => "Change Username"));
    }

?>
