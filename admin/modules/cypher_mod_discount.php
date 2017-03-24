<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=discounts';
            
            location.href = url;
            
        }

        function validateForm(cypherDiscountForm) {
            
            if ($('#chkItem').is(':checked')) {
              if($('#selItem').val() == 0) {
                alert("Please select an Item");
                $('#selItem').focus();
                return false;
              }
            }
            
            if ($('#chkBrand').is(':checked')) {
              if($('#selBrand').val() == 0) {
                alert("Please select a Brand");
                $('#selBrand').focus();
                return false;
              }
            }
            
            if ($('#chkCategory').is(':checked')) {
              if($('#selCategory').val() == 0) {
                alert("Please select a Category");
                $('#selCategory').focus();
                return false;
              }
            }
            
            if (document.cypherDiscountForm.txtDiscount.value == "") {
                alert("Please provide value for discount!");
                document.cypherDiscountForm.txtDiscount.focus();
                return false;
            }
            
            return true;
        }
        
        function ByItem() {
          
          $("#chkItem").attr('checked',true);
          $("#chkBrand").attr('checked',false);
          $("#chkCategory").attr('checked',false);
          $("#chkSubcategory").attr('checked',false);
          
          $("#ByBrand").hide();
          $("#ByCategory").hide();
          $("#BySubcategory").hide();
          
          $("#DiscountBy").val("ByItem");
          $("#OptionSelect").html("By Item:");
			    $("#ByItem").show();
        }
        
        function ByBrand() {
          
          $("#chkItem").attr('checked',false);
          $("#chkBrand").attr('checked',true);
          $("#chkCategory").attr('checked',false);
          $("#chkSubcategory").attr('checked',false);         
          
          $("#ByItem").hide();
          $("#ByCategory").hide();
          $("#BySubcategory").hide();
          
          $("#DiscountBy").val("ByBrand");
          $("#OptionSelect").html("By Brand:");
			    $("#ByBrand").show();
        }
        
        function ByCategory() {
          
          $("#chkItem").attr('checked',false);
          $("#chkBrand").attr('checked',false);
          $("#chkCategory").attr('checked',true);
          $("#chkSubcategory").attr('checked',false);
          
          $("#ByItem").hide();
          $("#ByBrand").hide();
          $("#BySubcategory").hide();
          
          $("#DiscountBy").val("ByCategory");
          $("#OptionSelect").html("By Category:");
			    $("#ByCategory").show();
        }
        
        function BySubCategory() {
          
          $("#chkItem").attr('checked',false);
          $("#chkBrand").attr('checked',false);
          $("#chkCategory").attr('checked',false);
          $("#chkSubcategory").attr('checked',true);          
          
          $("#ByItem").hide();          
          $("#ByBrand").hide();
          $("#ByCategory").hide();
          
          $("#DiscountBy").val("BySubcategory");
          $("#OptionSelect").html("By Subcategory:");
          $("#BySubcategory").show();
        }
        
</script>
<form id="cypherDiscountForm" name="cypherDiscountForm" method="POST" action="common/q_discount.php" onsubmit="return validateForm(this);">
  <p>
    Apply product discount on individual or multiple products as per Category, Subcategory, or by Brand.    
  </p>  
  <table>
    <tr>
      <td class="label-fields"><label>Update By:</label></td>
      <td>
        <input type="checkbox" id="chkItem" name="chkItem" checked="yes" onclick="ByItem();"/>
        <span style="vertical-align: middle;">By Item</span>
        <input type="checkbox" id="chkBrand" name="chkBrand" onclick="ByBrand();"/>
        <span style="vertical-align: middle;">By Brand</span>
        <input type="checkbox" id="chkCategory" name="chkCategory" onclick="ByCategory();"/>
        <span style="vertical-align: middle;">By Category</span>
        <input type="checkbox" id="chkSubcategory" name="chkSubcategory" onclick="BySubCategory();"/>
        <span style="vertical-align: middle;">By Subcategory</span>
      </td>
    </tr> 
    <tr>
      <td class="label-fields">
        <div id="OptionSelect">By Item:</div>
      </td>
      <td>
        <div id="DiscountForm">
          <fieldset>
            <div id="ByItem">
              <div class="label">Item:</div>
              <div>
                <select id="selItem" name="selItem" class="cypher-FormField">
                  <option value="0" selected="yes">[Select an Item]</option>
                  
                  <?php
                    $i_sql = "SELECT * FROM Product WHERE Status = '1' Order by ProductName";
                    $i_rs = mysql_query($i_sql);
                    
                    while($i_row = mysql_fetch_array($i_rs)) {
                      echo "<option value='$i_row[ProductID]'>$i_row[ProductName] ($i_row[ProductID])</option>";
                    }
                  ?>
                  
                </select>
              </div>
            </div>
            
            <div id="ByBrand">
              <div class="label">Brand:</div>
              <div>
                <select id="selBrand" name="selBrand" class="cypher-FormField">
                  <option value="0" selected="yes">[Select a Brand]</option>

                  <?php
                    $b_sql = "SELECT * FROM Brand WHERE Status = '1' Order by BrandName";
                    $b_rs = mysql_query($b_sql);
                    
                    while($b_row = mysql_fetch_array($b_rs)) {
                      echo "<option value='$b_row[BrandID]'>$b_row[BrandName]</option>";
                    }
                  ?>
                  
                </select>
              </div>
            </div>
            
            <div id="ByCategory">
              <div class="label">Category:</div>
              <div>
                <select id="selCategory" name="selCategory" class="cypher-FormField">
                  <option value="0" selected="yes">[Select a Category]</option>

                  <?php
                    $c_sql = "SELECT * FROM Product_Category WHERE Status = '1' Order by CategoryName";
                    $c_rs = mysql_query($c_sql);
                    
                    while($c_row = mysql_fetch_array($c_rs)) {
                      echo "<option value='$c_row[CategoryID]'>$c_row[CategoryName]</option>";
                    }
                  ?>
                  
                </select>
              </div>
            </div>
            
            <div id="BySubcategory">
              <div class="label">Subcategory:</div>
              <div>
                <select id="selSubcategory" name="selSubcategory" class="cypher-FormField">
                  <option value="0" selected="yes">[Select a Subcategory]</option>

                  <?php
                    $sc_sql = "SELECT * FROM Product_Subcategory WHERE Status = '1' Order by SubCategoryName";
                    $sc_rs = mysql_query($sc_sql);
                    
                    while($sc_row = mysql_fetch_array($sc_rs)) {
                      echo "<option value='$sc_row[SubCategoryID]'>$sc_row[SubCategoryName]</option>";
                    }
                  ?>
                  
                </select>
              </div>
            </div>
            
            <div id="DiscountRate">
              <div class="label">Discount:</div>
              <div>
                <input type="text" id="txtDiscount" name="txtDiscount" class="cypher-FormField"></input>
                <span>e.g (xx%)</span>
              </div>
            </div>
          </fieldset>
        </div>

      </td>
    </tr>
  </table>
  <input type="hidden" id="Process" name="Process" value="Update"/>
  <input type="hidden" id="DiscountBy" name="DiscountBy" value="ByItem"/>
  <div class="form_buttons">
    <input id="cypher-Submit" type="Submit" value="Apply"/>
    <input id="cypher-Cancel" type="button" value="Cancel" onclick="CancelSubmission();"/>
    <input id="reset" type="reset" value="Reset"/>
  </div>
</form>