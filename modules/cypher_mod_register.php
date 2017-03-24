<script type="text/javascript">
        function CancelSubmit() { 
            location.href="http://localhost/Panuccio/"
        }

        function validateForm(cypherRegistrationForm) {

            if (document.cypherRegistrationForm.txtUsername.value == "") {
                alert("Please enter your E-mail Address!");
                document.cypherRegistrationForm.txtUsername.focus();
                
                return false;
            }
            else {
                var x = document.cypherRegistrationForm.txtUsername.value
                var at_pos = x.indexOf("@")
                var dot_pos = x.lastIndexOf(".")
                if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
                    alert("The E-mail Address you have provided is not valid!");
                    document.cypherRegistrationForm.txtUsername.focus();
                    
                    return false;
                }
            }
            
            if (document.cypherRegistrationForm.txtPassword.value == "") {
                alert("Please provide your Password!");
                document.cypherRegistrationForm.txtPassword.focus();
                
                return false;
            }
            else {
                var x = document.cypherRegistrationForm.txtPassword.value
                var char_length = 4
                if (x.length < char_length) {
                    alert("Password must be minimum of 4 characters!");
                    document.cypherRegistrationForm.txtPassword.focus();
                    
                    return false;
                }
            }

            if (document.cypherRegistrationForm.txtConfirmPassword.value == "") {
                alert("Please type your Password for confirmation!");
                document.cypherRegistrationForm.txtConfirmPassword.focus();
                
                return false;
            }

            if (document.cypherRegistrationForm.txtPassword.value != document.cypherRegistrationForm.txtConfirmPassword.value) {
                alert("Password does not matched! Please re-type your Password for confirmation.");
                document.cypherRegistrationForm.txtConfirmPassword.value == " ";
                document.cypherRegistrationForm.txtConfirmPassword.focus(); 
                
                return false;
            }

            return true;
        }
</script>
<form id="cypherRegistrationForm" name="cypherRegistrationForm" method="POST" action="common/f_register.php" onsubmit="return validateForm(this);">
  <label>E-mail Address:</label>
  <br/>
  <input type="text" id="txtUsername" name="txtUsername" class="cypher-RegisterField"/>
  <br/>
  <label>Password:</label>
  <br/>
  <input type="password" id="txtPassword" name="txtPassword" class="cypher-RegisterField"/>
  <br/>
  <label>Confirm Password:</label>
  <br/>
  <input type="password" id="txtConfirmPassword" name="txtConfirmPassword" class="cypher-RegisterField"/>
  <br/>
  <label>Security Code:</label>
  <br/>
  <input type="text" id="security_code" name="security_code" class="cypher-RegisterField"/>
  <br/>
  <img src="modules/cypher_mod_captcha.php?width=100&height=40&characters=5" alt="captcha"/>
  <br/>
  <input id="cypher-Submit" type="Submit" value="Register"/>
  <input id="cypher-Cancel" type="button" value="Cancel" onclick="CancelSubmit();"/>
</form>