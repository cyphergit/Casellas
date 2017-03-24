<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=brand';
            
            location.href = url;
            
        }

        function validateForm(cypherBrandForm) {
            
            var typeFile = /.jpg|.gif|.png/;
            var strFile = document.cypherBrandForm.brandLogo.value;
            var uploadConfirmation = document.cypherBrandForm.txtLogoUpdate.value;
            var typeFileMatch = strFile.search(typeFile);

            if (document.cypherBrandForm.txtBCode.value == "") {
                alert("Please provide value for Brand Code!");
                document.cypherBrandForm.txtBCode.focus();
                return false;
            }
            else {
                var x = document.cypherBrandForm.txtBCode.value
                var char_length = 3
                if (x.length != char_length) {
                    alert("Brand code must be maximum of 3 characters!");
                    document.cypherBrandForm.txtBCode.focus();
                    return false;
                }
            }
            
            if (document.cypherBrandForm.txtBName.value == "") {
                alert("Please provide a value for the Brand name!");
                document.cypherBrandForm.txtBName.focus();
                return false;
            }
            
            if (uploadConfirmation == "1") {
                if (strFile == "") {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    document.cypherBrandForm.brandLogo.focus();
                    return false;
                }

                if (typeFileMatch == -1) {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    document.cypherBrandForm.brandLogo.focus();
                    return false;
                }
            }

            return true;
        }
        
        function uploadLogo() {
            var c = document.cypherBrandForm.chkLogoUpdate;
            var confirmation = document.cypherBrandForm.txtLogoUpdate;
            var fileUpload = document.cypherBrandForm.brandLogo;
          
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
    <legend>New Brand</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherBrandForm" name="cypherBrandForm" method="POST" action="common/q_brand.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Brand Code:</label>
            </td>
            <td>
              <input type="text" id="txtBCode" name="txtBCode" class="cypher-FormField"/>
              <span class="requiredField">*</span>
              <span style="color: #222;">(eg. ABC)</span>
            </td>
          </tr>
          <tr>
            <tr>
              <td class="label-fields">
                <label>Brand Name:</label>
              </td>
              <td>
                <input type="text" id="txtBName" name="txtBName" class="cypher-FormField"/>
                <span class="requiredField">*</span>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Description:</label>
              </td>
              <td>
                <textarea id="txtBDesc" name="txtBDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
                <!--<span class="requiredField">*</span>-->
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Brand Website:</label>
              </td>
              <td>
                <input type="text" id="txtBWebsite" name="txtBWebsite" class="cypher-FormField"/>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Side Link Text:</label>
              </td>
              <td>
                <input type="text" id="txtBSideLinkText" name="txtBSideLinkText" class="cypher-FormField"/>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Side Link URL:</label>
              </td>
              <td>
                <input type="text" id="txtBSideLinkURL" name="txtBSideLinkURL" class="cypher-FormField"/>
              </td>
            </tr>            
            <tr>
              <td class='label-fields'>Brand Logo:</td>
              <td>
                <div>
                  <input type='checkbox' id='chkLogoUpdate' name='chkLogoUpdate' onclick='uploadLogo();'></input>
                  <span>Please check the box to upload a Logo.</span>
                  <input type='hidden' id='txtLogoUpdate' name='txtLogoUpdate' value='0'></input>
                </div>
                <div>
                  <input id='brandLogo' name='brandLogo' type='file' disabled='true'/>
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
  $q = "SELECT * FROM Brand WHERE BrandID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
  
  $logo = $row[BrandLogo];
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
    <legend>Update Brand</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherBrandForm" name="cypherBrandForm" method="POST" action="common/q_brand.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Current Brand Logo:</label>
            </td>
            <td>
              <img src="<?php echo $source;?>" alt="<?php echo $logo;?>" style="border: solid 1px #ccc; padding: 2px;"></img>              
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Brand Code:</label>
            </td>
            <td>
              <input type="text" id="lblBCode" name="lblCode" class="cypher-FormField" disabled="true" value="<?php echo $row['BrandCode'];?>"/>
              <input type="hidden" id="txtBCode" name="txtBCode" class="cypher-FormField" value="<?php echo $row['BrandCode'];?>"/>
              <span style="color: #222;">(eg. ABC)</span>
            </td>
          </tr>
          <tr>
            <tr>
              <td class="label-fields">
                <label>Brand Name:</label>
              </td>
              <td>
                <input type="text" id="txtBName" name="txtBName" class="cypher-FormField" value="<?php echo $row['BrandName'];?>"/>
                <span class="requiredField">*</span>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Description:</label>
              </td>
              <td>
                <textarea id="txtBDesc" name="txtBDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;">
                  <?php echo stripslashes($row['Description']);?>
                </textarea>                
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Brand Website:</label>
              </td>
              <td>
                <input type="text" id="txtBWebsite" name="txtBWebsite" class="cypher-FormField" value="<?php echo $row['BrandWebsite'];?>"/>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Side Link Text:</label>
              </td>
              <td>
                <input type="text" id="txtBSideLinkText" name="txtBSideLinkText" class="cypher-FormField" value="<?php echo $row['SideLinkText'];?>"/>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Side Link URL:</label>
              </td>
              <td>
                <input type="text" id="txtBSideLinkURL" name="txtBSideLinkURL" class="cypher-FormField" value="<?php echo $row['SideLinkURL'];?>"/>
              </td>
            </tr>
            <tr>
              <td class='label-fields'>Brand Logo:</td>
              <td>
                <div>
                  <input type='checkbox' id='chkLogoUpdate' name='chkLogoUpdate' onclick='uploadLogo();'></input>
                  <span>Please check the box to upload a Logo.</span>
                  <input type='hidden' id='txtLogoUpdate' name='txtLogoUpdate' value='0'></input>
                </div>
                <div>
                  <input id='brandLogo' name='brandLogo' type='file' disabled='true'/>
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
        <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $row['BrandID']?>"/>
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
  $q = "SELECT * FROM Brand WHERE BrandID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
  
  $logo = $row[BrandLogo];
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
    <legend>View Brand</legend>
    <div id="crudForm">
      <form id="cypherBrandForm" name="cypherBrandForm">
        <table>
          <tr>
            <td class="label-fields">
              <label>Brand Logo:</label>
            </td>
            <td>
              <img src="<?php echo $source;?>" alt="<?php echo $logo;?>" style="border: solid 1px #ccc; padding: 2px;"></img>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Brand Code:</label>
            </td>
            <td>
              <?php echo $row['BrandCode'];?>
            </td>
          </tr>
          <tr>
            <tr>
              <td class="label-fields">
                <label>Brand Name:</label>
              </td>
              <td>
                <?php echo $row['BrandName'];?>
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
                <label>Brand Website:</label>
              </td>
              <td>
                <?php echo $row['BrandWebsite'];?>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Side Link Text:</label>
              </td>
              <td>
                <?php echo $row['SideLinkText'];?>
              </td>
            </tr>
            <tr>
              <td class="label-fields">
                <label>Side Link URL:</label>
              </td>
              <td>
                <?php echo $row['SideLinkURL'];?>
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