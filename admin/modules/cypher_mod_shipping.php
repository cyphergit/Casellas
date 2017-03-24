<script type="text/javascript">
        function CancelSubmission() {             
            
            url = sitehost + 'admin/index.php?pg=shipping';
            
            location.href = url;
            
        }

        function validateForm(cypherShippingForm) {

            if (document.cypherShippingForm.txtSCompany.value == "") {
                alert("Please provide a value for the Shipping Company Name!");
                document.cypherShippingForm.txtSCompany.focus();
                return false;
            }
            
            if (document.cypherShippingForm.txtSRate.value == "") {
                alert("Please provide a value for the Shipping Rate!");
                document.cypherShippingForm.txtSRate.focus();
                return false;
            }
            
            return true;
        }
        
</script>
<form id="cypherShippingForm" name="cypherShippingForm" method="POST" action="common/q_shipping.php" onsubmit="return validateForm(this);">
  <p>
    Please fill-up the required fields (<span style="color: red;">*</span>) below.
  </p>
  <table>        
    <tr>
      <td class="label-fields"><label>Shipping Company:</label></td>
      <td>
        <input type="text" id="txtSCompany" name="txtSCompany" class="cypher-FormField"/>
        <span class="requiredField">*</span>
      </td>
    </tr>
    <tr>
      <td class="label-fields"><label>Description:</label></td>
      <td>
        <textarea id="txtSDesc" name="txtSDesc" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
        <!--<span class="requiredField">*</span>-->
      </td>
    </tr>
    <tr>
      <td class="label-fields"><label>Shipping Rate:</label></td>
      <td>
        <input type="text" id="txtSRate" name="txtSRate" class="cypher-FormField"/>
        <span class="requiredField">*</span>
        <span style="color: #222;">(eg. xxx.xx)</span>
      </td>
    </tr>
  </table>
  <input type="hidden" id="Process" name="Process" value="Add"/>
  <div class="form_buttons">
    <input id="cypher-Submit" type="Submit" value="Add"/>
    <input id="cypher-Cancel" type="button" value="Cancel" onclick="CancelSubmission();"/>
    <input id="reset" type="reset" value="Reset"/>
  </div>
</form>