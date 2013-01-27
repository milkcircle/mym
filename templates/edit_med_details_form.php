
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
            }
        );
    });

    $(function() {
        $('.timepicker').timepicker({
            timeFormat: "hh:mm:tt",
            stepMinute: 15
        });
    });
</script>

<script language="javascript">
    fields = 0;

    day_select = "<select>" +
    "<option value = 'Monday'>Monday</option>" +
    "<option value = 'Tuesday'>Tuesday</option>" +
    "<option value = 'Wednesday'>Wednesday</option>" +
    "<option value = 'Thursday'>Thursday</option>" +
    "<option value = 'Friday'>Friday</option>" +
    "<option value = 'Saturday'>Saturday</option>" +
    "<option value = 'Saturday'>Saturday</option>" +
    "<select></br>"; 

    time_select = "<input type='text' id='time' size='10' class='timepicker' value='12.00 PM'/><br/>"; 
    function addDay(){
        if (fields != 10)
        {
            $('#times').append("<input type='text' name='time " + fields.toString() + "' size='10' class='timepicker' value='12.00 PM'/><br/>");
            fields += 1;
            $('.timepicker').timepicker({
                timeFormat: "hh:mm:tt",
                stepMinute: 15
            });
        }
        else
        {
            $('#times').append("<br />Only 10 times are allowed.");
            document.form.add.disabled=true;
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

            <div class="control-group">
                <form name="form">
                    <input type="button" class = "btn" onclick="addDay()" name="add" value="click me" />
                </form>
            <div/>

            <div id="times">
                <input type='text' name='time' size='10' class='timepicker' value='12.00 PM'/><br/>
            </div>

            <div class="control-group">
                <button type="submit" class="btn">Update Medication Details</button>
            </div>
            
        </fieldset>
    </form>
</div>
