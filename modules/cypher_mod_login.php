<script type="text/javascript">
        function CancelSubmit() { 
            location.href="http://localhost/Panuccio/"
        }

        function validateForm(cypherLoginForm) {

            if (document.cypherLoginForm.txtUsername.value == "") {
                alert("Please enter your E-mail Address!");
                document.cypherLoginForm.txtUsername.focus();
                return false;
            }
            else {
                var x = document.cypherLoginForm.txtUsername.value
                var at_pos = x.indexOf("@")
                var dot_pos = x.lastIndexOf(".")
                if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
                    alert("The E-mail Address you have provided is not valid!");
                    document.cypherLoginForm.txtUsername.focus();
                    return false;
                }
            }
            
            if (document.cypherLoginForm.txtPassword.value == "") {
                alert("Please provide your Password!");
                document.cypherLoginForm.txtPassword.focus();
                return false;
            }
            else {
                var x = document.cypherLoginForm.txtPassword.value
                var char_length = 4
                if (x.length < char_length) {
                    alert("Password must be minimum of 4 characters!");
                    document.cypherLoginForm.txtPassword.focus();
                    return false;
                }
            }

            return true;
        }
</script>
<form id="cypherLoginForm" name="cypherLoginForm" method="POST" action="common/f_verifylogin.php" onsubmit="return validateForm(this);">
  <table>
    <tr>
      <td>
        <label>E-mail Address:</label>
      </td>
      <td>
        <input type="text" id="txtUsername" name="txtUsername" class="cypher-LoginField"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Password:</label>
      </td>
      <td>
        <input type="password" id="txtPassword" name="txtPassword" class="cypher-LoginField"/>
      </td>
    </tr>
  </table>  
  <input id="cypher-Submit" type="Submit" value="Log In"/>
</form>