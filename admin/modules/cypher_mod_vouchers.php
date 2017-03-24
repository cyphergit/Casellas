<script type="text/javascript">
        function validateForm(cypherVoucherForm) {
            
            var typeFile = /.jpg|.gif|.png/;
            var strFile = $('#uploadedfile').val();
            var uploadConfirmation = $('txtUploadFile').val();
            var typeFileMatch = strFile.search(typeFile);

            if ($('#selVOccasion').val() == "Select an Occasion") {
                alert("Please select an Occasion!");
                $('#selVOccasion').focus();
                return false;
            } 

            if ($('#txtVName').val() == "") {
                alert("Please provide a value for Voucher Name!");
                $('#txtVName').focus();
                return false;
            }

            if ($('#txtVOrientation').val() == "") {
                alert("Please provide a value for Template Orientation!");
                $('#txtVOrientation').focus();
                return false;
            }
            
            if ($('#txtVCAlignment').val() == "") {
                alert("Please provide a value for Template Content Alignment!");
                $('#txtVCAlignment').focus();
                return false;
            }
            
            if (uploadConfirmation == "1") {
                if (strFile == "") {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    $('#uploadedfile').focus();
                    return false;
                }

                if (typeFileMatch == -1) {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    $('#uploadedfile').focus();
                    return false;
                }
            }
            
            return true;
        }
        
        function uploadTemplate() {
          var c = document.cypherVoucherForm.chkUploadFile;
          var confirmation = document.cypherVoucherForm.txtUploadFile;
          var fileUpload = document.cypherVoucherForm.uploadedfile;
          
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

$q = "SELECT * FROM Vouchers WHERE VoucherTemplateID = '$recID'";
$rs = mysql_query($q);
$row = mysql_fetch_array($rs);

$vID = $row[VoucherTemplateID];
$vOccasion = $row[Occasion];
$vName = stripslashes($row[VoucherName]);
$vContent = stripslashes($row[VoucherContent]);
$vAlignment = stripslashes($row[VoucherContentAlignment]);
$vOrientation = stripslashes($row[TemplateOrientation]);
  
$image = $row[TemplateFile];
$location = $row[TemplateLocation];
$thumblocation = $row[TemplateThumbLoc];

if ($image == null || $image == "") {
  $image = "no-image.jpg";
  $source = "../images/voucher/no-image.jpg";
  $thumbsource = "../images/voucher/no-image.jpg";
  
} else {
  $source = "../$location/$image";
  $thumbsource = "../$thumblocation/$image";
} 

if ($p == 'c') {
?>
<div class="dataForm-wrapper">
<div class="dataForm">
  <fieldset>
    <legend>New</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherVoucherForm" name="cypherVoucherForm" method="POST" action="common/q_voucher.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Occasion:</label>
            </td>
            <td>
              <select id="selVOccasion" name="selVOccasion" class="cypher-FormField" style="padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select an Occasion">Select an Occasion</option>
                <option value="Anniversary">Anniversary</option>
                <option value="Birthday">Birthday</option>
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Voucher Name:</label>
            </td>
            <td>
              <input type="text" id="txtVName" name="txtVName" class="cypher-FormField"/>
              <span class="requiredField">*</span>
            </td>
          </tr>          
          <tr>
            <td class="label-fields">
              <label>Content:</label>
            </td>
            <td>
              <textarea id="txtVContent" name="txtVContent" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
              <!--<span class="requiredField">*</span>-->
            </td>
          </tr>
          <!--<tr>
            <td class="label-fields">
              <label>Content Color:</label>
            </td>
            <td>
              <input type="text" id="txtVContentColor" name="txtVContentColor" value="#000000" class="cypher-FormField"/>
              --><!--<span class="requiredField">*</span>--><!--
            </td>
          </tr>-->
          <tr>
            <td class="label-fields">
              <label>Set Template Orientation:</label>
            </td>
            <td>
              <span class="item-field temp-content-label">
                Please select a Template Orientation:
                <span class="requiredField">*</span>
              </span>              
              <ul class="template-orientation">                
                <li>
                  <input type="radio" name="rdbOrientation" id="rdbOrientVertical" value="Portrait"/>
                  <img src="../images/o-portrait.png" alt="landscape" class="icon-vertical"/>
                  <span class="item-field">Portrait (Vertical)</span>
                </li>
                <li>
                  <input type="radio" name="rdbOrientation" id="rdbOrientHorizontal" value="Landscape"/>
                  <img src="../images/o-landscape.png" alt="landscape" class="icon-horizontal"/>
                  <span class="item-field">Landscape (Horizontal)</span>
                </li>
              </ul>
              <input type="hidden" id="txtVOrientation" name="txtVOrientation"/>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Template Content Alignment:</label>
            </td>
            <td>
              <span class="item-field temp-content-label">
                Please select one for Content Alignment:
                <span class="requiredField">*</span>
              </span>
              <br/>
              <span class="item-field temp-content-label">
                <em>(Content Alignment will be based in the selected Template Orientation)</em>
              </span>
              <ul class="content-alignment">
                <li>
                  <input type="radio" name="rdbCAlignment"  id="rdbCAlignLeft" value="Left"/>
                  <span class="item-field" id="rdbLabelLeft">Left Align</span>
                </li>
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignTop" value="Top"/>
                  <span class="item-field" id="rdbLabelTop">Top Align</span>
                </li>
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignMiddle" value="Middle"/>
                  <span class="item-field" id="rdbLabelMiddle">Middle Align</span>
                </li>
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignRight" value="Right"/>
                  <span class="item-field" id="rdbLabelRight">Right Align</span>
                </li>
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignBottom" value="Bottom"/>
                  <span class="item-field" id="rdbLabelBottom">Bottom Align</span>
                </li>
              </ul>
              <input type="hidden" id="txtVCAlignment" name="txtVCAlignment"/>
            </td>
          </tr>          
          <tr>
            <td class='label-fields'>Voucher Template:</td>
            <td>
              <div>
                <input type='checkbox' id='chkUploadFile' name='chkUploadFile' onclick='uploadTemplate();'></input>
                <span class='item-field checkbox-label'>
                  Please check the box to upload an image.
                  <span class="requiredField">*</span>
                </span>                
                <input type='hidden' id='txtUploadfile' name='txtUploadFile' value='0'></input>
              </div>
              <div>
                <input id='uploadedfile' name='uploadedfile' type='file' disabled='true'/>
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
          <input id="cypher-Submit" type="Submit" value="Save" class="module-buttons"/>
          <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "voucher", "Cancel");?>
          <input id="reset" type="reset" value="Reset" class="module-buttons"/>
        </div>
      </form>
    </div>
  </fieldset>
</div>
</div>
<?php
} elseif ($p == 'u') {
?>
<div class="dataForm-wrapper">
<div class="dataForm">
  <fieldset>
    <legend>Update</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherVoucherForm" name="cypherVoucherForm" method="POST" action="common/q_voucher.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Occasion:</label>              
            </td>
            <td>              
              <select id="selVOccasion" name="selVOccasion" class="cypher-FormField" style="padding: 2px 2px 2px 2px; width: 260px;">
                <option value='Select an Occasion'>Select an Occasion</option>
                <?php
                  if ($vOccasion == 'Birthday') {
                    echo "<option value='Birthday' selected='yes'>Birthday</option>";
                    echo "<option value='Anniversary'>Anniversary</option>";
                    
                  } else if ($vOccasion = 'Anniversary') {
                    echo "<option value='Birthday' >Birthday</option>";
                    echo "<option value='Anniversary' selected='yes'>Anniversary</option>";
                  
                  } else {}               
                ?>                
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Voucher Name:</label>
            </td>
            <td>
              <input type="text" id="txtVName" name="txtVName" class="cypher-FormField" value="<?php echo $vName;?>"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Content:</label>
            </td>
            <td>
              <textarea id="txtVContent" name="txtVContent" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;">
                <?php echo $vContent;?>
              </textarea>
              <!--<span class="requiredField">*</span>-->
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Set Template Orientation:</label>
            </td>
            <td>
              <span class="item-field temp-content-label">
                Please select a Template Orientation:
                <span class="requiredField">*</span>
              </span>
              <ul class="template-orientation">
                <li>
                  <input type="radio" name="rdbOrientation" id="rdbOrientVertical" value="Portrait"/>
                  <img src="../images/o-portrait.png" alt="landscape" class="icon-vertical"/>
                  <span class="item-field">Portrait (Vertical)</span>
                </li>
                <li>
                  <input type="radio" name="rdbOrientation" id="rdbOrientHorizontal" value="Landscape"/>
                  <img src="../images/o-landscape.png" alt="landscape" class="icon-horizontal"/>
                  <span class="item-field">Landscape (Horizontal)</span>
                </li>
              </ul>
              <input type="hidden" id="txtVOrientation" name="txtVOrientation" value="<?php echo $vOrientation;?>"/>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Template Content Alignment:</label>
            </td>
            <td>
              <span class="item-field temp-content-label">
                Please select one for Content Alignment:
                <span class="requiredField">*</span>
              </span>
              <br/>
              <span class="item-field temp-content-label">
                <em>(Content Alignment will be based in the selected Template Orientation)</em>
              </span>
              <ul class="content-alignment">
                <li>
                  <input type="radio" name="rdbCAlignment"  id="rdbCAlignLeft" value="Left"/>
                  <span class="item-field" id="rdbLabelLeft">Left Align</span>
                </li>
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignTop" value="Top"/>
                  <span class="item-field" id="rdbLabelTop">Top Align</span>
                </li>                
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignMiddle" value="Middle"/>
                  <span class="item-field" id="rdbLabelMiddle">Middle Align</span>
                </li>
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignRight" value="Right"/>
                  <span class="item-field" id="rdbLabelRight">Right Align</span>
                </li>
                <li>
                  <input type="radio" name="rdbCAlignment" id="rdbCAlignBottom" value="Bottom"/>
                  <span class="item-field" id="rdbLabelBottom">Bottom Align</span>
                </li>                
              </ul>
              <input type="hidden" id="txtVCAlignment" name="txtVCAlignment" value="<?php echo $vAlignment;?>"/>
            </td>
          </tr>
          <tr>
            <td class='label-fields' style='padding-top: 10px;'>Voucher Template:</td>
            <td style='padding-top: 10px;'>
              <div>
                <input type='checkbox' id='chkUploadFile' name='chkUploadFile' onclick='uploadTemplate();'></input>
                <span class='item-field checkbox-label'>
                  Please check the box to upload an image.
                  <span class="requiredField">*</span>
                </span>
                <input type='hidden' id='txtUploadfile' name='txtUploadFile' value='0'></input>
                <input type='hidden' id='txtUpdateImgFile' name='txtUpdateImgFile' value="<?php echo $image;?>"></input>
              </div>
              <div>
                <input id='uploadedfile' name='uploadedfile' type='file' disabled='true'/>                
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
          <tr>
            <td class='label-fields'>Template Preview:</td>
            <td>
              <div class='template-preview'>
                <img src="<?php echo $thumbsource;?>" alt="<?php echo $image;?>"/>
              </div>
            </td>
          </tr>
        </table>
        <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $vID;?>"/>
        <input type="hidden" id="Process" name="Process" value="Update"/>
        <div class="form_buttons">
          <input id="cypher-Submit" type="Submit" value="Update" class="module-buttons"/>
          <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "voucher", "Cancel");?>
          <input id="reset" type="reset" value="Reset" class="module-buttons"/>
        </div>
      </form>
    </div>
  </fieldset>
