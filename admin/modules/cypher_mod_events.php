<script type="text/javascript">
    $(this).ready(function(){
        var eventDateField = $('#txtEDate');
        eventDateField.datepicker({
            minDate: new Date()
        });
        
        var formId = $('#cypherEventForm');
        formId.submit(function() {
            var eventFields = {
                title: $('#txtETitle'),
                venue: $('#txtEVenue'),
                eventDate: $('#txtEDate')
            }
        
            if (eventFields.title.val() == "") {
                alert("Please enter an Event title!");
                eventFields.title.focus();
                return false;
            }
        
            if (eventFields.venue.val() == "") {
                alert("Please enter venue for the Event!");
                eventFields.venue.focus();
                return false;
            }            
            
            if (eventFields.eventDate.val() == "") {
                alert("Please enter date for the Event!");
                eventFields.eventDate.focus();
                return false;
            }
            return true;
        });
    });    
</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

if ($p == 'c') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>New</legend>
                <div id="crudForm">
                    <form id="cypherEventForm" name="cypherEventForm" method="POST" action="common/q_events.php">
                        <p>
                            Please fill-up the required fields below.
                        </p>
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Title:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtETitle" name="txtETitle" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Venue:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtEVenue" name="txtEVenue" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Date:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtEDate" name="txtEDate" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Description:</label>
                                </td>
                                <td>
                                    <textarea id="txtEDesc" name="txtEDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
                                    <!--<span class="requiredField">*</span>-->
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="Process" name="Process" value="Add"/>
                        <div class="form_buttons">
                            <input id="cypher-Submit" type="Submit" value="Add" class="module-buttons"/>
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "events", "Cancel"); ?>
                            <input id="reset" type="reset" value="Reset" class="module-buttons"/>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} elseif ($p == 'u') {
    $q = "SELECT * FROM Events WHERE EventID = '$recID'";
    $rs = mysql_query($q);
    $row = mysql_fetch_array($rs);

    $eventDate = $row[EventDate];
    $eventDate = date_create($eventDate);
    $eventDate = date_format($eventDate, 'd/m/Y');
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>Update</legend>
                <div id="crudForm">
                    <form id="cypherEventForm" name="cypherEventForm" method="POST" action="common/q_events.php">
                        <p>
                            Please fill-up the required fields below.
                        </p>
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Title:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtETitle" name="txtETitle" class="cypher-FormField" value="<?php echo $row[EventTitle]; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Venue:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtEVenue" name="txtEVenue" class="cypher-FormField" value="<?php echo $row[EventVenue]; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Date:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtEDate" name="txtEDate" class="cypher-FormField" value="<?php echo $eventDate; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Description:</label>
                                </td>
                                <td>
                                    <textarea id="txtEDesc" name="txtEDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;">
                                        <?php echo stripslashes($row[EventDesc]); ?>
                                    </textarea>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="Process" name="Process" value="Update"/>
                        <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $recID; ?>"/>
                        <div class="form_buttons">
                            <input id="cypher-Submit" type="Submit" value="Update" class="module-buttons"/>
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "events", "Cancel"); ?>
                            <input id="reset" type="reset" value="Reset" class="module-buttons"/>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} elseif ($p == 'v') {
    $q = "SELECT * FROM Events WHERE EventID = '$recID'";
    $rs = mysql_query($q);
    $row = mysql_fetch_array($rs);

    $eventDate = $row[EventDate];
    $eventDate = date_create($eventDate);
    $eventDate = date_format($eventDate, 'd/m/Y');
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>View</legend>
                <div id="crudForm" style="margin-top: 10px;">
                    <form id="cypherEventForm" name="cypherEventForm" method="POST" action="common/q_events.php">
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Title:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo stripslashes($row[EventTitle]); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Venue:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo stripslashes($row[EventVenue]); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Date:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $eventDate; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Event Description:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo stripslashes($row[EventDesc]); ?>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="Process" name="Process" value="View"/>
                        <div class="form_buttons">                            
                            <?php moduleUpdate("../admin/index.php?pg=", "", "module-buttons", "", "events", "Edit", $recID); ?> | 
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "events", "Back"); ?>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
}
?>