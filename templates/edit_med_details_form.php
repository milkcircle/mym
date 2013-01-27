<!-- JQuery datepicker object!-->
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
            }
        );
    });

    // 02.00 AM - 03.30 PM, 15 minutes steps.
    $(function() {
        $('.timepicker').timepicker({
        timeFormat: "hh:mm tt"
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

    time_select = "<input type="text" id="time2" size="10" value="12.00 PM"/>"; 
    function addDay(){
        if (fields != 10)
        {
            //document.getElementById('times').innerHTML += time_select;
            $('#times').append(time_select);
            fields += 1;
        }
        else
        {
            $('#times').append("<br />Only 10 times are allowed.");
            document.form.add.disabled=true;
        }
    }
</script>

<div>
    <form action="add_details.php" method="post">
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
                <input type="text" id="time2" size="10" class="timepicker" value="12.00 PM"/>
            </div>

            <div class="control-group">
                <button type="submit" class="btn">Update Medication Details</button>
            </div>
            
        </fieldset>
    </form>
</div>
