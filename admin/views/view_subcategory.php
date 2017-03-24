<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
    function validateForm(UpdateForm) {

        if (document.UpdateForm.txtSCName.value == "") {
            alert("Please provide a value for the Subcategory name!");
            document.UpdateForm.txtSCName.focus();
            return false;
        }
        
        if (document.UpdateForm.selCategory.value == "Select a Category") {
            alert("Please select a Category!");
            document.UpdateForm.selCategory.focus();
            return false;
        }
        
        if (document.UpdateForm.txtSCDesc.value == "") {
            alert("Please provide a short description for the Subcategory!");
            document.UpdateForm.txtSCDesc.focus();
            return false;
        }                        
            
        //return true;        
        document.UpdateForm.submit();
        ConfirmationMsg();
    }
  
    function ConfirmationMsg() {
    
			  alert("Subcategory has been updated.");
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
<title>Subcategory</title>
<?php
  include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          Product_Subcategory.SubCategoryName
          , Product_Category.CategoryName
          , Product_Subcategory.Description
          , Product_Subcategory.CategoryID
        FROM 
          Product_Subcategory
          , Product_Category
        WHERE
          Product_Category.CategoryID = Product_Subcategory.CategoryID
        AND
          Product_Subcategory.SubcategoryID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
 
  $sCName = $row[0];  
  $cName = $row[1];  
  $vAContent = $row[2];
  $uAContent = br2space($row[2]);
  $cID = $row[3];

  if ($process == "View") {
  
    echo "<div class='DialogForm'>";
	  echo "<h4>Subcategory Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Subcategory Name:</span></td>";
    echo "<td class='v-field'><em>$sCName</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Category Name:</span></td>";
    echo "<td class='v-field'><em>$cName</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Description:</span></td>";
    echo "<td class='v-field'><em>$vAContent</em></td>";    
	  echo "</tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";  
  
  } else {
  
    echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_subcategory.php'>";
    echo "<div class='DialogForm'>";
    echo "<h4>Update Subcategory Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='itemfield'>Subcategory Name:</td>";
    echo "<td><input type='text' id='txtSCName' name='txtSCName' class='DialogEntry' value='$sCName'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Category Name:</td>";
    //echo "<td><input type='text' id='txtCName' name='txtCName' class='DialogEntry' value='$cName'/></td>";
    echo "<td>";
    echo "<select id='selCategory' name='selCategory' class='cypher-FormField' style='border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 250px;'>";
    echo "<option value='Select a Category'>Select a Category</option>";
        
        $sc_sql = "SELECT CategoryID, CategoryName FROM Product_Category WHERE Status = '1' ORDER BY CategoryID ASC";
              
        $sc_num_rows = mysql_num_rows($sc_sql);
        
        $sc_rs = mysql_query($sc_sql);
        
        while($sc_row = mysql_fetch_array($sc_rs))
        {
          if ($sc_row[0] == $cID) {
            echo "<option selected='yes' value='$sc_row[0]'>$sc_row[1]</option>";
          } else {
            echo "<option value='$sc_row[0]'>$sc_row[1]</option>";            
          }
        }
    
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Description:</td>";
    echo "<td><textarea id='txtSCDesc' name='txtSCDesc' style='width: 330px; border: solid 1px #ccc;'>$uAContent</textarea></td>";
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