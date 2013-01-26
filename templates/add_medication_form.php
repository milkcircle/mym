<script>
    $(function() {

    /* AUTOCOMPLETE AJAX FUNCTION */
        $("#medication_name").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "autocomplete_meds.php",
                    dataType: "json",
                    type: "POST",
                    data: {
                        name_startsWith: request.term
                    },
                    
                    success: function(data) {

                        response($.map(data, function(item){
                            return {
                                label: item.proprietary_name + (item.proprietary_name_suffix ? " " + item.proprietary_name_suffix : ""),
                                value: item.proprietary_name + (item.proprietary_name_suffix ? " " + item.proprietary_name_suffix : "")
                            }
                        }));
                    },
                    minLength: 2

                });
            }
        });
    }
    );

</script>


<div>
    <form action="add_medication.php" method="post">
        <fieldset>
            <div class="control-group">
                <input autofocus name="medication_name" placeholder="Medication Name" type="text" id="medication_name"/>
            </div>
            <div class="control-group">
                <button type="submit" class="btn">Add</button>
            </div>
        </fieldset>
    </form>
</div>