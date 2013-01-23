<?php

    /***********************************************************************
     * pwreset2.php
     *
     * Computer Science 50
     * Final Project
     *
     * Takes the confirmation code (the hash of the old password) and 
     * updates password.
     * hcs.harvard.edu/~cs50-mym/pwreset2.php
     **********************************************************************/
 
    // require functions
    require("../includes/functions.php"); 
    
    // allow global variables
    session_start(); 
    
    // if the form has been submitted...
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // make sure all fields are correctly filled.
        if (empty($_POST["code"]))
        {
            apologize("Please enter the code from the email.");
        }
        
        // retrieve user information with that email
        $user = query("SELECT * FROM users WHERE email = ?", $_SESSION["email"]);
        
        // validate user input
        if($_POST["code"] !== $user[0]["hash"])
        {
            apologize("Incorrect code.");
        }          
        else if (empty($_POST["password"]))
        {
            apologize("You must choose a new password.");
        }
        else if (empty($_POST["confirmation"]) || $_POST["password"] != $_POST["confirmation"])
        {
            apologize("Those passwords did not match.");
        }      
         
        // change password        
        query("UPDATE users SET hash = ? WHERE email = ?", crypt($_POST["password"]), $_SESSION["email"]);
         
        // notify the user that it worked
        redirect("pwsuccess.php");
    }
     
    else
    {
        // render the password change form
        render("pwreset_form2.php", array("title" => "Reset Password"));
    }
 
?>
