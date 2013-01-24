<?php
    /****************************************************************
    * updates.php
    *
    * Computer Science 50
    * Final Project
    *
    * Sends email and SMS reminders for all entries in the SQL table
    * whose times are close to the current time. Runs every minute
    * through a crontab.
    ****************************************************************/
   
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
    
    // calculate the number of seconds since midnight
    $t = time() + 19*3600;
    $t = $t % 86400;
    
    // we'll want all phone numbers and email addresses
    $rows = query("SELECT * FROM users");
    
    // iterate through every email
    foreach($rows as $row)
    {
        // simplify variable
        $email = $row["email"];
        
        // finds all reminders for this user set to send to email only
        $reminds = query("SELECT * FROM reminders WHERE id = ? AND send = 1", $_SESSION["id"]);
        $meds = query("SELECT * FROM meds WHERE m_id = ?", $reminds["m_id"]);
        
        // set up email
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
        $mail->SetFrom("admin@mym.com");
        $mail->AddAddress("$email");
        $mail->Subject = "MYM Reminder";
        $body="";
        
        // appends information about the appropriate medicine to the email body
        foreach($reminds as $remind)
        {
            // simplify variables
            $time = $remind["time"];
            $med = $meds["name"];
            $dosage = $meds["dosage"];
            
            // check for a time within 30 seconds of the current time
            if($t - $time < 30 && $t - $time > -30)
            {
                $body = $body . "$med: $dosage\n";
            }
        }
        
        // same thing, but for the reminders meant for both the email and the phone
        $reminds = query("SELECT * FROM reminders WHERE id = ? AND send = 3", $SESSION_["id"]);
        $meds = query("SELECT * FROM meds WHERE m_id = ?", $reminds["m_id"]);
        
        // check to see if reminder is necessary
        foreach($reminds as $remind)
        {
            // simplify variables
            $time = $remind["time"];
            $med = $meds["name"];
            $dosage = $meds["dosage"];
            
            // check for a time within 30 seconds of the current time
            if($t - $time < 30 && $t - $time > -30)
            {
                $body = $body . "$med: $dosage\n";
            }
        }                
        
        // send email
        $mail->Body = "$body";
        $mail->Send();
    }

    // iterate through every phone
    foreach($rows as $row)
    {
        // simplify variable
        $phone = $row["alt_email"];
        
        // find all reminders for the phone only
        $reminds = query("SELECT * FROM reminders WHERE id = ? AND send = 2", $SESSION_["id"]);
        $meds = query("SELECT * FROM meds WHERE m_id = ?", $reminds["m_id"]);
        
        // set up email
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
        $mail->SetFrom("admin@mym.net");
        $mail->AddAddress("$phone");
        $mail->Subject = "MYM Reminder";
        $body="";
        
        // append medicine info to body
        foreach($reminds as $remind)
        {
            // simplify variables
            $time = $remind["time"];
            $med = $meds["name"];
            $dosage = $meds["dosage"];
            
            // check for a time within 30 seconds of the current time
            if($t - $time < 30 && $t - $time > -30)
            {
                $body = $body . "$med: $dosage\n";
            }
        }
        
        // do it again for reminders for both phone and email
        $reminds = query("SELECT * FROM reminders WHERE alt_email = ? AND send = 3", $phone);
        $meds = query("SELECT * FROM meds WHERE m_id = ?", $reminds["m_id"]);
        
        // check to see if reminder is necessary
        foreach($reminds as $remind)
        {
            // simplify variables
            $time = $remind["time"];
            $med = $meds["name"];
            $dosage = $meds["dosage"];
            
            // check for a time within 30 seconds of the current time
            if($t - $time < 30 && $t - $time > -30)
            {
                $body = $body . "$med: $dosage\n";
            }
        }        
        
        // send email
        $mail->Body = "$body";
        $mail->Send();
    }
    
    
?>
