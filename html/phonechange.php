<?php

    /***********************************************************************
     * phonechange.php
     *
     * Computer Science 50
     * Final Project
     *
     * Change phone number.
     * hcs.harvard.edu/~cs50-mym/phonechange.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
    require_once("class.phpmailer.php");
    
    // retrieve password of user
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
        
        // if the user wants to add a phone number...
        if($_POST["add_remove"] == "add")
        {
            // validate input
            if (empty($_POST["new"]) || empty($_POST["carrier"]))
            {
                apologize("You must enter a new phone number and carrier.");
            }
            else if (empty($_POST["confirmation"]) || $_POST["new"] != $_POST["confirmation"])
            {
                apologize("Those phone numbers did not match.");
            }   
            else if(!is_numeric($_POST["new"]) || 999999999 > $_POST["new"] || 10000000000 < $_POST["new"])
            {
                apologize("Phone number is not valid.");
            }
        
            // if the carrier is Verizon, make the corresponding email
            $alt = "";
            if($_POST["carrier"] == "Verizon")
            {
                $alt = $_POST["new"] . "@vtext.com";
                $insert_phone = query("UPDATE users SET alt_email = ? WHERE id = ?", htmlspecialchars($alt), htmlspecialchars($_SESSION["id"]));
                if ($insert_phone === false)
                {
                    apologize("That phone number appears to be taken.");
                }
                query("UPDATE reminders SET alt_email = ? WHERE id = ?", htmlspecialchars($alt), htmlspecialchars($_SESSION["id"]));
            }
            
            // if the carrier is ATT, make the corresponding email
            else if($_POST["carrier"] == "ATT")
            {
                $alt = $_POST["new"] . "@txt.att.net";
                $insert_phone = query("UPDATE users SET alt_email = ? WHERE id = ?", htmlspecialchars($alt), htmlspecialchars($_SESSION["id"]));
                if ($insert_phone === false)
                {
                    apologize("That phone number appears to be taken.");
                }        
                query("UPDATE reminders SET alt_email = ? WHERE id = ?", htmlspecialchars($alt), htmlspecialchars($_SESSION["id"]));
            }
            
            // if the carrier is T-Mobile, make the corresponding email
            else if($_POST["carrier"] == "T-Mobile")
            {
                $alt = "1" . $_POST["new"] . "@tmomail.net";
                $insert_phone = query("UPDATE users SET alt_email = ? WHERE id = ?", htmlspecialchars($alt), htmlspecialchars($_SESSION["id"]));
                if ($insert_phone === false)
                {
                    apologize("That phone number appears to be taken.");
                }        
                query("UPDATE reminders SET alt_email = ? WHERE id = ?", htmlspecialchars($alt), htmlspecialchars($_SESSION["id"]));
            }

            
            // send confirmation text
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = "smtp.fas.harvard.edu";
            $email = $alt;
            $mail->SetFrom("admin@cs50-mym.harvard.whitehouse.president.gov");
            $mail->AddAddress("$email");
            $mail->Subject = "Your phone number has been successfully changed!";
            $mail->Body = "Your phone number has been changed on Mind Your Meds. ";
            $mail->Send();

            // redirect to portfolio
            redirect("index.php");
        }
        
        // if the user chose remove
        else if($_POST["add_remove"] == "remove")
        {
            // delete the existing phone number
            query("UPDATE users SET alt_email = NULL WHERE id = ?", htmlspecialchars($_SESSION["id"]));
        }
        
        // redirect to portfolio
        redirect("index.php");        
    }
    
    
    else
    {
        // else render form
        render("phonechange_form.php", array("title" => "Change Email"));
    }

?>
