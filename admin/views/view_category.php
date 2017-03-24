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

        if (document.UpdateForm.txtCName.value == "") {
            alert("Please provide a value for the Category Name!");
            document.UpdateForm.txtCName.focus();
            return false;
        }
            
        if (document.UpdateForm.txtCDesc.value == "") {
            alert("Please provide a short description for the Category!");
            document.UpdateForm.txtCDesc.focus();
            return false;
        }                        
            
        //return true;
        var details = $(".nicEdit-main").html();
        var eDesc = document.UpdateForm.txtCDesc;
        
        eDesc.value = details;
        
        document.UpdateForm.submit();
        ConfirmationMsg();
    }
  
    function ConfirmationMsg() {
    
			  alert("Category has been updated.");
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
<title>Category</title>
<?php  
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          CategoryName
          , Description          
        FROM 
          Product_Category
        WHERE 
          CategoryID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
 
  $cName = $row[0];  
  $vAContent = $row[1];
  $uAContent = br2space($row[1]);
  
  if ($process == "View") {
  
    echo "<div class='DialogForm'>";
	  echo "<h4>Category Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
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
  
    echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_category.php'>";
    echo "<div class='DialogForm'>";
    echo "<h4>Update Category Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='itemfield'>Category Name:</td>";
    echo "<td><input type='text' id='txtCName' name='txtCName' class='DialogEntry' value='$cName'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Description:</td>";
    echo "<td><textarea id='txtCDesc' name='txtCDesc' style='width: 380px; border: solid 1px #ccc;'>$uAContent</textarea></td>";
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