<?php include("../../conf.inc.php");?>
<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<link href="<?php echo "$site_host"?>/scripts/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo "$site_host"?>/scripts/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo "$site_host"?>/scripts/jquery-1.4.4.min.js"></script>

<script type="text/javascript" src="<?php echo "$site_host"?>/scripts/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$site_host"?>/scripts/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo "$site_host"?>/scripts/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript" src="<?php echo "$site_host"?>/admin/views/wysiwyg/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {								
        nicEditors.allTextAreas({
            maxHeight:100,
            buttonList: ['bold','italic','underline','image,','upload','link','unlink','forecolor','fontFamily','fontSize','ol','ul']
        });
    });
    
    $(function () {
        $("#txtEDate").datepicker({
            minDate: new Date()
        });
    });
  
    function ConfirmationMsg() {
        
        alert("An event has been updated.");
        window.opener.location.href = window.opener.location.href;

			  if (window.opener.progressWindow) {
				  window.opener.progressWindow.close()
			  }
        
			  window.close();    
		}
  
    function ClosePopUp() {
    
        window.close();
    }
    
    function validateForm(UpdateForm) {

        if (document.UpdateForm.txtETitle.value == "") {
            alert("Please provide a title for your Event!");
            document.UpdateForm.txtATitle.focus();
            return false;
        }
        
        if (document.UpdateForm.txtEVenue.value == "") {
            alert("Please provide a venue for your Event!");
            document.UpdateForm.txtEVenue.focus();
            return false;
        }
        
        if (document.UpdateForm.txtEDate.value == "") {
            alert("Please provide a date for your Event!");
            document.UpdateForm.txtEDate.focus();
            return false;
        }
 
        //return true;        
        var details = $(".nicEdit-main").html();
        var eDesc = document.UpdateForm.txtEDesc;
        
        eDesc.value = details;
        
        document.UpdateForm.submit();
        ConfirmationMsg();
    }
    
    function SubmitForm() { 

        return validateForm(UpdateForm);
    }
    
</script>
<title>Events</title>
<?php	
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          EventTitle
        , EventDesc
        , DATE_FORMAT(EventDate,'%m/%d/%Y')
        , EventVenue        
        FROM
          Events
        WHERE
          EventID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
      
  $eTitle   = $row[0];
  $vDetails = $row[1];
  $uDetails = br2space($row[1]);
  $eDate    = $row[2];
  $eVenue   = $row[3];
  
  if ($process == "View") {

	    echo "<div class='DialogForm'>";
	    echo "<h4>Event Details</h4>";
      echo "<div class='DialogFormContent'>";
	    echo "<div><span class='itemfield'>Title:</span><span class='v-field'>  <em>$eTitle</em></span></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Venue:</span><span class='v-field'>  <em>$eVenue</em></span></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Date:</span><span class='v-field'>  <em>$eDate</em></span></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Details:</span></div>";
	    echo "<br/>";
      echo "<div class='v-field'><em>$vDetails</em></div>";
	    echo "<br/>";
      echo "</div>";
      echo "</div>";
      echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";
  
  } else {
  
      echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_events.php'>";
	    echo "<div class='DialogForm'>";
	    echo "<h4>Update Event</h4>";
      echo "<div class='DialogFormContent'>";
      echo "<table>";
      echo "<tr>";
      echo "<td class='itemfield'>Title:</td>";
      echo "<td><input type='text' id='txtETitle' name='txtETitle' class='DialogEntry' value='$eTitle'/></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Venue:</td>";
      echo "<td><input type='text' id='txtEVenue' name='txtEVenue' class='DialogEntry' value='$eVenue'/></td>";
      echo "</tr>";      
      echo "<tr>";
      echo "<td class='itemfield'>Details:</td>";
      echo "<td><textarea id='txtEDesc' name='txtEDesc' class='cypher-Textarea'>$uDetails</textarea></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Date:</td>";
      echo "<td><input type='text' id='txtEDate' name='txtEDate' class='DialogEntry' value='$eDate'/></td>";
      echo "</tr>";
      echo "</table>";
      echo "</div>";
      echo "<input type='hidden' id='Process' name='Process' value='Update'/>";
      echo "<div class='DialogFormClose'>";
      echo "<a onclick=\"SubmitForm();\" alt='Update Entry'>Update Entry</a> | ";
      echo "<a onclick=\"ClosePopUp();\" alt='Close'>Close Window</a>";
      echo "</div>";
      echo "<input type='hidden' id='EntryID' name='EntryID' value='$tempID'/>";
      echo "</form>";
  
  }
  
?>