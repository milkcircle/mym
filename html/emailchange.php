<?php

    /***********************************************************************
     * emailchange.php
     *
     * Computer Science 50
     * Final Project
     *
     * Changes a user's email.
     * hcs.harvard.edu/~cs50-mym/emailchange.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
    require_once("class.phpmailer.php");
    
    // get the hash of the user's password
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
            apologize("You must enter a new email.");
        }
        else if (empty($_POST["confirmation"]) || $_POST["new"] != $_POST["confirmation"])
        {
            apologize("Those emails did not match.");
        }
        
        // make sure the email is valid!
        if(!filter_var($_POST["new"], FILTER_VALIDATE_EMAIL))
        {
            apologize("E-mail is not valid.");
        }
        
        // update the user's email.
        $check = query("UPDATE users SET email = ? WHERE id = ?", htmlspecialchars($_POST["new"]), $_SESSION["id"]);
        
        // if that didn't work, it must mean that the email is already being used.
        if ($check === false)
            apologize("This email address is already being used.");
            
        // also update the reminders table so that all the reminders are sent to the new email
        query("UPDATE reminders SET email = ? WHERE id = ?", htmlspecialchars($_POST["new"]), $_SESSION["id"]);
            
        // send confirmation email
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
        $email = $_POST["new"];
        $mail->SetFrom("admin@cs50-mym.harvard.whitehouse.president.gov");
        $mail->AddAddress("$email");
        $mail->Subject = "Your email address has been successfully changed!";
        $mail->Body = "Your email address has been changed on Mind Your Meds. ";
        
        $mail->Send();

        // redirect to portfolio
        redirect("index.php");
    }
    else
    {
        // else render form
        render("emailchange_form.php", array("title" => "Change Email"));
    }

?>
