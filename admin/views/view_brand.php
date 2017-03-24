<?php include("../../conf.inc.php");?>
<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo "$site_host"?>/scripts/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo "$site_host"?>/scripts/jquery-1.4.4.min.js"></script>

<script type="text/javascript" src="<?php echo "$site_host"?>/admin/views/wysiwyg/nicEdit.js"></script>

<script type="text/javascript">
    bkLib.onDomLoaded(function() {								
        nicEditors.allTextAreas({
            maxHeight:100,
            buttonList: ['bold','italic','underline','link','unlink','forecolor','fontFamily','fontSize','ol','ul']
        });
    });
  
    function validateForm(UpdateForm) {
        
        if (document.UpdateForm.txtBName.value == "") {
            alert("Please provide a value for the Brand Name!");
            document.UpdateForm.txtBName.focus();
            return false;
        }
                                  
        //return true;
        var details = $(".nicEdit-main").html();
        var eDesc = document.UpdateForm.txtBDesc;
        
        eDesc.value = details; 
        
        document.UpdateForm.submit();
        ConfirmationMsg();
        
    }
  
    function ConfirmationMsg() {
    
			  alert("Brand has been updated.");
			  window.opener.location.href = window.opener.location.href;

			  if (window.opener.progressWindow) {
				  window.opener.progressWindow.close()
			  }
        
			  window.close();
        
		}
  
    function ClosePopUp() {
    
        window.close();
        
    }
  
    function SubmitForm() { 
    
			  return validateForm(UpdateForm);
        
    }
    
</script>
<title>Brand</title>
<?php  
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          BrandName
          , BrandCode
          , Description
          , SideLinkText
          , SideLinkURL
          , BrandWebsite
        FROM 
          Brand
        WHERE 
          BrandID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
 
  $bName          = $row[0];
  $bCode          = $row[1];
  $vAContent      = $row[2];
  $uAContent      = $row[2];
  //$uAContent      = br2space($row[2]);
  $bSideLinkText  = $row[3];
  $bSideLinkURL   = $row[4];
  $bWebsite       = $row[5];
  
  if ($process == "View") {
  
    echo "<div class='DialogForm'>";
	  echo "<h4>Brand Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Brand Code:</span></td>";
    echo "<td class='v-field'><em>$bCode</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Brand Name:</span></td>";
    echo "<td class='v-field'><em>$bName</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Description:</span></td>";
    echo "<td class='v-field'><em>$vAContent</em></em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Brand Website:</span></td>";
    echo "<td class='v-field'><em>$bWebsite</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Side Link Text:</span></td>";
    echo "<td class='v-field'><em>$bSideLinkText</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Side Link URL:</span></td>";
    echo "<td class='v-field'><em>$bSideLinkURL</em></td>";    
	  echo "</tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";  
  
  } else {
  
    echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_brand.php'>";
    echo "<div class='DialogForm'>";
    echo "<h4>Update Brand Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='itemfield'>Brand Code:</td>";
    echo "<td><span class='DialogEntry' style='border: none; color: #222;'>$bCode</span></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Brand Name:</td>";
    echo "<td><input type='text' id='txtBName' name='txtBName' class='DialogEntry' value='$bName'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Description:</td>";
    echo "<td><textarea id='txtBDesc' name='txtBDesc' style='width: 380px; border: solid 1px #ccc; padding: 2px 4px 2px 4px;'>$uAContent</textarea></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Brand Website:</td>";
    echo "<td><input type='text' id='txtBWebsite' name='txtBWebsite' class='DialogEntry' value='$bWebsite'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Side Link Text:</td>";
    echo "<td><input type='text' id='txtBSideLinkText' name='txtBSideLinkText' class='DialogEntry' value='$bSideLinkText'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Side Link URL:</td>";
    echo "<td><input type='text' id='txtBSideLinkURL' name='txtBSideLinkURL' class='DialogEntry' value='$bSideLinkURL'/></td>";
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