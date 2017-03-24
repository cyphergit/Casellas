<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=link';
            
            location.href = url;
            
        }

        function validateForm(cypherLinkForm) {
            
            var typeFile = /.jpg|.gif|.png/;
            var strFile = document.cypherLinkForm.linkLogo.value;
            var uploadConfirmation = document.cypherLinkForm.txtLogoUpdate.value;
            var typeFileMatch = strFile.search(typeFile);

            if (document.cypherLinkForm.txtLCode.value == "") {
                alert("Please provide value for Link Code!");
                document.cypherLinkForm.txtLCode.focus();
                return false;
            }
            else {
                var x = document.cypherLinkForm.txtLCode.value
                var char_length = 3
                if (x.length < char_length) {
                    alert("Link code must be minimum of 3 characters!");
                    document.cypherLinkForm.txtLCode.focus();
                    return false;
                }
                
                if (x.length > 6) {
                    alert("Link code must not exceed of 6 characters!");
                    document.cypherLinkForm.txtLCode.focus();
                    return false;
                }  
            }
            
            if (document.cypherLinkForm.txtLName.value == "") {
                alert("Please provide a value for the Link name!");
                document.cypherLinkForm.txtLName.focus();
                return false;
            }
            
            if (uploadConfirmation == "1") {
                if (strFile == "") {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    document.cypherLinkForm.linkLogo.focus();
                    return false;
                }

                if (typeFileMatch == -1) {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    document.cypherLinkForm.linkLogo.focus();
                    return false;
                }
            }

            return true;
        }
        
        function uploadLogo() {
            var c = document.cypherLinkForm.chkLogoUpdate;
            var confirmation = document.cypherLinkForm.txtLogoUpdate;
            var fileUpload = document.cypherLinkForm.linkLogo;
          
            if (c.checked == true) {
              confirmation.value = "1";
              fileUpload.disabled = false;
            } else {
              confirmation.value = "0";
              fileUpload.disabled = true;
            }
        }
        
</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

