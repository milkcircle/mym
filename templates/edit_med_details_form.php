
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
            }
        );
    });

</script>

<script language="javascript">


    var row;
    row_num = 0;
    b_days = true; // true if limit has not been reached
    function addRow(){
        row = 	'<tr id = "row ' + row_num.toString() + '"/tr>' +
                    '<td width="50%" valign="top">' +
                        '<div>' +
                            "<table class='checkboxes' name='day " + row_num.toString() + "'>"  + 
		                            "<td><input type='checkbox' name='" + row_num.toString() + "-mon' value='1'>Mon</td>" +
		                            "<td><input type='checkbox' name='" + row_num.toString() + "-tue' value='2'>Tue</td>" +
		                            "<td><input type='checkbox' name='" + row_num.toString() + "-wed' value='3'>Wed</td>" +
		                            "<td><input type='checkbox' name='" + row_num.toString() + "-thu' value='4'>Thu</td>" +
		                            "<td><input type='checkbox' name='" + row_num.toString() + "-fri' value='5'>Fri</td>" +
		                            "<td><input type='checkbox' name='" + row_num.toString() + "-sat' value='6'>Sat</td>" +
		                            "<td><input type='checkbox' name='" + row_num.toString() + "-sun' value='0'>Sun</td>" +
		                    "</table>" +
                        '</div>' +
                    '</td>' +
                    '<td width="50%" valign="top">' +
                        '<div class="control-group">' +
                            '<form name="form">' +
                                '<input type="button" class="btn" onclick="addTime(' + "'" + row_num.toString() + "'" + ')" name="add" value="Add more times!" />' +
                            '</form>' +
                        '</div>' +
                        '<div id="times_' + row_num.toString() + '">' +
                            // where times get inserted!
                        '</div>' +
                    '</td>' +
                '</tr>';

        if (row_num != 7)
        {
            $('.rows').append(row);
            row_num += 1;
            // make items into checkboxes
            $('input:checkbox');
        }
        else
        {
            if (b_days)
                $('.rows').append("<br />Only 7 rows are allowed!");
            b_days = false;
        }
    }

    time_fields = 0;
    b_times = true; // true if limit has not been reached
    function addTime(row){
        if (time_fields != 10)
        {
            $('#times_' + row).append("<input type='text' name='" + row + "-time-" + time_fields.toString() + "' size='10' placeholder='Enter your time!' class='timepicker'/><br/>");
            time_fields += 1;
            $('.timepicker').timepicker({
                timeFormat: "hh:mm:tt",
                stepMinute: 15
            });
        }
        else
        {
            if (b_times)
                $('#times_' + row).append("Only 10 times are allowed!");
            b_times = false;
        }
    }
</script>

<div>
    <h3><?= "$proprietary_name $proprietary_name_suffix"?></h3>
</div>

<div>
    <form action="edit_med_details.php" method="post">
        <fieldset>

        	<table class="table table-striped">
        		<tr>
        			<td style="text-align:right; vertical-align: middle">
        				When will you begin?
        			</td>
        			<td valign="top">
        				<input name="start_date" type="text" class="datepicker" placeholder="<?= $start?>"/>
        			</td>
        		</tr>
        		<tr>
        			<td style="text-align:right; vertical-align: middle">
        				When will you stop taking them?
        			</td>
        			<td valign="top">
        				<input name="end_date" type="text" class="datepicker" placeholder="<?= $end?>"/>
        			</td>
        		</tr>
        		<tr>
        			<td style="text-align:right; vertical-align: middle">
        				When do you need to refill?
        			</td>
        			<td valign="top">
        				<input name="refill_date" type="text" class="datepicker" placeholder="<?= $refill?>"/>
        			</td>
        		</tr>
        		<tr>
        			<td style="text-align:right; vertical-align: middle">
        				Write down any important reminders.
        			</td>
        			<td valign="top">
        				<input name="details" type="text" placeholder="<?= $details?>"/>
        			</td>
        		</tr>
        	</table>

            <div class="control-group">
	            <form name="form">
	                <input type="button" class = "btn" onclick="addRow()" name="add" value="Add more rows!" />
	            </form>
	        <div/>

        <table class="table table-striped">
            <thead>
                    <th>Days</th>
                    <th>Times</th>
            </thead>
            <tbody class = "rows">
            	<!-- rows go in here! !-->
            </tbody>
        </table>

            <div class="control-group">
                <button type="submit" class="btn">Update!</button>
            </div>
            
        </fieldset>
    </form>
</div>
