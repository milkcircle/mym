
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
            }
        );
    });
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
        				<input name="start_date" type="text" class="datepicker" placeholder="<?= $start_placeholder?>"/>
        			</td>
        		</tr>
        		<tr>
        			<td style="text-align:right; vertical-align: middle">
        				When will you stop taking them?
        			</td>
        			<td valign="top">
        				<input name="end_date" type="text" class="datepicker" placeholder="<?= $end_placeholder?>"/>
        			</td>
        		</tr>
        		<tr>
        			<td style="text-align:right; vertical-align: middle">
        				When do you need to refill?
        			</td>
        			<td valign="top">
        				<input name="refill_date" type="text" class="datepicker" placeholder="<?= $refill_placeholder?>"/>
        			</td>
        		</tr>
        		<tr>
        			<td style="text-align:right; vertical-align: middle">
        				Write down any important reminders.
        			</td>
        			<td valign="top">
                        <!-- this doesn't store any newlines !-->
                        <textarea class="xxlarge" type="text" name="details" placeholder="<?= $details_placeholder?>" rows="3"></textarea>
        				<!--<input name="details" type="text" placeholder="<?= $details_placeholder?>"/>-->
        			</td>
        		</tr>
        	</table>

            <br/>

            <div class="control-group">
                <center><button type="submit" class="btn btn-large">Update!</button></center>
            </div>
            
        </fieldset>
    </form>
</div>