if ($p == 'c') {
?>
<div class="dataForm">
  <fieldset>
    <legend>New Link</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherLinkForm" name="cypherLinkForm" method="POST" action="common/q_links.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Link Code:</label>
            </td>
            <td>
              <input type="text" id="txtLCode" name="txtLCode" class="cypher-FormField"/>
              <span class="requiredField">*</span>
              <span style="color: #222;">(eg. ABCD)</span>
            </td>
          </tr>
          <tr>
            <tr>
              <td class="label-fields">
                <label>Link Name:</label>
              </td>
              <td>
                <input type="text" id="txtLName" name="txtLName" class="cypher-FormField"/>
                <span class="requiredField">*</span>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Description:</label>
              </td>
              <td>
                <textarea id="txtLDesc" name="txtLDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
                <!--<span class="requiredField">*</span>-->
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Website:</label>
              </td>
              <td>
                <input type="text" id="txtLWebsite" name="txtLWebsite" class="cypher-FormField"/>
              </td>
            </tr>           
            <tr>
              <td class='label-fields'>Link Logo:</td>
              <td>
                <div>
                  <input type='checkbox' id='chkLogoUpdate' name='chkLogoUpdate' onclick='uploadLogo();'></input>
                  <span>Please check the box to upload a Logo.</span>
                  <input type='hidden' id='txtLogoUpdate' name='txtLogoUpdate' value='0'></input>
                </div>
                <div>
                  <input id='linkLogo' name='linkLogo' type='file' disabled='true'/>
                  <!--<span class="requiredField">*</span>-->  
                </div>                
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
              <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="30000000"/>
              </td>
            </tr>
          </table>
        <input type="hidden" id="Process" name="Process" value="Add"/>
        <div class="form_buttons">
          <input id="cypher-Submit" type="Submit" value="Save"/>
          <input id="cypher-Cancel" type="button" value="Cancel" onclick="CancelSubmission();"/>
          <input id="reset" type="reset" value="Reset"/>
        </div>
      </form>
    </div>
  </fieldset>
</div>
  <?php
} elseif ($p == 'u') {
  $q = "SELECT * FROM Link WHERE LinkID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
  
  $logo = $row[LinkLogo];
  $location = $row[LogoLocation];
  
  if ($logo == null || $logo == "") {
    $logo = "no-logo.jpg";
    $source = "../images/no-logo.jpg";
  } else {
    $source = "../$location/$logo";
  }  
?>
<div class="dataForm">
  <fieldset>
    <legend>Update Link</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherLinkForm" name="cypherLinkForm" method="POST" action="common/q_links.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Current Link Logo:</label>
            </td>
            <td>
              <img src="<?php echo $source;?>" alt="<?php echo $logo;?>" style="border: solid 1px #ccc; padding: 2px;"></img>              
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Link Code:</label>
            </td>
            <td>
              <input type="text" id="lblLCode" name="lblCode" class="cypher-FormField" disabled="true" value="<?php echo $row['LinkCode'];?>"/>
              <input type="hidden" id="txtLCode" name="txtLCode" class="cypher-FormField" value="<?php echo $row['LinkCode'];?>"/>
              <span style="color: #222;">(eg. ABC)</span>
            </td>
          </tr>
          <tr>
            <tr>
              <td class="label-fields">
                <label>Link Name:</label>
              </td>
              <td>
                <input type="text" id="txtLName" name="txtLName" class="cypher-FormField" value="<?php echo $row['LinkName'];?>"/>
                <span class="requiredField">*</span>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Description:</label>
              </td>
              <td>
                <textarea id="txtLDesc" name="txtLDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;">
                  <?php echo stripslashes($row['Description']);?>
                </textarea>                
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Website:</label>
              </td>
              <td>
                <input type="text" id="txtLWebsite" name="txtLWebsite" class="cypher-FormField" value="<?php echo $row['LinkURL'];?>"/>
              </td>
            </tr>
            <tr>
              <td class='label-fields'>Link Logo:</td>
              <td>
                <div>
                  <input type='checkbox' id='chkLogoUpdate' name='chkLogoUpdate' onclick='uploadLogo();'></input>
                  <span>Please check the box to upload a Logo.</span>
                  <input type='hidden' id='txtLogoUpdate' name='txtLogoUpdate' value='0'></input>
                </div>
                <div>
                  <input id='linkLogo' name='linkLogo' type='file' disabled='true'/>
                  <!--<span class="requiredField">*</span>-->
                </div>
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
              <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="30000000"/>
              </td>
            </tr>
          </table>
        <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $recID;?>"/>
        <input type="hidden" id="Process" name="Process" value="Update"/>
        <div class="form_buttons">
          <input id="cypher-Submit" type="Submit" value="Update"/>
          <input id="cypher-Cancel" type="button" value="Cancel" onclick="CancelSubmission();"/>
          <input id="reset" type="reset" value="Reset"/>
        </div>
      </form>
    </div>
  </fieldset>
</div>
  <?php 
} elseif ($p == 'v') {
  $q = "SELECT * FROM Link WHERE LinkID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
  
  $logo = $row[LinkLogo];
  $location = $row[LogoLocation];
  
  if ($logo == null || $logo == "") {
    $logo = "no-logo.jpg";
    $source = "../images/no-logo.jpg";
  } else {
    $source = "../$location/$logo";
  }
?>
<div class="dataForm">
  <fieldset>
    <legend>View Link</legend>
    <div id="crudForm">
      <form id="cypherLinkForm" name="cypherLinkForm">
        <table>
          <tr>
            <td class="label-fields">
              <label>Link Logo:</label>
            </td>
            <td>
              <img src="<?php echo $source;?>" alt="<?php echo $logo;?>" style="border: solid 1px #ccc; padding: 2px;"></img>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Link Code:</label>
            </td>
            <td>
              <?php echo $row['LinkCode'];?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Link Name:</label>
            </td>
            <td>
              <?php echo $row['LinkName'];?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <?php echo stripslashes($row['Description']);?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Website:</label>
            </td>
            <td>
              <?php echo $row['LinkURL'];?>
            </td>
          </tr>
        </table>
        <div class="form_buttons">          
          <input id="cypher-Cancel" type="button" value="Back" onclick="CancelSubmission();"/>          
        </div>
      </form>
    </div>
  </fieldset>
</div>
  <?php
} else {}
?>