<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
    function ChangeFile() {
        if (document.UpdateForm.chkUploadFile.checked == false) {          
            document.UpdateForm.NewFile.value = "0";
            document.UpdateForm.uploadedfile.disabled = true;
        } else {
            document.UpdateForm.NewFile.value = "1";
            document.UpdateForm.uploadedfile.disabled = false;
        }
    }
  
    function ConfirmationMsg() {
    
			  alert("File has been updated.");
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
<title>File Upload</title>
<?php
  include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          FileTitle
        , FileDesc
        , Filename
        FROM 
          Downloadables
        WHERE 
          FileID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
 
  $Title = $row[0];
  $Description = br2space($row[1]);
  $File = $row[2];
  
  if ($process == "Update") {
  
    echo "<form enctype='multipart/form-data' id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_downloads.php'>";
    echo "<div class='DialogForm'>";
    echo "<h4>Update File Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>File Title:<span></td>";
    echo "<td class='v-field'><input type='text' id='txtFName' name='txtFName' class='DialogEntry' value='$Title'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Description:<span></td>";
    echo "<td class='v-field'><textarea id='txtFDesc' name='txtFDesc' class='DialogEntry' style='width:250px;'/>$Description</textarea></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td>";
    echo "<input type='checkbox' id='chkUploadFile' name='chkUploadFile' onclick='ChangeFile();'/>";
    echo "<span style='position: relative; top: -2px; right: -6px;'>Check to change document file</span>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>File Upload:<span></td>";
    echo "<td class='v-field'><input id='uploadedfile' name='uploadedfile' type='file' disabled='true'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='label-fields'></td>";
    echo "<td style='color: red;'>";    
    echo "<em>(Only accept .doc, .docx, .xls, xlsx, and .pdf files) - File must not increase in 2MB of file size.</em>";        
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='label-fields'></td>";
    echo "<td><input type='hidden' name='MAX_FILE_SIZE' value='30000000'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td><input type='hidden' id='txtUpdateDocFile' name='txtUpdateDocFile' value='$File'/></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";
    echo "<div class='DialogFormClose'>";
    echo "<a onclick=\"SubmitForm();\" alt='Update Entry'>Update Entry</a> | ";
    echo "<a onclick=\"ClosePopUp();\" alt='Close'>Close Window</a>";
    echo "</div>";
    echo "<input type='hidden' id='NewFile' name='NewFile' value='0'/>";
    echo "<input type='hidden' id='Process' name='Process' value='Update'/>";
    echo "<input type='hidden' id='EntryID' name='EntryID' value='$tempID'/>";
    echo "</form>";      
  }  
?>