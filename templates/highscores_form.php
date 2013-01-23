<div>
    <table class="table table-striped" align="center">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
            </tr>
        </thead>
        <?php
        
            // print medicine information.
            $i = 1;
            foreach($rows as $row)
            {
                print("<tr>");
                print("<td>" . $i . "</td>");
                print("<td>" . $row["username"] . "</td>");
                print("<td>" . $row["score"] . "</td>");
                print("</tr>");
                $i++;
            }
            
        ?>
    </table>
</div>

