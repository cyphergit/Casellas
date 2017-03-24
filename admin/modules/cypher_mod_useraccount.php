<script type="text/javascript">
    function validateForm(cypherUserAccountForm) {

        if (document.cypherUserAccountForm.txtUsername.value == "") {
            alert("Please enter your E-mail Address!");
            document.cypherUserAccountForm.txtUsername.focus();
            return false;
        }
        else {
            var x = document.cypherUserAccountForm.txtUsername.value
            var at_pos = x.indexOf("@")
            var dot_pos = x.lastIndexOf(".")
            if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
                alert("The E-mail Address you have provided is not valid!");
                document.cypherUserAccountForm.txtUsername.focus();
                return false;
            }
        }

        if (document.cypherUserAccountForm.txtPassword.value == "") {
            alert("Please provide your Password!");
            document.cypherUserAccountForm.txtPassword.focus();
            return false;
        }
        else {
            var x = document.cypherUserAccountForm.txtPassword.value
            var char_length = 4
            if (x.length < char_length) {
                alert("Password must be minimum of 4 characters!");
                document.cypherUserAccountForm.txtPassword.focus();
                return false;
            }
        }

        if (document.cypherUserAccountForm.txtConfirmPass.value == "") {
            alert("Please provide your Password for confirmation!");
            document.cypherUserAccountForm.txtConfirmPass.focus();
            return false;
        }
        else {
            var x = document.cypherUserAccountForm.txtPassword.value
            var y = document.cypherUserAccountForm.txtConfirmPass.value
            if (x != y) {
                alert("Password did not match! Please check your password and try again.");
                document.cypherUserAccountForm.txtConfirmPass.focus();
                return false;
            }
        }

        return true;
    }
</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

if ($p == 'c') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>New Account</legend>
                <div id="crudForm">
                    <form id="cypherUserAccountForm" name="cypherUserAccountForm" method="POST" action="common/q_account.php" onsubmit="return validateForm(this);">
                        <p>
                            Please enter E-mail Address as User Name and a Password to create an Administrative account.
                        </p>
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>E-mail Address:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtUsername" name="txtUsername" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Password:</label>
                                </td>
                                <td>
                                    <input type="password" id="txtPassword" name="txtPassword" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Confirm Password:</label>
                                </td>
                                <td>
                                    <input type="password" id="txtConfirmPass" name="txtConfirmPass" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="Process" name="Process" value="Add"/>
                        <div class="form_buttons">
                            <input id="cypher-Submit" type="Submit" value="Save" class="module-buttons"/>
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "useraccount", "Cancel"); ?>
                            <input id="reset" type="reset" value="Reset" class="module-buttons"/>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} elseif ($p == 'u') {
    $q = "SELECT * FROM UserLogin WHERE UserNumber = '$recID'";
    $rs = mysql_query($q);
    $row = mysql_fetch_array($rs);
    ?>
    <div class="dataForm">
        <fieldset>
            <legend>Update Account</legend>
            <div id="crudForm">
                <form id="cypherUserAccountForm" name="cypherUserAccountForm" method="POST" action="common/q_account.php" onsubmit="return validateForm(this);">
                    <p>
                        Please enter E-mail Address as User Name and a Password to update an Administrative account.
                    </p>
                    <table>
                        <tr>
                            <td class="label-fields">
                                <label>E-mail Address:</label>
                            </td>
                            <td>
                                <input type="text" id="txtUsername" name="txtUsername" class="cypher-FormField" value="<?php echo $row['UserName']; ?>"/>
                                <span class="requiredField">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-fields">
                                <label>Password:</label>
                            </td>
                            <td>
                                <input type="password" id="txtPassword" name="txtPassword" class="cypher-FormField"/>
                                <span class="requiredField">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-fields">
                                <label>Confirm Password:</label>
                            </td>
                            <td>
                                <input type="password" id="txtConfirmPass" name="txtConfirmPass" class="cypher-FormField"/>
                                <span class="requiredField">*</span>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $row['UserNumber'] ?>"/>
                    <input type="hidden" id="Process" name="Process" value="Update"/>
                    <div class="form_buttons">
                        <input id="cypher-Submit" type="Submit" value="Update" class="module-buttons"/>
                        <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "useraccount", "Cancel"); ?>
                        <input id="reset" type="reset" value="Reset" class="module-buttons"/>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>
    <?php
} elseif ($p == 'v') {
    $q = "SELECT * FROM Customers WHERE CustomersID = '$recID'";
    $rs = mysql_query($q);
    $row = mysql_fetch_array($rs);
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>View Account</legend>
                <div id="crudForm" style="padding-top: 10px;">
                    <form id="cypherUserAccountForm" name="cypherUserAccountForm">
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>E-mail Address:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $row[Email]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>First Name:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $row[Firstname]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Last Name:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $row[Lastname]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Landline:</label>
                                </td>
                                <td class="item-field">
                                    <?php
                                    if ($row[LandlineNum] == null) {
                                        echo "n/a";
                                    } else {
                                        echo $row[LandlineNum];
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Mobile:</label>
                                </td>
                                <td class="item-field">
                                    <?php
                                    if ($row[MobileNum] == null) {
                                        echo "n/a";
                                    } else {
                                        echo $row[MobileNum];
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <div class="form_buttons">
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "useraccount", "Back"); ?>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
}
?>