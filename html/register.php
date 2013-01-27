<?php
    /*
         * HOW TO FORMAT EMAILS FOR EACH CARRIER, GIVEN PHONE 
         * NUMBER
         *

        if(!empty($_POST["carrier"]))
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
        }
        */
        
        /*
         * HOW TO USE PHPMAILER
         *

        // send confirmation email
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
        $email = $_POST["email"];
        $password = $_POST["password"];
        $mail->SetFrom("admin@cs50-mym.harvard.whitehouse.president.gov");
        $mail->AddAddress("$email");
        $mail->Subject = "Thank you for registering for Mind Your Meds!";
        $mail->IsHTML(true);
        $mail->Body = "<div>You have successfully registered. Please don't forget your password!
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
            $mail->SetFrom("admin@cs50-mym.harvard.whitehouse.president.gov");
            $mail->AddAddress("$alt");
            $mail->Subject = "Thank you for registering for Mind Your Meds!";
            $mail->Body = "You have successfully registered for Mind Your Meds with this phone number.
            Remember to check back often and see how many points you've racked up.";
            
            $mail->Send();
        }
        */

        /*
         * EMAIL AND PHONE VALIDATION CODE
         *

        // validate email
        if (!empty $_POST["email"] && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            echo "Please enter a valid email.";
        }

        // validate phone
        if (!empty $_POST["phone"] && (!is_numeric($_POST["phone"]) || 999999999 > $_POST["phone"] || 10000000000 < $_POST["phone"]))
        {
            echo "Please enter a valid phone number.";
        }
        */

    /***********************************************************************
     * register.php
     *
     * MYM
     *
     * Registers user.
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate inputs
        if (empty($_POST["full_name"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirmation"]))
        {
            apologize("Please fill out all the fields!");
        }            
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Make sure your passwords match!");
        }

        // try to register user
        $results = query("INSERT INTO user (username, full_name, hash) VALUES(?, ?, ?)", 
            $_POST["username"], $_POST["full_name"], crypt($_POST["password"]));
        if ($results === false)
        {
            apologize("Username is taken");
        }

        // get new user's ID
        $rows = query("SELECT LAST_INSERT_ID() AS u_id");
        if ($rows === false)
        {   
            // we shouldn't really ever need this
            apologize("Can't find your u_id.");
        }
        $u_id = $rows[0]["u_id"];

        // log user in
        $_SESSION["u_id"] = $u_id;

        // redirect to index
        redirect("/");
    }
    else
    {
        // else render form
        render("frontpage_form.php", array("title" => "Welcome!"));
    }

?>
