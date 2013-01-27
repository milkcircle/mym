<script>
    $(function() {
        $( ".datepicker" ).datepicker( {
            dateFormat: 'yy-mm-dd'
            }
        );
    });
</script>

<div>
    <form action="add_details.php" method="post">
        <fieldset>
            <div class="control-group">
                <p>Refill Date: <input name="refill_date" type="text" class="datepicker" placeholder="<?= $refill?>"/></p>
            </div>
            <br/><br/>
            
            <div class="control-group">
                <p>Treatment Start Date: <input name="start_date" type="text" class="datepicker" placeholder="<?= $start?>"/></p>
            </div>
            <br/><br/>
            
            <div class="control-group">
                <p>Treatment End Date: <input name="end_date" type="text" class="datepicker" placeholder="<?= $end?>"/></p>
            </div>
            <br/><br/>
            
            <div class="control-group">
                <p>Drug details: <input name="details" type="text" placeholder="<?= $details?>"/></p>
            </div>
            <br/><br/>
            
            <div class="control-group">
            <button type="submit" class="btn">Update Medication Details</button>
            </div>
            
        </fieldset>
    </form>
</div>
