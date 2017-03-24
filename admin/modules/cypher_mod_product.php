<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=products';
            
            location.href = url;
            
        }

        function validateForm(cypherProductForm) {
            
            var typeFile = /.jpg|.gif|.png/;
            var strFile = document.cypherProductForm.uploadedfile.value;
            var uploadConfirmation = document.cypherProductForm.txtUploadFile.value;
            var typeFileMatch = strFile.search(typeFile);
            
            if (document.cypherProductForm.txtPName.value == "") {
                alert("Please provide a value for Product Name!");
                document.cypherProductForm.txtPName.focus();
                return false;
            }
            
            if (document.cypherProductForm.selPBrand.value == "Select a Brand") {
                alert("Please select a Brand for the Product!");
                document.cypherProductForm.selPBrand.focus();
                return false;
            }                       

            //if (document.cypherProductForm.txtPDesc.value == "") {
            //    alert("Please provide a Description for the Product!");
            //    document.cypherProductForm.selPBrand.focus();
            //    return false;
            //}
            
            if (document.cypherProductForm.selPCategory.value == "Select a Category") {
                alert("Please select a Category for the Product!");
                document.cypherProductForm.selPCategory.focus();
                return false;
            }
            
            if (document.cypherProductForm.selPSubcategory.value == "Select a Subcategory") {
                alert("Please select a Subcategory for the Product!");
                document.cypherProductForm.selPSubcategory.focus();
                return false;
            }
                        
            //if (document.cypherProductForm.txtPQuantity.value == "0") {
            //    alert("Please provide a Quantity for the product not less than 0!");
            //    document.cypherProductForm.txtPQuantity.focus();
            //    return false;
            //}
            
            if (document.cypherProductForm.txtPPrice.value == "0") {
                alert("Please provide a Price for the Product!");
                document.cypherProductForm.txtPPrice.focus();
                return false;
            }
            
            if (uploadConfirmation == "1") {
                if (strFile == "") {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    document.cypherProductForm.uploadedfile.focus();
                    return false;
                }

                if (typeFileMatch == -1) {
                    alert("Please select a .jpg, .png, or .gif file to upload.");
                    document.cypherProductForm.uploadedfile.focus();
                    return false;
                }
            }
            
            return true;
        }
        
        function uploadLogo() {
          var c = document.cypherProductForm.chkUploadFile;
          var confirmation = document.cypherProductForm.txtUploadFile;
          var fileUpload = document.cypherProductForm.uploadedfile;
          
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
    <legend>New Product</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherProductForm" name="cypherProductForm" method="POST" action="common/q_products.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Product Name:</label>
            </td>
            <td>
              <input type="text" id="txtPName" name="txtPName" class="cypher-FormField"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Brand:</label>
            </td>
            <td>
              <!--<input type="text" id="txtPBrand" name="txtPBrand" class="cypher-FormField"/>-->
              <select id="selPBrand" name="selPBrand" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select a Brand">Select a Brand</option>
                <?php
              $b_sql = "SELECT BrandID, BrandName FROM Brand WHERE Status = '1' ORDER BY BrandName ASC";
              
              $b_num_rows = mysql_num_rows($b_sql);
        
              $b_rs = mysql_query($b_sql);
        
              while($b_row = mysql_fetch_array($b_rs))
		          { 		    
                echo "<option value='$b_row[0]'>$b_row[1]</option>";				        
			        }
          ?>
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <textarea id="txtPDesc" name="txtPDesc" col="10" style="height: 150px; width: 500px; font-family: Arial;"></textarea>
              <!--<span class="requiredField">*</span>-->
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Category:</label>
            </td>
            <td>
              <!--<input type="text" id="txtPCategory" name="txtPCategory" class="cypher-FormField"/>-->
              <select id="selPCategory" name="selPCategory" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select a Category">Select a Category</option>
                <?php
                    $sql = "SELECT CategoryID, CategoryName FROM Product_Category WHERE Status = '1' ORDER BY CategoryID ASC";
              
                    $num_rows = mysql_num_rows($sql);
        
                    $rs = mysql_query($sql);
        
                    while($row = mysql_fetch_array($rs))
		                { 		    
                      echo "<option value='$row[0]'>$row[1]</option>";				        
			              }
                ?>
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Subcategory:</label>
            </td>
            <td>
              <!--<input type="text" id="txtPSubcategory" name="txtPSubcategory" class="cypher-FormField"/>-->
              <select id="selPSubcategory" name="selPSubcategory" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select a Subcategory">Select a Subcategory</option>
                <?php
                    $sub_sql = "SELECT SubcategoryID, SubcategoryName FROM Product_Subcategory WHERE Status = '1' ORDER BY SubcategoryID ASC";
              
                    $sub_num_rows = mysql_num_rows($sub_sql);
        
                    $sub_rs = mysql_query($sub_sql);
        
                    while($sub_row = mysql_fetch_array($sub_rs))
		                { 		    
                      echo "<option value='$sub_row[0]'>$sub_row[1]</option>";				        
			              }
                ?>
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Quantity:</label>
            </td>
            <td>
              <input type="text" id="txtPQuantity" name="txtPQuantity" class="cypher-FormField" value="0"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Unit:</label>
            </td>
            <td>
              <input type="text" id="txtPUOM" name="txtPUOM" class="cypher-FormField" value="0"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Price:</label>
            </td>
            <td>
              <input type="text" id="txtPPrice" name="txtPPrice" class="cypher-FormField" value="0"/>
              <span class="requiredField">*</span>
              <span>(eg. xxx.xx)</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Discount (%):</label>
            </td>
            <td>
              <input type="text" id="txtPDiscount" name="txtPDiscount" class="cypher-FormField" value="0"/>
              <label style="padding-left: 8px;">(eg. xx)</label>
            </td>
          </tr>
          <tr>
            <td class='label-fields'>Product Image:</td>
            <td>
              <div>
                <input type='checkbox' id='chkUploadFile' name='chkUploadFile' onclick='uploadLogo();'></input>
                <span>Please check the box to upload an image.</span>
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
  $q = "SELECT * FROM Product WHERE md5(ProductID) = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
  
  $image = $row[ProductImage];
  $location = $row[FileLocation];
  
  if ($image == null || $image == "") {
    $image = "no-image.jpg";
    $source = "../images/no-image.jpg";
  } else {
    $source = "../$location/$image";
  } 
?>
<div class="dataForm">
  <fieldset>
    <legend>Update Product</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherProductForm" name="cypherProductForm" method="POST" action="common/q_products.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Current Product Image:</label>
            </td>
            <td>
              <img src="<?php echo $source;?>" alt="<?php echo $image;?>" class="cypher-product-img"></img>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Product Name:</label>
            </td>
            <td>
              <input type="text" id="txtPName" name="txtPName" class="cypher-FormField" value="<?php echo $row['ProductName'];?>"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Brand:</label>
            </td>
            <td>
              <!--<input type="text" id="txtPBrand" name="txtPBrand" class="cypher-FormField"/>-->
              <select id="selPBrand" name="selPBrand" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select a Brand">Select a Brand</option>
                <?php
                    $b_sql = "SELECT BrandID, BrandName FROM Brand WHERE Status = '1' ORDER BY BrandName ASC";
              
                    $b_num_rows = mysql_num_rows($b_sql);
        
                    $b_rs = mysql_query($b_sql);
        
                    while($b_row = mysql_fetch_array($b_rs))
		                { 		    
                      if ($b_row[0] == $row[1]) {
                        echo "<option value='$b_row[0]' selected='yes'>$b_row[1]</option>";
                      } else {
                        echo "<option value='$b_row[0]'>$b_row[1]</option>";
                      }                      
			              }
                ?>
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <textarea id="txtPDesc" name="txtPDesc" col="10" style="height: 150px; width: 500px; font-family: Arial;">
                <?php echo $row['Description'];?>
              </textarea>
              <!--<span class="requiredField">*</span>-->
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Category:</label>
            </td>
            <td>
              <!--<input type="text" id="txtPCategory" name="txtPCategory" class="cypher-FormField"/>-->
              <select id="selPCategory" name="selPCategory" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select a Category">Select a Category</option>
                <?php
                    $c_sql = "SELECT CategoryID, CategoryName FROM Product_Category WHERE Status = '1' ORDER BY CategoryID ASC";
              
                    $c_num_rows = mysql_num_rows($c_sql);
        
                    $c_rs = mysql_query($c_sql);
        
                    while($c_row = mysql_fetch_array($c_rs))
		                {
                      if ($c_row[0] == $row[6]) {
                        echo "<option value='$c_row[0]' selected='yes'>$c_row[1]</option>";
                      } else {
                        echo "<option value='$c_row[0]'>$c_row[1]</option>";
                      }                      
			              }
                ?>
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Subcategory:</label>
            </td>
            <td>
              <!--<input type="text" id="txtPSubcategory" name="txtPSubcategory" class="cypher-FormField"/>-->
              <select id="selPSubcategory" name="selPSubcategory" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select a Subcategory">Select a Subcategory</option>
                <?php
                    $sub_sql = "SELECT SubcategoryID, SubcategoryName FROM Product_Subcategory WHERE Status = '1' ORDER BY SubcategoryID ASC";
              
                    $sub_num_rows = mysql_num_rows($sub_sql);
        
                    $sub_rs = mysql_query($sub_sql);
        
                    while($sub_row = mysql_fetch_array($sub_rs))
		                {
                      if ($sub_row[0] == $row[7]) {
                        echo "<option value='$sub_row[0]' selected='yes'>$sub_row[1]</option>";
                      } else {
                        echo "<option value='$sub_row[0]'>$sub_row[1]</option>";
                      }                      
			              }
                ?>
              </select>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Quantity:</label>
            </td>
            <td>
              <input type="text" id="txtPQuantity" name="txtPQuantity" class="cypher-FormField" value="<?php echo $row['Quantity'];?>"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Unit:</label>
            </td>
            <td>
              <input type="text" id="txtPUOM" name="txtPUOM" class="cypher-FormField" value="0"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Price:</label>
            </td>
            <td>
              <input type="text" id="txtPPrice" name="txtPPrice" class="cypher-FormField" value="<?php echo $row['Price'];?>"/>
              <span class="requiredField">*</span>
              <span>(eg. xxx.xx)</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Discount (%):</label>
            </td>
            <td>
              <input type="text" id="txtPDiscount" name="txtPDiscount" class="cypher-FormField" value="<?php echo $row['Discount'];?>"/>
              <label style="padding-left: 8px;">(eg. xx)</label>
            </td>
          </tr>
          <tr>
            <td class='label-fields'>Product Image:</td>
            <td>
              <div>
                <input type='checkbox' id='chkUploadFile' name='chkUploadFile' onclick='uploadLogo();'></input>
                <span>Please check the box to upload an image.</span>
                <input type='hidden' id='txtUploadFile' name='txtUploadFile' value='0'></input>
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
        <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $row[ProductID]?>"/>
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
  $q = "SELECT * FROM Product WHERE md5(ProductID) = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
  
  $image = $row[ProductImage];
  $location = $row[FileLocation];
  
  if ($image == null || $image == "") {
    $image = "no-image.jpg";
    $source = "../images/no-image.jpg";
  } else {
    $source = "../$location/$image";
  }
?>
<div class="dataForm">
  <fieldset>
    <legend>View Product</legend>
    <div id="crudForm">
      <form enctype="multipart/form-data" id="cypherProductForm" name="cypherProductForm" method="POST" action="common/q_products.php" onsubmit="return validateForm(this);">
        <table>
          <tr>
            <td class="label-fields">
              <label>Product Image:</label>
            </td>
            <td>
              <img src="<?php echo $source;?>" alt="<?php echo $image;?>" class="cypher-product-img"></img>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Product Name:</label>
            </td>
            <td>
              <?php echo $row['ProductName']?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Brand:</label>
            </td>
            <td>
              <?php 
                $bid = $row['BrandID'];
                
                $b_q = "SELECT BrandName FROM Brand WHERE BrandID = '$bid'";
                $b_rs = mysql_query($b_q);
                $b_row = mysql_fetch_array($b_rs);
                
                echo $b_row[0];
              ?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <?php echo $row['Description']?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Category:</label>
            </td>
            <td>
              <?php              
                $cid = $row['CategoryID'];
                
                $c_q = "SELECT CategoryName FROM Product_Category WHERE CategoryID = '$cid'";
                $c_rs = mysql_query($c_q);
                $c_row = mysql_fetch_array($c_rs);
                
                echo $c_row[0];
              ?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Subcategory:</label>
            </td>
            <td>
              <?php 
                $sid = $row['SubCategoryID'];
              
                $s_q = "SELECT SubCategoryName FROM Product_Subcategory WHERE SubCategoryID = '$sid'";
                $s_rs = mysql_query($s_q);
                $s_row = mysql_fetch_array($s_rs);
                
                echo $s_row[0];
              ?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Quantity:</label>
            </td>
            <td>
              <?php echo $row['Quantity']?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Price:</label>
            </td>
            <td>
              <?php echo $row['Price']?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Discount (%):</label>
            </td>
            <td>
              <?php echo $row['Discount']?>
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
