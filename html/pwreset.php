<?php

    /***********************************************************************
     * pwreset.php
     *
     * Computer Science 50
     * Final Project
     *
     * The first step in resetting a password.
     * hcs.harvard.edu/~cs50-mym/pwreset.php
     **********************************************************************/
 
    // require files
    require("../includes/functions.php"); 
    require_once("class.phpmailer.php");
     
    // if the form has been submitted...
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check to see if the user has input an email.
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            apologize("You must provide an email address.");
        }
         
        // check to see if the email is in the database.
        $check = query("SELECT * FROM users WHERE email = ?", $_POST["email"]);
        if ($check === false)
        {
            apologize("We do not have an account associated with that email address.");
        }
         
        // try to email the address.
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
         
        // retrieve the hash of the user's password, which we will use as a confirmation code.
        $email = $_POST["email"];
        $user = query("SELECT * FROM users WHERE email = ?", $email);
        $hash = $user[0]["hash"];
         
        // email the user a link and his confirmation code.
        $mail->SetFrom("admin@mym.com");
        $mail->AddAddress("$email");
        $mail->Subject = "Mind Your Meds password reset";
        $mail->IsHTML(true);
        $mail->Body = "<div>You have indicated that you have forgotten your password. You'll need the following code to change it.</div><br>
            <div>$hash<div>";
 
        // check to see if it sent
        if ($mail->Send() === false)
        {
            apologize("Your email address is invalid. Please try again.");
        }
        
        // allow global variables
        session_start();
        $_SESSION["email"] = $email;
         
        // redirect the user to the password reset page.
        redirect("pwreset2.php");
    }
    else
    {
        // show the user the form to input his email address.
        render("pwreset_form.php", array("title" => "Reset Password"));
    }
 
?>
