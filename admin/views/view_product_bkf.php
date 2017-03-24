<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
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
                        
        if (document.UpdateForm.txtPQuantity.value == "0") {
            alert("Please provide a Quantity for the product not less than 0!");
            document.UpdateForm.txtPQuantity.focus();
            return false;
        }
            
        if (document.UpdateForm.txtPPrice.value == "0") {
            alert("Please provide a Price for the Product!");
            document.UpdateForm.txtPPrice.focus();
            return false;
        }
        
        //return true;        
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
  include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          Product.ProductName
          , Brand.BrandName
          , Product.Description
          , Product_Category.CategoryName
          , Product_Subcategory.SubcategoryName
          , Product.Quantity
          , Product.Price
          , Product.Discount
          , Product.CategoryID
          , Product.SubcategoryID
          , Product.BrandID
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
  $uAContent = br2space($row[2]);
  $pCategory = $row[3];
  $pSubcategory = $row[4];
  $pQuantity = $row[5];
  $pPrice = $row[6];
  $pDiscount = $row[7];
  
  $cID = $row[8];
  $scID = $row[9];
  $bID = $row[10];
  
  if ($process == "View") {
  
    echo "<div class='DialogForm'>";
	  echo "<h4>Product Details</h4>";
    echo "<div class='DialogFormContent'>";
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
    echo "</div>";
    echo "</div>";
    echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";  
  
  } else {
  
    echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_products.php'>";
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
    echo "<td><input type='text' id='txtPPrice' name='txtPPrice' class='DialogEntry' value='$pPrice'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Discount:</td>";
    echo "<td><input type='text' id='txtPDiscount' name='txtPDiscount' class='DialogEntry' value='$pDiscount'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='itemfield'>Description:</td>";
    echo "<td><textarea id='txtPDesc' name='txtPDesc' style='width: 330px; border: solid 1px #ccc;'>$uAContent</textarea></td>";
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