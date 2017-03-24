<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=subcategory';
            
            location.href = url;
            
        }

        function validateForm(cypherSubcategoryForm) {

            if (document.cypherSubcategoryForm.txtSCName.value == "") {
                alert("Please provide a value for the Subcategory name!");
                document.cypherSubcategoryForm.txtSCName.focus();
                return false;
            }
            
            if (document.cypherSubcategoryForm.selCategory.value == "Select a Category") {
                alert("Please select a Category!");
                document.cypherSubcategoryForm.selCategory.focus();
                return false;
            }            
            
            //if (document.cypherSubcategoryForm.txtSCDesc.value == "") {
                //alert("Please provide a short description for the Subcategory!");
                //document.cypherSubcategoryForm.txtSCDesc.focus();
                //return false;
            //}
            
            return true;
        }
        
</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

if ($p == 'c') {
?>
<div class="dataForm">
  <fieldset>
    <legend>New Subcategory</legend>
    <div id="crudForm">
      <form id="cypherSubcategoryForm" name="cypherSubcategoryForm" method="POST" action="common/q_subcategory.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Subcategory Name:</label>
            </td>
            <td>
              <input type="text" id="txtSCName" name="txtSCName" class="cypher-FormField"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Category:</label>
            </td>
            <td>
              <!--<input type="text" id="txtCName" name="txtCName" class="cypher-FormField"/>-->
              <select id="selCategory" name="selCategory" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
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
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <textarea id="txtSCDesc" name="txtSCDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
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
  $q = "SELECT * FROM Product_Subcategory WHERE SubCategoryID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
  
  $catID = $row[2]; 
?>
<div class="dataForm">
  <fieldset>
    <legend>Update Subcategory</legend>
    <div id="crudForm">
      <form id="cypherSubcategoryForm" name="cypherSubcategoryForm" method="POST" action="common/q_subcategory.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Subcategory Name:</label>
            </td>
            <td>
              <input type="text" id="txtSCName" name="txtSCName" class="cypher-FormField" value="<?php echo $row[1];?>"/>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Category:</label>
            </td>
            <td>
              <!--<input type="text" id="txtCName" name="txtCName" class="cypher-FormField"/>-->
              <select id="selCategory" name="selCategory" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                <option value="Select a Category">Select a Category</option>
                <?php
                    $sql = "SELECT CategoryID, CategoryName FROM Product_Category WHERE Status = '1' ORDER BY CategoryID ASC";
              
                    $num_rows = mysql_num_rows($sql);
        
                    $rs = mysql_query($sql);
        
                    while($row = mysql_fetch_array($rs))
		                { 		    
                      if ($row[0] == $catID){
                        echo "<option value='$row[0]' selected='yes'>$row[1]</option>";
                      } else {
                        echo "<option value='$row[0]'>$row[1]</option>";
                      }
                      
			              }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <textarea id="txtSCDesc" name="txtSCDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;">
                <?php echo stripslashes($row[3]);?>
              </textarea>
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
  $q = "SELECT
        Product_Subcategory.SubCategoryName
        , Product_Category.CategoryName
        , Product_Subcategory.Description        
    FROM Product_Subcategory, Product_Category 
    WHERE Product_Subcategory.CategoryID = Product_Category.CategoryID
    AND Product_Subcategory.SubCategoryID = '$recID'";
    
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
?>
<div class="dataForm">  
  <fieldset>
    <legend>View Subcategory</legend>
    <div id="crudForm">
      <form id="cypherSubcategoryForm" name="cypherSubcategoryForm">        
        <table>
          <tr>
            <td class="label-fields">
              <label>Subcategory Name:</label>
            </td>
            <td>
              <?php echo $row[1];?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Category:</label>
            </td>
            <td>
              <?php echo $row[1];?>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <?php echo stripslashes($row[3]);?>
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