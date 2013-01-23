<div>
    <table class="table table-striped" align="center">
        <tr>
            <th>
                Mind Your Meds is the first adventure into web programming for Aaron 
                Cheng and Leo Guttmann, both Harvard Class of 2015. They are excited 
                to help people remember to take their medications through a point 
                system that encourages participation from forgetful people.
            </th>
        </tr>
    </table>
</div>
<div>
    <table class="table table-striped" align="center">
        <thead>
            <tr>
                <th>Aaron Cheng</th>
                <th>Leo Guttmann</th>
            </tr>
            <tr>
                <th>Sophomore at Harvard concentrating in Applied Math/Biology</th>
                <th>Sophomore at Harvard concentrating in Applied Math/Economics</th>
            </tr>
        </thead>
        <tr>
        <td width="50%"><center><img src="img/aaron.jpeg"></center></td>
        <td width="50%"><center><img src="img/leo.jpeg"></center></td>
        </tr>
    </table>
</div>
<div>
    </br>
    <?php
        if(empty($_SESSION["id"]))
            print("<a href=\"login.php\">Log in</a>");
    ?>
</div>
