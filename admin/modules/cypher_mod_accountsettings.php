<?php
$user = $_SESSION['username'];

$sql = "SELECT Username, Password, SystemLevel, Usernumber FROM UserLogin WHERE Username = '$user'";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);
?>
<script type="text/javascript">
    function validateForm(cypherAccountForm) {

        var new_pass = document.cypherAccountForm.txtUNewPass.value
        var confirm_pass = document.cypherAccountForm.txtUConfirmPass.value

        if (document.cypherAccountForm.txtUEmail.value == "") {

            alert("Please enter your E-mail Address!");
            document.cypherAccountForm.txtETitle.focus();
            return false;

        } else {

            var x = document.cypherAccountForm.txtUEmail.value
            var at_pos = x.indexOf("@")
            var dot_pos = x.lastIndexOf(".")

            if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
                alert("The E-mail Address you have provided is not valid!");
                document.cypherAccountForm.txtUEmail.focus();
                return false;
            }
        }

        if (document.cypherAccountForm.selULevel.value == "0") {
            alert("Please selec a User Level!");
            document.cypherAccountForm.selULevel.focus();
            return false;
        }

        if (new_pass != confirm_pass) {
            alert("Your password did not match. Please try again!");
            document.cypherAccountForm.txtUConfirmPass.focus();
            return false;
        }

        return true;
    }

</script>
<form id="cypherAccountForm" name="cypherAccountForm" method="POST" action="common/q_account.php" onsubmit="return validateForm(this);">
    <table>
        <tr>
            <td class="label-fields"><label>User E-mail:</label></td>
            <td>
                <input type="text" id="txtUEmail" name="txtUEmail" class="cypher-FormField" value="<?php echo $row[0]; ?>"/>
                <span class="requiredField">*</span>
            </td>
        </tr>
        <tr>
            <td class="label-fields"><label>User Level:</label></td>
            <td>
                <select id="selULevel" name="selULevel" class="cypher-FormField" style="border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;">
                    <?php
                    $uLevel = $row[2];

                    if ($uLevel == '1') {

                        echo "<option value='0'>Select a User Level...</option>";
                        echo "<option selected='yes' value='1'>Administrator</option>";
                        echo "<option value='2'>User</option>";
                    } else {

                        echo "<option value='0'>Select a User Level...</option>";
                        echo "<option value='1'>Administrator</option>";
                        echo "<option selected='yes' value='2'>User</option>";
                    }
                    ?>
                </select>
                <span class="requiredField">*</span>
            </td>
        </tr>
        <tr>
            <td class="label-fields"><label>New Password:</label></td>
            <td>
                <input type="password" id="txtUNewPass" name="txtUNewPass" class="cypher-FormField"/>
                <span class="requiredField">*</span>
            </td>
        </tr>
        <tr>
            <td class="label-fields"><label>Confirm Password:</label></td>
            <td><input type="password" id="txtUConfirmPass" name="txtUConfirmPass" class="cypher-FormField"/></td>
        </tr>
    </table>
    <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $row[3]; ?>"/>
    <input type="hidden" id="txtPassword" name="txtPassword" value="<?php echo $row[1]; ?>"/>
    <input type="hidden" id="Process" name="Process" value="Update"/>
    <div class="form_buttons">
        <input id="cypher-Submit" type="Submit" value="Update" class="module-buttons"/>
        <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "home", "Cancel");?>
    </div>
</form>
