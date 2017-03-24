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
    
    function ChangeFile() {
        if (document.UpdateForm.chkUploadFile.checked == false) {          
            document.UpdateForm.NewFile.value = "0";
            document.UpdateForm.uploadedfile.disabled = true;
        } else {
            document.UpdateForm.NewFile.value = "1";
            document.UpdateForm.uploadedfile.disabled = false;
        }
    }
  
    function validateForm(UpdateForm) {
        
        if (document.UpdateForm.txtPName.value == "") {
            alert("Please provide a value for the Product Name!");
            document.UpdateForm.txtPName.focus();
            return false;
        }
        
        if (document.UpdateForm.selPBrand.value == "Select a Brand") {
            alert("Please select a Brand for the Product!");
            document.UpdateForm.selPBrand.focus();
            return false;
        } 
        
        if (document.UpdateForm.txtPDesc.value == "") {
            alert("Please provide a short description for the Product!");
            document.UpdateForm.txtPDesc.focus();
            return false;
        }                        
        
        if (document.UpdateForm.selPCategory.value == "Select a Category") {
            alert("Please select a Category for the Product!");
            document.UpdateForm.selPCategory.focus();
            return false;
        }
            
        if (document.UpdateForm.selPSubcategory.value == "Select a Subcategory") {
            alert("Please select a Subcategory for the Product!");
            document.UpdateForm.selPSubcategory.focus();
            return false;
        }
                        
        //if (document.UpdateForm.txtPQuantity.value == "0") {
        //    alert("Please provide a Quantity for the product not less than 0!");
        //    document.UpdateForm.txtPQuantity.focus();
        //    return false;
        //}
            
        if (document.UpdateForm.txtPPrice.value == "0") {
            alert("Please provide a Price for the Product!");
            document.UpdateForm.txtPPrice.focus();
            return false;
        }
        
        if (document.UpdateForm.uploadedfile.disabled == false) {
            var typeFile = /.jpg|.gif|.png/;
            var strFile = document.UpdateForm.uploadedfile.value;
            var typeFileMatch = strFile.search(typeFile);
        
            if (strFile == "") {
                alert("Please select a .jpg, .png, or .gif file to upload.");
                document.UpdateForm.uploadedfile.focus();
                return false;
            }

            if (typeFileMatch == -1) {
                alert("Please select a .jpg, .png, or .gif file to upload.");
                document.UpdateForm.uploadedfile.focus();
                return false;
            }          
        }
        
        //return true;
        var details = $(".nicEdit-main").html();
        var eDesc = document.UpdateForm.txtPDesc;
        
        eDesc.value = details; 
        
        document.UpdateForm.submit();
        ConfirmationMsg();
    }
  
    function ConfirmationMsg() {
    
			  alert("Product has been updated.");
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
<title>Products</title>
<?php  
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          Product.ProductName
          , Brand.BrandName
          , Product.Description
          , Product_Category.CategoryName
          , Product_Subcategory.SubcategoryName
          , Product.Quantity
          , FORMAT(Product.Price,2)
          , Product.Discount
          , Product.ProductImage
          , Product.FileLocation
          , Product.BrandID
          , Product.CategoryID
          , Product.SubcategoryID
        FROM 
          Product
          , Brand
          , Product_Category
          , Product_Subcategory
        WHERE
          Product.CategoryID = Product_Category.CategoryID
        AND
          Product.SubcategoryID = Product_Subcategory.SubcategoryID
        AND
          Product.BrandID = Brand.BrandID
        AND
          Product.ProductID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
 
  $pName = $row[0];  
  $pBrand = $row[1];
  $vAContent = $row[2];
  $uAContent = $row[2];
  //$uAContent = br2space($row[2]);
  $pCategory = $row[3];
  $pSubcategory = $row[4];
  $pQuantity = $row[5];  
  $pPrice = $row[6];  
  $pDiscount = $row[7];
  
  $File = $row[8];
  
  $ImgFile = $row[8];
  $ImgLocation = $row[9];

  $bID = $row[10];
  $cID = $row[11];
  $scID = $row[12];  

  if ($process == "View") {
  
    echo "<div class='DialogForm'>";
	  echo "<h4>Product Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table style='width: 100%;'>";
    echo "<tr>";
    echo "<td valign='top' style='width: 200px;'>";
    echo "<div id='img-product'>";
    echo "<img src='$site_host/$ImgLocation/$ImgFile' alt='$ImgFile'/>";
    echo "</div>";
    echo "</td>";
    echo "<td valign='top' style='border: solid 1px #ccc; padding: 8px 4px 2px 4px; background-color: #f9f9f9;'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Product Name:</span></td>";
    echo "<td class='v-field'><em>$pName</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Brand:</span></td>";
    echo "<td class='v-field'><em>$pBrand</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Category:</span></td>";
    echo "<td class='v-field'><em>$pCategory</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Subcategory:</span></td>";
    echo "<td class='v-field'><em>$pSubcategory</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Quantity:</span></td>";
    echo "<td class='v-field'><em>$pQuantity</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Price:</span></td>";
    echo "<td class='v-field'><em>$pPrice</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Discount:</span></td>";
    echo "<td class='v-field'><em>$pDiscount</em></td>";    
	  echo "</tr>";
    echo "<tr>";
    echo "<td class='v-field'><span class='itemfield'>Description:</span></td>";
    echo "<td class='v-field'><em>$vAContent</em></td>";    
	  echo "</tr>";
    echo "</table>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";    
    echo "</div>";
    echo "</div>";
    echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";  
  
  } else {
  
    echo "<form enctype='multipart/form-data' id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_products.php'>";
    echo "<div class='DialogForm'>";
    echo "<h4>Update Product Details</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='itemfield'>Product Name:</td>";
    echo "<td><input type='text' id='txtPName' name='txtPName' class='DialogEntry' value='$pName'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Brand:</td>";
    echo "<td>";    
    echo "<select id='selPBrand' name='selPBrand' class='cypher-FormField' style='border: solid 1px #ccc; padding: 2px 2px 2px 2px; width: 250px;'>";
    echo "<option value='Select a Brand'>Select a Brand</option>";
    
        $b_sql = "SELECT BrandID, BrandName FROM Brand WHERE Status = '1' ORDER BY BrandID ASC";
              
        $b_num_rows = mysql_num_rows($b_sql);
        
        $b_rs = mysql_query($b_sql);
        
        while($b_row = mysql_fetch_array($b_rs))
        {
          if ($b_row[0] == $bID) {
            echo "<option selected='yes' value='$b_row[0]'>$b_row[1]</option>";
          } else {
            echo "<option value='$b_row[0]'>$b_row[1]</option>";            
          }
        }
    
    echo "</select>";    
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Category:</td>";
    echo "<td>";    
    echo "<select id='selPCategory' name='selPCategory' class='cypher-FormField' style='border: solid 1px #ccc; padding: 2px 2px 2px 2px; width: 250px;'>";
    echo "<option value='Select a Category'>Select a Category</option>";
    
        $c_sql = "SELECT CategoryID, CategoryName FROM Product_Category WHERE Status = '1' ORDER BY CategoryID DESC";
              
        $c_num_rows = mysql_num_rows($c_sql);
        
        $c_rs = mysql_query($c_sql);
        
        while($c_row = mysql_fetch_array($c_rs))
        {
          if ($c_row[0] == $cID) {
            echo "<option selected='yes' value='$c_row[0]'>$c_row[1]</option>";
          } else {
            echo "<option value='$c_row[0]'>$c_row[1]</option>";            
          }
        }
    
    echo "</select>";    
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Subcategory:</td>";
    echo "<td>";    
    echo "<select id='selPSubcategory' name='selPSubcategory' class='cypher-FormField' style='border: solid 1px #ccc; padding: 2px 2px 2px 2px; width: 250px;'>";
    echo "<option value='Select a Subcategory'>Select a Subcategory</option>";
    
        $sc_sql = "SELECT SubcategoryID, SubcategoryName FROM Product_Subcategory WHERE Status = '1' ORDER BY CategoryID DESC";
              
        $sc_num_rows = mysql_num_rows($sc_sql);
        
        $sc_rs = mysql_query($sc_sql);
        
        while($sc_row = mysql_fetch_array($sc_rs))
        {
          if ($sc_row[0] == $scID) {
            echo "<option selected='yes' value='$sc_row[0]'>$sc_row[1]</option>";
          } else {
            echo "<option value='$sc_row[0]'>$sc_row[1]</option>";            
          }
        }
    
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Quantity:</td>";
    echo "<td><input type='text' id='txtPQuantity' name='txtPQuantity' class='DialogEntry' value='$pQuantity'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Price:</td>";
    echo "<td>";
    echo "<input type='text' id='txtPPrice' name='txtPPrice' class='DialogEntry' value='$pPrice'/>";
    echo "<span>(eg. 1.50)</span>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Discount:</td>";
    echo "<td><input type='text' id='txtPDiscount' name='txtPDiscount' class='DialogEntry' value='$pDiscount'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Description:</td>";
    echo "<td><textarea id='txtPDesc' name='txtPDesc' style='width: 380px; border: solid 1px #ccc;'>$uAContent</textarea></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td>";
    echo "<input type='checkbox' id='chkUploadFile' name='chkUploadFile' onclick='ChangeFile();'/>";
    echo "<span style='position: relative; top: -2px; right: -6px; color: #222;'>Check to change image file</span>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Product Image:</td>";
    echo "<td><input id='uploadedfile' name='uploadedfile' type='file' disabled='true'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'></td>";
    echo " <td style='color: red;'>";
    echo "<em>(Only accept .jpg, .png, .gif files) - Image size must not increase in 2MB of file size.</em>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'></td>";
    echo "<td><input type='hidden' name='MAX_FILE_SIZE' value='30000000'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td><input type='hidden' id='txtUpdateImgFile' name='txtUpdateImgFile' value='$File'/></td>";
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