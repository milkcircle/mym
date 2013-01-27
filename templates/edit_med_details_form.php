<!-- JQuery datepicker object!-->
<script>
    $(function() {
        $( ".datepicker" ).datepicker( {
            dateFormat: 'yy-mm-dd'
            }
        );
    });
</script>

<script language="javascript">
    fields = 0;
    function addInput(){
        if (fields != 10)
        {
            document.getElementById('times').innerHTML += "<select><option value = 'hi'>hi</option></select><br />";
            fields += 1;
        }
        else
        {
        document.getElementById('times').innerHTML += "<br />Only 10 upload fields allowed.";
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
                    <input type="button" class = "btn" onclick="addInput()" name="add" value="Add input field" />
                </form>
            <div/>

            <div id="times">

            </div>

            <div class="control-group">
                <button type="submit" class="btn">Update Medication Details</button>
            </div>
            
        </fieldset>
    </form>
</div>
