
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
            }
        );
    });

</script>

<script language="javascript">
    
    day_select = "<select>" +
    "<option value = 'Monday'>Monday</option>" +
    "<option value = 'Tuesday'>Tuesday</option>" +
    "<option value = 'Wednesday'>Wednesday</option>" +
    "<option value = 'Thursday'>Thursday</option>" +
    "<option value = 'Friday'>Friday</option>" +
    "<option value = 'Saturday'>Saturday</option>" +
    "<option value = 'Saturday'>Saturday</option>" +
    "<select></br>";
    day_fields = 0;
    b_days = true; // true if limit has not been reached
    function addDay(){
        if (day_fields != 7)
        {
            $('#days').append(day_select);
            day_fields += 1;
        }
        else
        {
            if (b_days)
                $('#days').append("<br />Only 7 entries are allowed!");
            b_days = false;
        }
    }

    time_fields = 0;
    b_times = true; // true if limit has not been reached
    function addTime(){
        if (time_fields != 10)
        {
            $('#times').append("<input type='text' name='time " + time_fields.toString() + "' size='10' class='timepicker' value='12.00 PM'/><br/>");
            time_fields += 1;
            $('.timepicker').timepicker({
                timeFormat: "hh:mm:tt",
                stepMinute: 15
            });
        }
        else
        {
            if (b_times)
                $('#times').append("Only 10 times are allowed!");
            b_times = false;
        }
    }
</script>

<div>
    <b><?php echo "$proprietary_name $proprietary_name_suffix"?></b>
</div>

<div>
    <form action="edit_med_details.php" method="post">
        <fieldset>
            <div class="control-group">
                <p>Refill Date: <input name="refill_date" type="text" class="datepicker" placeholder="<?= $refill?>"/></p>
            </div>
            
            <div class="control-group">
                <p>Treatment Start Date: <input name="start_date" type="text" class="datepicker" placeholder="<?= $start?>"/></p>
            </div>
            
            <div class="control-group">
                <p>Treatment End Date: <input name="end_date" type="text" class="datepicker" placeholder="<?= $end?>"/></p>
            </div>
            
            <div class="control-group">
                <p>Drug details: <input name="details" type="text" placeholder="<?= $details?>"/></p>
            </div>

            

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Days</th>
                    <th>Times</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top">
                        <div class="control-group">
                            <form name="form">
                                <input type="button" class = "btn" onclick="addDay()" name="add" value="Add more days!" />
                            </form>
                        <div/>

                        <div id="days">
                        </div>
                    </td>
                    <td valign="top">
                        <div class="control-group">
                            <form name="form">
                                <input type="button" class = "btn" onclick="addTime()" name="add" value="Add more times!" />
                            </form>
                        <div/>

                        <div id="times">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

            <div class="control-group">
                <button type="submit" class="btn">Update Medication Details</button>
            </div>
            
        </fieldset>
    </form>
</div>
