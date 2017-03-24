<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
    function ConfirmationMsg() {
    
			  alert("A preowned item has been updated.");
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
    
			  document.UpdateForm.submit();
        ConfirmationMsg();
          
    }
    
</script>
<title>Preowned</title>
<?php
	include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          ItemName
        , Brand
        , Model
        , Engine
        , Transmission
        , Description
        , Price
        FROM
          Preowned
        WHERE
          PreOwnedID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
      
  $pItem = $row[0];
  $pBrand = $row[1];
  $pModel = $row[2];
  $pEngine = $row[3];
  $pTransmission = $row[4];
  $pVDetails = $row[5];
  $pUDetails = br2space($row[5]);
  $pPrice = $row[6];
  
  if ($process == "View") {

	    echo "<div class='DialogForm'>";
	    echo "<h4>Preowned Item Details</h4>";
      echo "<div class='DialogFormContent'>";
	    echo "<div><span class='itemfield'>Item:</span>  <em>$pItem</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Brand:</span>  <em>$pBrand</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Model:</span>  <em>$pModel</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Engine:</span>  <em>$pEngine</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Transmission:</span>  <em>$pTransmission</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Details:</span></div>";
	    echo "<br/>";
      echo "<div><em>$pVDetails</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Price:</span>  $<em>$pPrice</em></div>";
	    echo "<br/>";
      echo "</div>";
      echo "</div>";
      echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";
  
  } else {
  
      echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_updatePreowned.php'>";
	    echo "<div class='DialogForm'>";
	    echo "<h4>Update Preowned Item Details</h4>";
      echo "<div class='DialogFormContent'>";
      echo "<table>";
      echo "<tr>";
      echo "<td class='itemfield'>Item:</td>";
      echo "<td><input type='text' id='txtPItem' name='txtPItem' class='DialogEntry' value='$pItem'/></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Brand:</td>";
      echo "<td><input type='text' id='txtPBrand' name='txtPBrand' class='DialogEntry' value='$pBrand'/></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Model:</td>";
      echo "<td><input type='text' id='txtPModel' name='txtPModel' class='DialogEntry' value='$pModel'/></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Engine:</td>";
      echo "<td><input type='text' id='txtPEngine' name='txtPEngine' class='DialogEntry' value='$pEngine'/></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Transmission:</td>";
      echo "<td>";
      //echo "<input type='text' id='txtPTransmission' name='txtPTransmission' class='DialogEntry' value='$pTransmission'/>";
        
        if ($pTransmission == 'Automatic') {
        
          echo "<select id='txtPTransmission' name='txtPTransmission' class='DialogEntry'>";
          echo "<option value='[Select Transmission]'>[Select Transmission]</option>";
          echo "<option value='Automatic' selected='yes'>Automatic</option>";
          echo "<option value='Manual'>Manual</option>";
          echo "</select>";
          
        } else {
        
          echo "<select id='txtPTransmission' name='txtPTransmission' class='DialogEntry'>";
          echo "<option value='[Select Transmission]'>[Select Transmission]</option>";
          echo "<option value='Automatic'>Automatic</option>";
          echo "<option value='Manual' selected='yes'>Manual</option>";
          echo "</select>";
        
        }
        
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Details:</td>";
      echo "<td><textarea id='txtPDesc' name='txtPDesc' style='width: 330px; border: solid 1px #ccc;'>$pUDetails</textarea></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Price:</td>";
      echo "<td><input type='text' id='txtPPrice' name='txtPPrice' class='DialogEntry' value='$pPrice'/></td>";
      echo "</tr>";
      echo "</table>";
      echo "</div>";
      echo "<div class='DialogFormClose'>";
      echo "<a onclick=\"SubmitForm();\" alt='Update Entry'>Update Entry</a> | ";
      echo "<a onclick=\"ClosePopUp();\" alt='Close'>Close Window</a>";
      echo "</div>";
      echo "<input type='hidden' id='EntryID' name='EntryID' value='$tempID'/>";
      echo "</form>";
  
  }
  
?>