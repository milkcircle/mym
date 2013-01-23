<div>
    <table class="table table-striped" align="center"><caption><font size="4"><b>Notification Log</b></font></caption>
        <thead>
            <tr>
                <th>Medicine</th>
                <th>Time of Day</th>
                <th>Email, Phone, or Both?</th>
                <th>Change or Delete</th>
            </tr>
        </thead>
        <?php
        
            // print medicine information.
            foreach($rows as $row)
            {
            
                // only do this if a notification exists! (i.e. if send is not 0)
                if ($row["send"] != 0)
                {
                
                    // calculate times
                    $sec = $row["time"] % 60;
                    $min = ($row["time"] % 3600 - $sec) / 60;
                    $hour = ($row["time"] - $sec - 60*$min) / 3600;
                    $e = "";

                    $pm = "am";
                    
                    // distinguish between am/pm
                    if ($hour > 11)
                    {
                        $pm = "pm";
                    }
                    
                    if($hour > 12)
                    {
                        $hour = $hour - 12;
                    }
                    
                    if($hour == 0)
                    {
                        $hour = 12;
                    }

                    
                    // distinguish between types of notifications
                    if ($row["send"] == 1)
                        $e = "E-mail";
                    if ($row["send"] == 2)
                        $e = "Phone";
                    if ($row["send"] == 3)
                        $e = "Both";
                    
                    // append everything
                    print("<tr>");
                    print("<td>" . $row["med"] . "</td>");
                    print("<td>" . $hour . ":");
                    if ($min < 10)
                        print ("0");
                    print($min . $pm . "</td>");
                    print("<td>" . $e . "</td>");
                    
                    // simplify variables
                    $name = $row["med"];
                    $counter = $row["counter"];
                    
                    // change, add, or delete
                    print("<td>");
                    echo "<form action=\"list.php\" method=\"post\"><fieldset>";
                        
                    print("<button name=\"delete\" value=\"$counter'$name\" type=\"submit\" class=\"btn\">Delete</button>");
                    print("&nbsp&nbsp");
                    print("<button name=\"change\" value=\"$counter'$name\" type=\"submit\" class=\"btn\">Change</button>");
                                       
                    print("</form>");
                    print("</fieldset>");
                    
                    print("</td>");
                    print("</tr>");
                }
                
            }
            
        ?>
    </table>
</div>

<br><br>

<div>
    <table class="table table-striped" align="center"><caption><font size="4"><b>Add a Notification</b></font></caption>
        <thead>
            <tr>
                <th>Medicine</th>
                <th>Add a Notification</th>
            </tr>
        </thead>
        <?php

            // print medicine information.
            foreach($meds as $med)
            {
                $name = $med["name"];
                
                // if there still exists, for this medication, an unused notification, print an add button.
                if ($send["$name"] > 0)
                {
                    print("<tr>");
                    print("<td>" . $med["name"] . "</td>");
                    
                    $name = $med["name"];
                    
                    print("<td>");
                    echo "<form action=\"list.php\" method=\"post\"><fieldset>";
                        
                    print("<button name=\"add\" value=\"$name\" type=\"submit\" class=\"btn\">Add</button>");
                                       
                    print("</form>");
                    print("</fieldset>");
                    print("</td>");
                    print("</tr>");
                }
            }
            
        ?>
    </table>
</div>
