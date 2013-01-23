<form action="reminder.php" method="post">
    <fieldset>
        When do you want to set your reminders for <?php echo $med?>?</br>
        *NOTE: A notification will only be registered if you choose a "Send to:" option!</br>
        **Eastern Standard Time.</br></br>
        <div class="control-group">
        <table class="table table-striped" align="center">
            <thead>
                <td>Hour</td>
                <td>Minute</td>
                <td>AM/PM</td>
                <td>Send to:</td>
            </thead>
        
        <?php

            // for every time a med needs to be taken in a day...
            $counter = 0;
            while ($counter < $freq)
            {
                echo "<tr>";
                
                // drop down menu for hour
                $hour = 1;
                echo "<td>";
                echo "<select name='$counter-h'>";
                while ($hour < 13)
                {
                    echo "<option value='$hour'>$hour</option>";
                    $hour++;
                }
                echo "</select>";
                echo "</td>";
                
                // drop down menu for minute
                $minute = 0;
                echo "<td>";
                echo "<select name='$counter-m'>";
                while ($minute < 60)
                {
                    echo "<option value='$minute'>$minute</option>";
                    $minute++;
                }
                echo "</select>";
                echo "</td>";
                
                // drop down menu for am/pm                
                echo "<td>";
                echo "<select name='$counter-pm'>";
                echo "<option value='am'>am</option>";
                echo "<option value='pm'>pm</option>";
                echo "</select>";
                echo "</td>";
                
                // drop down menu for email
                echo "<td>";
                echo "<select name='$counter-e'>";
                echo "<option value=\"0\"></option>";
                echo "<option value=\"1\">Email</option>";
                echo "<option value=\"2\">Phone</option>";
                echo "<option value=\"3\">Both</option>";
                echo "</select>";
                echo "</td>";
                
                echo "</tr>";
                
                $counter++;
            }
                    
        ?>
        
        </table>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Add</button>
        </div>
    </fieldset>
</form>

