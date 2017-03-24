<script type="text/javascript">
        function validateForm(cypherNewsletterImgForm) {
            
            var typeFile = /.jpg|.gif|.png/;
            var strFile = document.cypherNewsletterImgForm.uploadedfile.value;
            var typeFileMatch = strFile.search(typeFile);
            
            if (strFile == "") {
                alert("Please select a .jpg, .png, or .gif file to upload.");
                document.cypherNewsletterImgForm.uploadedfile.focus();
                return false;
            }

            if (typeFileMatch == -1) {
                alert("Please select a .jpg, .png, or .gif file to upload.");
                document.cypherNewsletterImgForm.uploadedfile.focus();
                return false;
            }
            
            return true;
        }
        
</script>
<form enctype="multipart/form-data" id="cypherNewsletterImgForm" name="cypherNewsletterImgForm" method="POST" action="common/q_newsletterimage.php" onsubmit="return validateForm(this);">
  <p>
    Please fill-up the required fields (<span style="color: red;">*</span>) below.
  </p>
  <table>
    <tr>      
      <td class='label-fields'>Image Upload:</td>
      <td>
        <input id='uploadedfile' name='uploadedfile' type='file'/>
        <span class="requiredField">*</span>
      </td>
    </tr>
    <tr>      
      <td class='label-fields'></td>
      <td style='color: red;'>
        <em>
          (Only accept .jpg, .png, .gif files) - Image size must not increase in 2MB of file size.
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
    <input id="cypher-Submit" type="Submit" value="Upload" class="module-buttons"/>
    <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "newsletter", "Cancel");?>
    <input id="reset" type="reset" value="Reset" class="module-buttons"/>
  </div>
</form>