<script type="text/javascript">
  $(function() {
        $("#b_txtPrefDate").datepicker({
            minDate: new Date()
        });
	});
  
  function validateForm(cypherBookingForm) {
    
      if (document.cypherBookingForm.b_txtFirstname.value == "") {
          alert("Please enter your First Name!");
          document.cypherBookingForm.b_txtFirstname.focus();
          return false;
      }
      
      if (document.cypherBookingForm.b_txtLastname.value == "") {
          alert("Please enter your Last Name!");
          document.cypherBookingForm.b_txtLastname.focus();
          return false;
      }
      
      if (document.cypherBookingForm.b_txtEmail.value == "") {
          alert("Please enter your E-mail Address!");
          document.cypherBookingForm.b_txtEmail.focus();
          return false;
      }
      else {
          var x = document.cypherBookingForm.b_txtEmail.value
          var at_pos = x.indexOf("@")
          var dot_pos = x.lastIndexOf(".")
            if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
                alert("The E-mail Address you have provided is not valid!");
                document.cypherBookingForm.b_txtEmail.focus();
                return false;
            }
      }

      if (document.cypherBookingForm.b_txtContact.value == "") {
          alert("Please enter your Contact Number!");
          document.cypherBookingForm.b_txtContact.focus();
          return false;
      }
      
      if (document.cypherBookingForm.b_txtLocAddress.value == "") {
          alert("Please enter your Address!");
          document.cypherBookingForm.b_txtLocAddress.focus();
          return false;
      }              
      
      if (document.cypherBookingForm.b_txtCarModel.value == "") {
          alert("Please enter the Car Model!");
          document.cypherBookingForm.b_txtCarModel.focus();
          return false;
      }
      
      if (document.cypherBookingForm.selTransmission.value == "[Select Transmission]") {
          alert("Please select Car Transmission!");
          document.cypherBookingForm.selTransmission.focus();
          return false;
      }
      
      if (document.cypherBookingForm.selFuelType.value == "[Select Fuel Type]") {
          alert("Please select Fuel Type!");
          document.cypherBookingForm.selTransmission.focus();
          return false;
      }              

      if (document.cypherBookingForm.b_txtServiceRequest.value == "") {
          alert("Please enter your Car Service Request!");
          document.cypherBookingForm.b_txtServiceRequest.focus();
          return false;
      }
      
      if (document.cypherBookingForm.b_txtPrefDate.value == "") {
          alert("Please select your preferred service schedule!");
          document.cypherBookingForm.b_txtPrefDate.focus();
          return false;
      }              
              
      return true;
  }       
    
  function ClearFieldValues() {
      document.cypherBookingForm.b_txtFirstname.value = "";
      document.cypherBookingForm.b_txtLastname.value = "";
      document.cypherBookingForm.b_txtEmail.value = "";
      document.cypherBookingForm.b_txtContact.value = "";
      document.cypherBookingForm.b_txtLocAddress.value = "";
      document.cypherBookingForm.b_txtCarModel.value = "";
      document.cypherBookingForm.selTransmission.value = "[Select Transmission]";
      document.cypherBookingForm.selFuelType.value = "[Select Fuel Type]";
      document.cypherBookingForm.b_txtServiceRequest.value = "";
      document.cypherBookingForm.b_txtPrefDate.value = "";
      document.cypherBookingForm.chkNewsletter.checked = false;
  }                  
  
  function NewsletterSubscribe() {

      if (document.cypherBookingForm.chkNewsletter.checked == false) {
          document.cypherBookingForm.txtNewsletter.value = "0";
      } else {
          document.cypherBookingForm.txtNewsletter.value = "1";
      }

  }              
              
  function CloseForm() {
  
      ClearFieldValues();
      $.fancybox.close();
      
  }
        
  function CancelSubmitForm() {
  
      ClearFieldValues();
      $.fancybox.close();    
      
  }                  
              
</script>
<form id="cypherBookingForm" name="cypherBookingForm" method="post" action="common/f_sendbooking.php" onsubmit="return validateForm(this);">
  <h3>Contact Details</h3>
  <table style="margin-bottom: 8px;">
    <tr>
      <td class="col-label">First Name:</td>
      <td>
        <input id="b_txtFirstname" name="b_txtFirstname" class="form-field" type="text"/>
      </td>      
    </tr>
    <tr>
      <td class="col-label">Last Name:</td>
      <td>
        <input id="b_txtLastname" name="b_txtLastname" class="form-field" type="text"/>
      </td>
    </tr>
    <tr>
      <td class="col-label">Email Address:</td>
      <td>
        <input id="b_txtEmail" name="b_txtEmail" class="form-field" type="text"/>
      </td>      
    </tr>
    <tr>
      <td class="col-label">Contact No.:</td>
      <td>
        <input id="b_txtContact" name="b_txtContact" class="form-field" type="text"/>
      </td>
    </tr>
    <tr>
      <td class="col-label">Complete Home Address:</td>
      <td>
        <textarea id="b_txtLocAddress" name="b_txtLocAddress" class="form-field" col="10" style="height: 50px;"></textarea>
      </td>
    </tr>
  </table>
  <h3>Car Details</h3>
  <table style="margin-bottom: 8px;">
    <tr>
      <td class="col-label">Car Model:</td>
      <td>
        <input id="b_txtCarModel" name="b_txtCarModel" class="form-field" type="text"/>
      </td>           
    </tr>
    <tr>
      <td class="col-label">Transmission:</td>
      <td>
        <select id="selTransmission" name="selTransmission" class="form-field">
          <option value="[Select Transmission]" selected="yes">[Select Transmission]</option>
          <option value="Automatic">Automatic</option>
          <option value="Manual">Manual</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="col-label">Fuel Type:</td>
      <td>
        <select id="selFuelType" name="selFuelType" class="form-field">
          <option value="[Select Fuel Type]" selected="yes">[Select Fuel Type]</option>
          <option value="Unleaded">Unleaded</option>
          <option value="Diesel">Diesel</option>
          <option value="LPG">LPG</option>
        </select>
      </td>
    </tr>
  </table>
  <h3>Service Request</h3>
  <table style="margin-bottom: 8px;">
    <tr>
      <td class="col-label">(Eg. Chassis Upgrade)</td>
      <td>
        <textarea id="b_txtServiceRequest" name="b_txtServiceRequest" class="form-field" col="10" style="height: 50px;"></textarea>
      </td>
    </tr>
  </table>
  <h3>Service Schedule</h3>
  <table>
    <tr>
      <td class="col-label">Preferred Date:</td>
      <td>
        <input id="b_txtPrefDate" name="b_txtPrefDate" class="form-field" type="text"/>
      </td>
    </tr>
  </table>
  <div style="border-top: dotted 1px gray; margin-top: 8px; color: #fff; font-style: italic;">
    <input type="checkbox" id="chkNewsletter" name="chkNewsletter" onclick="NewsletterSubscribe();"/>
    <span>Subscribe to our Newsletter for updates and services Panuccio Autos offer.</span>
  </div>
  <input type="hidden" id="txtNewsletter" name="txtNewsletter" value="0" />
  <div class="crudForm">
    <input type="submit" id="submit" name="submit" class="bookingButton" value=""/>
    <input type="button" id="cancel" name="cancel" class="cancelButton" value="" onclick="CancelSubmitForm();"/>
    <input type="button" id="close" name="close" class="closeButton" value="" onclick="CloseForm();"/>
  </div>
</form>