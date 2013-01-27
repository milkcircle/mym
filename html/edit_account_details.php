<?php

    /***********************************************************************
     * edit_account_details.php
     *
     * MYM
     *
     * Renders the form that allows users to change their account password,
     * and add their email and phone number
     **********************************************************************/

    // configuration
    require("../includes/config.php");

    // edit the user table, user_email table, and user_phone table in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // simplify the variable names
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];

        // update name
        if (!empty($full_name))
            query("UPDATE user SET full_name = ?", $full_name);
        
        // update email
        if (!empty($email))
        {
            /*
            * TODO: MAKE SURE EMAIL IS IN VALID FORMAT
            */

            query("INSERT INTO user_email (u_id, email) VALUES (?, ?) ON DUPLICATE KEY UPDATE email=?", $_SESSION["u_id"], $email, $email);
        }
          
        //update phone number
        if (!empty($phone_number))
        {
            /*
            * TODO: MAKE SURE PHONE NUMBER IS IN VALID FORMAT
            */

            query("INSERT INTO user_phone (u_id, phone) VALUES (?, ?) ON DUPLICATE KEY UPDATE phone=?", $_SESSION["u_id"], $phone_number, $phone_number);
        }
        
        // render the form for extra details
        redirect("/");
    }    
    else
    {
        $u_id = $_SESSION["u_id"];

        // fill full_name box with current full name
        $results = query("SELECT * FROM user WHERE u_id = ?", $u_id);
        $full_name_placeholder = $results[0]["full_name"];

        // fill email box with current email if user has one, and default text if user does not
        $results = query("SELECT * FROM user_email WHERE u_id = ?", $u_id);
        $email_placeholder;
        if (empty($results))
            $email_placeholder = "What's your email address?";
        else
            $email_placeholder = $results[0]["email"];

        // fill phone_number box with current phone number if user has one, and default text if user does not
        $results = query("SELECT phone FROM user_phone WHERE u_id = ?", $u_id);
        if (empty($results))
            $phone_placeholder = "What's your phone number?";
        else
            $phone_placeholder = $results[0]["phone"];

        // render the form that allows users to input a medication.
        render("edit_account_details_form.php", array("title" => "Edit your account details", "full_name_placeholder" => $full_name_placeholder, "email_placeholder" => $email_placeholder, "phone_placeholder" => $phone_placeholder));
    }
?>
