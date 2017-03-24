<script type="text/javascript">
    $(this).ready(function(){
        var txtBirthdate = $('#txtCBirthdate');
        txtBirthdate.datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy'
        });
        
        var chkSubscribe = $('#chkCSubscription');
        var txtSubscribe = $('#txtCSubscription');
        
        if (txtSubscribe.val() == '1') {
            chkSubscribe.attr('checked', true);
        }
        
        chkSubscribe.click(function(){
            if(this.attr('checked', true)) {
                txtSubscribe.val('1');
            } else {
                txtSubscribe.val('0');
            }
        });
        
        var formId = $('#cypherCustomerForm');
        formId.submit(function() {
            var customerFields = {
                email: $('#txtCEmail'),
                lname: $('#txtCLastname'),
                fname: $('#txtCFirstname')
            }
        
            if (customerFields.email.val() == '') {
                alert("Please enter Customer's E-mail Address!");
                customerFields.email.focus();
                return false;
            } else {
                var x = customerFields.email.val();
                var at_pos = x.indexOf("@")
                var dot_pos = x.lastIndexOf(".")
                if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
                    alert("The E-mail Address you have provided is not valid!");
                    customerFields.email.focus();
                    return false;
                }
            }
        
            if (customerFields.lname.val() == "") {
                alert("Please enter Customer's Last Name!");
                customerFields.lname.focus();
                return false;
            }
        
            if (customerFields.fname.val() == "") {
                alert("Please enter Customer's First Name!");
                customerFields.fname.focus();
                return false;
            }            
            return true;
        });
    });
</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

$q = "SELECT * FROM Customers WHERE CustomersID = '$recID'";
$rs = mysql_query($q);
$row = mysql_fetch_array($rs);

$email = requiredField($row['Email']);
$firstname = requiredField($row['Firstname']);
$lastname = requiredField($row['Lastname']);
$middlename = requiredField($row['Middlename']);
$street = requiredField($row['AddressStreet']);
$city = requiredField($row['AddressCity']);
$state = requiredField($row['AddressState']);
$country = requiredField($row['AddressCountry']);
$postal = requiredField($row['AddressPostal']);
$landline = requiredField($row['LandlineNum']);
$mobileno = $row['MobileNum'];
$subscription = $row['NewsletterSubscription'];

if ($birthdate == '0000-00-00') {
    $birthdate = '00/00/0000';
} else {
    $birthdate = date_create($row['BirthDate']);
    $birthdate = date_format($birthdate, 'd/m/Y');
}

if ($mobileno == null || $mobileno == '') {
    $mobileno = "<span style='color: Gray'>OPTIONAL</span>";
}

if ($subscription != 0) {
    $subscribed = "Yes";
} else {
    $subscribed = "No";
}

