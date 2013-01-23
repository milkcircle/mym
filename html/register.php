<?php

    /***********************************************************************
     * register.php
     *
     * Computer Science 50
     * Final Project
     *
     * Registers user.
     * hcs.harvard.edu/~cs50-mym/register.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
    require_once("class.phpmailer.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate inputs
        if (empty($_POST["email"]))
        {
            apologize("You must provide an email address.");
        }            
        else if (empty($_POST["password"]))
        {
            apologize("You must choose a password.");
        }
        else if (empty($_POST["confirmation"]) || $_POST["password"] != $_POST["confirmation"])
        {
            apologize("Those passwords did not match.");
        }
        
        // validate email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            apologize("E-mail is not valid.");
        }
        
        // validate phone number
        if((!is_numeric($_POST["phone"]) || 999999999 > $_POST["phone"] || 10000000000 < $_POST["phone"]) && !empty($_POST["phone"]))
        {
            apologize("Phone number is not valid.");
        }
        
        // try to register user
        $results = query("INSERT INTO users (email, hash) VALUES(?, ?)", 
            htmlspecialchars($_POST["email"]), htmlspecialchars(crypt($_POST["password"])));
        if ($results === false)
        {
            apologize("That email appears to already be in use.");
        }
        
        // try to add email to database.
        /*$insert_email = query("UPDATE users SET email = ? WHERE username = ?", htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["username"]));
        if ($insert_email === false)
        {
            query("DELETE FROM users WHERE username = ?", $_POST["username"]);
            apologize("That email appears to be taken.");
        }*/
        
        $alt = "";
        //try to add phone to database
        $insert_phone = query("UPDATE users SET alt_email = ? WHERE email = ?", $_POST["phone"], htmlspecialchars($_POST["email"]));
        
        /*if(!empty($_POST["carrier"]))
        {
            // if carrier is Verizon, store the corresponding email.
            if($_POST["carrier"] == "Verizon")
            {
                $alt = $_POST["phone"] . "@vtext.com";
                $insert_phone = query("UPDATE users SET alt_email = ? WHERE username = ?", htmlspecialchars($alt), htmlspecialchars($_POST["username"]));
                if ($insert_phone === false)
                {
                    query("DELETE FROM users WHERE username = ?", $_POST["username"]);
                    apologize("That phone number appears to be taken.");
                }
            }
            
            // if carrier is ATT, store the corresponding email.
            if($_POST["carrier"] == "ATT")
            {
                $alt = $_POST["phone"] . "@txt.att.net";
                $insert_phone = query("UPDATE users SET alt_email = ? WHERE username = ?", htmlspecialchars($alt), htmlspecialchars($_POST["username"]));
                if ($insert_phone === false)
                {
                    query("DELETE FROM users WHERE username = ?", $_POST["username"]);
                    apologize("That phone number appears to be taken.");
                }        
            }
            
            // if carrier is T-Mobile, store the corresponding email.
            if($_POST["carrier"] == "T-Mobile")
            {
                $alt = "1" . $_POST["phone"] . "@tmomail.net";
                $insert_phone = query("UPDATE users SET alt_email = ? WHERE username = ?", htmlspecialchars($alt), htmlspecialchars($_POST["username"]));
                if ($insert_phone === false)
                {
                    query("DELETE FROM users WHERE username = ?", $_POST["username"]);
                    apologize("That phone number appears to be taken.");
                }        
            }
        }*/
        
        // send confirmation email
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $mail->SetFrom("admin@cs50-mym.harvard.whitehouse.president.gov");
        $mail->AddAddress("$email");
        $mail->Subject = "Thank you for registering for Mind Your Meds!";
        $mail->IsHTML(true);
        $mail->Body = "<div>You have successfully registered. Your username is $username. Please don't forget your password!
        Now you are able to keep track of your medications! Remember to check back often and see how many points you've racked up.</div>
        <div><a href=\"http://hcs.harvard.edu/cs50-mym\">Mind Your Meds</a></div>
            <br><br>This is an automated email address. Please do not reply.";
            
        $mail->Send();
        
        // send confirmation text
        if(!empty($alt))
        {
            // send confirmation text, if appropriate
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = "smtp.fas.harvard.edu";
            $username = $_POST["username"];
            $mail->SetFrom("admin@cs50-mym.harvard.whitehouse.president.gov");
            $mail->AddAddress("$alt");
            $mail->Subject = "Thank you for registering for Mind Your Meds!";
            $mail->Body = "You have successfully registered for Mind Your Meds as $username and with this phone number.
            Remember to check back often and see how many points you've racked up.";
            
            $mail->Send();
        }

        // get new user's ID
        $results = query("SELECT LAST_INSERT_ID() AS id");
        $id = $results[0]["id"];

        // log user in
        $_SESSION["id"] = $id;

        // redirect to portfolio
        redirect("index.php");
    }
    else
    {
        // else render form
        render("register_form.php", array("title" => "Register"));
    }

?>
