<?php
    /********************************************************************
    * reset.php
    * 
    * Computer Science 50
    * Final Project
    *
    * Sets each medicine to have no doses taken for the new day. Also
    * calculates the amount of medicine the users forgot.
    ********************************************************************/
    
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

    // take all information from meds table
    $rows = query("SELECT * FROM meds");
    
    // iterate through medicines
    foreach($rows as $row)
    {
        // simplify variables
        $freq = $row["freq"];
        $id = $row["id"];
        $name = $row["name"];
        $current = $row["current"];
        $score = $row["score"];
        
        // set missed based on how many medicines still need to be taken
        query("UPDATE meds SET missed = $current WHERE id = $id");
        
        // subtracts missed meds from score, but never lets score fall below 0
        if ($score - $current < 0)
        {
            query("UPDATE users SET score = 0 WHERE id = $id");
        }
        else
        {
            query("UPDATE users SET score = score - $current WHERE id = $id");
        }
        
        // reset how many doses still need to be taken for the new day
        query("UPDATE meds SET current = $freq WHERE name = '$name' AND id = $id");
    }
    
?>
