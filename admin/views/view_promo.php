<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
    function validateForm(UpdateForm) {

        if (document.UpdateForm.txtPName.value == "") {
            alert("Please provide a value for the Promo Name!");
            document.UpdateForm.txtPName.focus();
            return false;
        }
            
        if (document.UpdateForm.txtPDesc.value == "") {
            alert("Please provide a short description for the Promo!");
            document.UpdateForm.txtPDesc.focus();
            return false;
        }                        
            
        //return true;        
        document.UpdateForm.submit();
        ConfirmationMsg();
    }
  
    function ConfirmationMsg() {
    
			  alert("Promo has been updated.");
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
<title>Promos</title>
<?php
  include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          PromoName
          , Description
          , PromoBanner
          , FileLocation
        FROM 
          Promos
        WHERE 
          PromoID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
 
  $pName = $row[0];  
  $vAContent = $row[1];
  $uAContent = br2space($row[1]);
  
  $ImgFile = $row[2];
  $ImgLocation = $row[3];
  
  if ($process == "View") {
  
    echo "<div class='DialogForm'>";
	  echo "<h4>Promo Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table style='width: 100%'>";
    echo "<tr>";
    echo "<td valign='top' style='width: 260px;'>";
    echo "<div>";
    echo "<img src='$site_host/$ImgLocation/$ImgFile' class='img-promo'/>";
    echo "</div>";
    echo "</td>";
    echo "<td valign='top' style='border: solid 1px #ccc; padding: 8px 4px 2px 4px; background-color: #f9f9f9;'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Promo Name:</span></td>";
    echo "<td class='v-field'><em>$pName</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Description:</span></td>";
    echo "<td class='v-field'><em>$vAContent</em></td>";    
	  echo "</tr>";
    echo "</table>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";    
    echo "</div>";
    echo "</div>";
    echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";  
  
  } else {
  
    echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_promos.php'>";
    echo "<div class='DialogForm'>";
    echo "<h4>Update Promo Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='itemfield'>Promo Name:</td>";
    echo "<td><input type='text' id='txtPName' name='txtPName' class='DialogEntry' value='$pName'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Description:</td>";
    echo "<td><textarea id='txtPDesc' name='txtPDesc' style='width: 330px; border: solid 1px #ccc;'>$uAContent</textarea></td>";
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