<div> 
    </br></br>
    <!--Your score so far is <?php echo $score?></b>!</br></br>-->
    test<br><br>
    You currently have <?php echo $count?> medicine(s) in your inventory.</br></br>
    
    <?php
    
        $counter = 0;
        
        // display missed meds on home page
        foreach($meds as $med)
        {
            if ($med["missed"] != 0)
            {
                $missed = $med["missed"];
                $m_med = $med["name"];
                echo "<div>Yesterday you missed $missed dose(s) of $m_med.</div>";
                $counter++;
            }
        }
            
        // if there were none, congrats!
        if ($counter == 0)
            echo "<div>Good job! Yesterday you didn't forget any medicines. Keep up your good work!</div>";
            
    ?>
    
</div>