</div>
</div>
<?php 
} elseif ($p == 'v') {
?>
<div class="dataForm-wrapper">
<div class="dataForm">
  <fieldset>
    <legend>View</legend>
    <div id="crudForm">
      <form id="cypherVoucherForm" name="cypherVoucherForm">
        <table>
          <tr>
            <td class="label-fields">
              <label>Occasion:</label>
            </td>
            <td class="item-field">
              <?php echo $vOccasion;?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Voucher Name:</label>
            </td>
            <td class="item-field">
              <?php echo $vName;?>  
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Content:</label>
            </td>
            <td class="item-field">
              <?php echo $vContent?>
            </td>
          </tr>
          <tr>
            <td class="label-fields" style="padding-top: 10px;">Template Preview:</td>
            <td style="padding-top: 10px;">              
              <div class="template-preview">
                <a href="#template-preview-wrapper" class="template-preview-link">
                  <img src="<?php echo $thumbsource;?>" alt="<?php echo $image;?>"/>
                </a>
              </div>
              <div id="template-preview-container">
                <div id="template-preview-wrapper">
                  <?php include('includes/cypher_vouchers_preview.php');?>
                </div>
              </div>
            </td>
          </tr>
        </table>        
        <div class="form_buttons">
            <?php moduleUpdate("../admin/index.php?pg=", "", "module-buttons", "", "voucher", "Edit", $recID);?> | 
            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "voucher", "Back");?>
        </div>
      </form>
    </div>
  </fieldset>
</div>
</div>
<?php }?>