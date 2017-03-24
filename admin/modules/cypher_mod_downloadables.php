<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=downloads';
            
            location.href = url;
            
        }

        function validateForm(cypherDownloadablesForm) {
            
            var typeFile = /.doc|.docx|.xls|.xlsx|.pdf/;
            var strFile = document.cypherDownloadablesForm.uploadedfile.value;
            var typeFileMatch = strFile.search(typeFile);

            if (document.cypherDownloadablesForm.txtFName.value == "") {
                alert("Please provide a value for the Document/File name!");
                document.cypherDownloadablesForm.txtFName.focus();
                return false;
            }
            
            //if (document.cypherDownloadablesForm.txtFDesc.value == "") {
            //    alert("Please provide a short description for the Document!");
            //    document.cypherDownloadablesForm.txtFDesc.focus();
            //    return false;
            //}
            
            if (strFile == "") {
                alert("Please select a .doc or .docx, .xls or .xlsx, or .pdf file to upload.");
                document.cypherDownloadablesForm.uploadedfile.focus();
                return false;
            }

            if (typeFileMatch == -1) {
                alert("Please select a .doc or .docx, .xls or .xlsx, or .pdf file to upload.");
                document.cypherDownloadablesForm.uploadedfile.focus();
                return false;
            }
            
            return true;
        }
        
</script>
<form enctype="multipart/form-data" id="cypherDownloadablesForm" name="cypherDownloadablesForm" method="POST" action="common/q_downloads.php" onsubmit="return validateForm(this);">
  <p>
    Please fill-up the required fields (<span style="color: red;">*</span>) below.
  </p>
  <table>
    <tr>
      <td class="label-fields"><label>Document/File Name:</label></td>
      <td>
        <input type="text" id="txtFName" name="txtFName" class="cypher-FormField"/>
        <span class="requiredField">*</span>
      </td>
    </tr>
    <tr>
      <td class="label-fields"><label>Description:</label></td>
      <td>
        <textarea id="txtFDesc" name="txtFDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
        <!--<span class="requiredField">*</span>-->
      </td>
    </tr>
    <tr>      
      <td class='label-fields'>File Upload:</td>
      <td>
        <input id='uploadedfile' name='uploadedfile' type='file'/>
        <span class="requiredField">*</span>
      </td>
    </tr>
    <tr>      
      <td class='label-fields'></td>
      <td style='color: red;'>
        <em>
          (Only accept .doc, .docx, .xls, xlsx, and .pdf files) - File must not increase in 2MB of file size.
        </em>
      </td>      
    </tr>
    <tr>      
      <td class='label-fields'></td>
      <td><input type="hidden" name="MAX_FILE_SIZE" value="30000000"/></td>
    </tr>
  </table>
  <input type="hidden" id="Process" name="Process" value="Add"/>
  <div class="form_buttons">
    <input id="cypher-Submit" type="Submit" value="Add"/>
    <input id="cypher-Cancel" type="button" value="Cancel" onclick="CancelSubmission();"/>
    <input id="reset" type="reset" value="Reset"/>
  </div>
</form>