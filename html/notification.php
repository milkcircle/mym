<?php

    /***********************************************************************
     * notification.php
     *
     * Computer Science 50
     * Final Project
     *
     * Used in conjunction with crontab. Sends daily summary email.s
     **********************************************************************/

    // your database's name
    define("DATABASE", "cs50-mym");

    // your database's password
    define("PASSWORD", "ueb3XymbZN8w");

    // your database's server
    define("SERVER", "mysql.hcs.harvard.edu");

    // your database's username
    define("USERNAME", "cs50-mym");
    
    // include query function
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            $my_var = $handle->errorInfo();
            trigger_error($my_var[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    // require PHPmailer  
    require("class.phpmailer.php");
    
    // select every user
    $rows = query("SELECT * FROM users");
    
    // iterate through every user
    foreach($rows as $row)
    {
        // simplify the variables
        $id = $row["id"];
        $email = $row["email"];
        
        // retrieve all the medicine information for this user
        $med_info = query("SELECT * FROM meds WHERE id = ?", $id);

        // set up email
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
        
        $mail->SetFrom("admin@cs50-mym.harvard.whitehouse.president.gov");
        $mail->AddAddress("$email");
        $mail->Subject = "Your medicine reminders for today";
        
        // construct body
        $body = "";
        foreach($med_info as $med)
        {
            // simplify variables
            $name = $med["name"];
            $current = $med["current"];
            $dosage = $med["dosage"];
            
            // grow body by concatenating with existing body
            $body = $body . "<div>You need to take $dosage of $name, $current time(s).</div>";
        }
        
        // retrieve user information
        $user = query("SELECT * FROM users WHERE id = ?", $id);
        $user = $user[0];
        
        // notify user of missed meds
        $counter = 0;
        foreach($med_info as $med)
        {
            // identify missed meds
            if ($med["missed"] != 0)
            {
                // if medicine was missed, concatenate into body
                $missed = $med["missed"];
                $m_med = $med["name"];
                $body = $body . "<div>Yesterday you missed $missed dose(s) of $m_med.</div>";
                $counter++;
            }
        }
        
        // check to see if there are any medicines in the first place
        $bool = query("SELECT * FROM meds WHERE id = ?", $id); 
        
        // if there are no missed medicines and there are medicines in the user's med list...   
        if ($counter == 0 && $bool !== false)
            
            // provide a congratulatory message
            $body = $body . "<div>Good job! Yesterday you didn't forget any medicines. Keep up your good work!</div>";
        
        // send the email
        $mail->IsHTML(true);
        $mail->Body = "$body";
        $mail->Send();
    }
    
    
?>
