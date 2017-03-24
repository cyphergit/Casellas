<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=promos';
            
            location.href = url;
            
        }

        function validateForm(cypherPromoForm) {
            
            var typeFile = /.jpg|.gif|.png/;
            var strFile = document.cypherPromoForm.uploadedfile.value;
            var typeFileMatch = strFile.search(typeFile);
            
            if (document.cypherPromoForm.txtPName.value == "") {
                alert("Please provide a value for the Promo name!");
                document.cypherPromoForm.txtPName.focus();
                return false;
            }
                       
            //if (document.cypherPromoForm.txtPDesc.value == "") {
            //    alert("Please provide a short description for the Promo!");
            //    document.cypherPromoForm.txtPDesc.focus();
            //    return false;
            //}
            
            if (strFile == "") {
                alert("Please select a .jpg, .png, or .gif file to upload.");
                document.cypherPromoForm.uploadedfile.focus();
                return false;
            }

            if (typeFileMatch == -1) {
                alert("Please select a .jpg, .png, or .gif file to upload.");
                document.cypherPromoForm.uploadedfile.focus();
                return false;
            }
            
            if (document.cypherPromoForm.selLinkStat.value == "0") {
                alert("Please select a status to activate or deactivate your promo banner!");
                document.cypherPromoForm.selLinkStat.focus();
                return false;
            }
            
            return true;
        }
        
</script>
<form enctype="multipart/form-data" id="cypherPromoForm" name="cypherPromoForm" method="POST" action="common/q_promos.php" onsubmit="return validateForm(this);">
  <p>
    Please fill-up the required fields (<span style="color: red;">*</span>) below.
  </p>
  <table>
    <tr>
      <td class="label-fields"><label>Promo Name:</label></td>
      <td>
        <input type="text" id="txtPName" name="txtPName" class="cypher-FormField"/>
        <span class="requiredField">*</span>
      </td>
    </tr>
    <tr>
      <td class="label-fields"><label>Description:</label></td>
      <td>
        <textarea id="txtPDesc" name="txtPDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
        <!--<span class="requiredField">*</span>-->
      </td>
    </tr>
    <tr>      
      <td class='label-fields'>Banner upload:</td>
      <td>
        <input id='uploadedfile' name='uploadedfile' type='file'/>
        <span class="requiredField">*</span>
      </td>
    </tr>
    <tr>      
      <td class='label-fields'></td>
      <td style='color: red;'>
        <em>
          (Only accept .jpg, .png, .gif files) - Image size must be 350 in width and 235 in height 
          <br/>and must not increase in 2MB of file size.
        </em>
      </td>      
    </tr>
    <tr>
      <td class="label-fields"><label>Banner status:</label></td>
      <td>
        <select id="selLinkStat" name="selLinkStat" class="cypher-FormField" style="padding: 0px 0px 0px 0px">
          <option value="0" selected="yes">Select Banner Status</option>
          <option value="1">Active</option>
          <option value="2">Inactive</option>          
        </select>
        <span class="requiredField">*</span>
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