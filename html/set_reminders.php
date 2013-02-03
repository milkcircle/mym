<?php

    /***********************************************************************
     * set_reminders.php
     *
     * MYM
     *
     * Either sets reminders, or renders the form.
     * $_SESSION["a_id"] MUST CONTAIN A VALUE.
     * 
     * 
     **********************************************************************/

    // configuration
    require("../includes/config.php");

    // global constant that sets limit in number of rows
    define("ROW_LIMIT", 7);

    // add to the user_medication table in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $a_id = $_SESSION["a_id"];
  
        // filter array for only things that hold values...this contains keys AND values
        array_filter($_POST);
        
        // $keys contains all the keys
        $keys = array_keys($_POST);

        // run for each row submitted
        for($i = 0; $i < ROW_LIMIT; $i++)
        {
            // initialize arrays
            $days = array();
            $times = array();
            
            // pass by reference to make global changes
            foreach($keys as &$key)
            {
                // explode the key
                $results = explode("-", $key);
                
                // if the key was a day, add the day (Mon, Tue, ...) to the day array
                if ($results[0] == $i && count($results) == 2)
                {
                    array_push($days, $results[1]);
                }
                
                // if the key was a time, add the time to the times array
                if ($results[0] == $i && count($results) == 3)
                {
                    array_push($times, $_POST["$key"]);
                }
            }
            
            // insert date-time combination into recurring_reminders table
            foreach ($days as &$day)
            {
                foreach ($times as &$time)
                {
                    $confirm = query("INSERT INTO recurring_reminders (a_id, day, time) 
                        VALUES(?, ?, ?)", $a_id, $day, $time);
                }
            }
        }
        
        redirect("index.php");
    }    
    else
    {
        // retrieve relevant a_id
        $a_id = $_SESSION["a_id"];
        
        // use the a_id to query the user_medication form
        
        $association_info = query("SELECT * FROM user_medication WHERE a_id = ?", $a_id);
            
        // pass in medication name
        $name = query("SELECT proprietary_name, proprietary_name_suffix FROM medication WHERE
            m_id = ?", $association_info[0]["m_id"]);
            
        $proprietary_name = $name[0]["proprietary_name"];
        $proprietary_name_suffix = $name[0]["proprietary_name_suffix"];
      
        // render the form that allows users to input a medication.
        render("set_reminders_form.php", array("title" => "Set Reminders", "a_id" => $a_id, "proprietary_name" => $proprietary_name, "proprietary_name_suffix" => $proprietary_name_suffix));
    }


?>