if ($p == 'c') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>New</legend>
                <div id="crudForm">
                    <form id="cypherCustomerForm" name="cypherCustomerForm" method="POST" action="common/q_customer.php">
                        <p>
                            Please provide the Customer's information by filling up the fields if its available. (<em>Required fields are marked with</em> <span class="requiredField">*</span>)
                        </p>
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>E-mail Address:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCEmail" name="txtCEmail" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Last Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCLastname" name="txtCLastname" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>First Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCFirstname" name="txtCFirstname" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Middle Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCMiddlename" name="txtCMiddlename" class="cypher-FormField"/>                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Birth Date:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCBirthdate" name="txtCBirthdate" class="cypher-FormField date-range-fields"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Street:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCStreet" name="txtCStreet" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>City:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCCity" name="txtCCity" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Country:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCCountry" name="txtCCountry" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Postal:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCPostal" name="txtCPostal" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Landline No.:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCLandline" name="txtCLandline" class="cypher-FormField"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Mobile No.:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCMobile" name="txtCMobile" class="cypher-FormField"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Subscribe to Newsletter:</label>
                                </td>
                                <td>              
                                    <input type="checkbox" id="chkCSubscription" name="chkCSubscription" checked="true"/>
                                    <span class="item-field">(Check or uncheck the box to subscribe the customer to receive a newsletter.)</span>
                                    <input type="hidden" id="txtCSubscription" name="txtCSubscription" value="1"/>
                                </td>
                            </tr>
                        </table>        
                        <input type="hidden" id="Process" name="Process" value="Add"/>
                        <div class="form_buttons">
                            <input id="cypher-Submit" type="Submit" value="Save" class="module-buttons"/>
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "customers", "Cancel"); ?>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} elseif ($p == 'u') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>Update</legend>
                <div id="crudForm">
                    <form id="cypherCustomerForm" name="cypherCustomerForm" method="POST" action="common/q_customer.php">
                        <p>
                            Please provide the Customer's information by filling up the fields if its available. (<em>Required Fields are marked with</em> <span class="requiredField">*</span>)
                        </p>
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>E-mail Address:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCEmail" name="txtCEmail" class="cypher-FormField" value="<?php echo $row[Email]; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Last Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCLastname" name="txtCLastname" class="cypher-FormField" value="<?php echo $row[Lastname]; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>First Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCFirstname" name="txtCFirstname" class="cypher-FormField" value="<?php echo $row[Firstname]; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Middle Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCMiddlename" name="txtCMiddlename" class="cypher-FormField" value="<?php echo $row[Middlename]; ?>"/>                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Birth Date:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCBirthdate" name="txtCBirthdate" class="cypher-FormField" value="<?php echo $birthdate; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Street:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCStreet" name="txtCStreet" class="cypher-FormField" value="<?php echo $row['AddressStreet']; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>City:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCCity" name="txtCCity" class="cypher-FormField" value="<?php echo $row['AddressCity']; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Country:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCCountry" name="txtCCountry" class="cypher-FormField" value="<?php echo $row['AddressCountry']; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Postal:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCPostal" name="txtCPostal" class="cypher-FormField" value="<?php echo $row['AddressPostal']; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Landline No.:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCLandline" name="txtCLandline" class="cypher-FormField" value="<?php echo $row[LandlineNum]; ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Mobile No.:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtCMobile" name="txtCMobile" class="cypher-FormField" value="<?php echo $row[MobileNum] ?>"/>
                                </td>
                            <tr>
                                <td class="label-fields">
                                    <label>Subscribe to Newsletter:</label>
                                </td>
                                <td>
                                    <input type="checkbox" id="chkCSubscription" name="chkCSubscription" checked="true"/>
                                    <span class="item-field">(Check or uncheck the box to subscribe the customer to receive a newsletter.)</span>
                                    <input type="hidden" id="txtCSubscription" name="txtCSubscription" value="<?php echo $subscription; ?>"/>
                                </td>
                            </tr>                            
                        </table>
                        <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $row['CustomersID'] ?>"/>
                        <input type="hidden" id="Process" name="Process" value="Update"/>
                        <div class="form_buttons">
                            <input id="cypher-Submit" type="Submit" value="Update" class="module-buttons"/>
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "customers", "Cancel"); ?>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} elseif ($p == 'v') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>View</legend>
                <div id="crudForm" style="padding-top: 10px;">
                    <form id="cypherCustomerForm" name="cypherCustomerForm">
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>E-mail Address:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $email; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Last Name:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $lastname; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>First Name:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $firstname; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Birth Date:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $birthdate; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Street:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $street; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>City:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $city; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>State:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $state; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Country:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $country; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Postal:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $postal; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Landline No.:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $landline; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Mobile No.:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $mobileno; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Date and Time Joined:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $row[DateJoined]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Subscribed to Newsletter:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $subscribed; ?>
                                </td>
                            </tr>
                        </table>        
                        <div class="form_buttons">
                            <?php moduleUpdate("../admin/index.php?pg=", "", "module-buttons", "", "customers", "Edit", $recID); ?> | 
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "customers", "Back"); ?>                
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} else {
    
}
?>