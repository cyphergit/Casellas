<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=category';
            
            location.href = url;
            
        }

        function validateForm(cypherCategoryForm) {

            if (document.cypherCategoryForm.txtCName.value == "") {
                alert("Please provide a value for the Category name!");
                document.cypherCategoryForm.txtCName.focus();
                return false;
            }
            
            //if (document.cypherCategoryForm.txtCDesc.value == "") {
            //    alert("Please provide a short description for the Category!");
            //    document.cypherCategoryForm.txtCDesc.focus();
            //    return false;
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
    <legend>New Category</legend>
    <div id="crudForm">
      <form id="cypherCategoryForm" name="cypherCategoryForm" method="POST" action="common/q_category.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Category Name:</label>
            </td>
            <td>
              <input type="text" id="txtCName" name="txtCName" class="cypher-FormField"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <textarea id="txtCDesc" name="txtCDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
              <!--<span class="requiredField">*</span>-->
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
  $q = "SELECT * FROM Product_Category WHERE CategoryID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);  
?>
<div class="dataForm">
  <fieldset>
    <legend>Update Category</legend>
    <div id="crudForm">
      <form id="cypherCategoryForm" name="cypherCategoryForm" method="POST" action="common/q_category.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Category Name:</label>
            </td>
            <td>
              <input type="text" id="txtCName" name="txtCName" class="cypher-FormField" value="<?php echo $row['CategoryName'];?>"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td class="label-fields">
              <label>Description:</label>
            </td>
            <td>
              <textarea id="txtCDesc" name="txtCDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;">
                <?php echo stripslashes($row['Description']);?>
              </textarea>              
            </td>
          </tr>
        </table>
        <input type="hidden" id="EntryID" name="EntryID" value=""<?php echo $row['CategoryID']?>"/>
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
  $q = "SELECT * FROM Product_Category WHERE CategoryID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
?>
<div class="dataForm">
  <fieldset>
    <legend>View Category</legend>
    <div id="crudForm">
      <form id="cypherCategoryForm" name="cypherCategoryForm">
        <table>
          <tr>
            <td class="label-fields">
              <label>Category Name:</label>
            </td>
            <td>
              <?php echo $row['CategoryName'];?>
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