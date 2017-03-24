<head>
<script type="text/javascript">
        function CancelSubmission() {
                url = sitehost + 'admin/index.php?pg=voucher';
                location.href =  url;
        }

        function DisabledItem() {
                $('#chkMember').attr('checked', false);
                $('#txtMembersEmail').val('');
                $('#txtMembersEmail').attr('disabled', true);

                var cssBg = {'background-color':'#ccc'}
                $('#txtMembersEmail').css(cssBg);
        }

        function StartUp() {
                $('#chkAll').attr('checked', true);
                $('#txtMailingVal').val('1');
                DisabledItem();
        }

        function validateForm(cypherDistributeVoucherForm) {
            if ($('#selVoucher').val() == 'Select a Voucher') {
                alert("Please select a Voucher!");
                $('#selVoucher').focus();
                return false;
            }

            if ($('#txtMailingVal').val() == '1') {
                if ($('#txtDateRangeFrom').val() == "" && $('#txtDateRangeTo').val() == "") {
                    alert('Please enter values to "Data From" and "Date To"');
                    $('#txtDateRangeFrom').focus();
                    return false;

                } else if ($('#txtDateRangeFrom').val() == "" || $('#txtDateRangeFrom').val() == null) {
                    alert('Please enter value to "Data From"');
                    $('#txtDateRangeFrom').focus();
                    return false;

                } else if ($('#txtDateRangeTo').val() == "" || $('#txtDateRangeTo').val() == null) {
                    alert('Please enter value to "Data To"');
                    $('#txtDateRangeTo').focus();
                    return false;
                }
            }

            if ($('#chkMember').is(':checked')) {
                if ($('#txtMembersEmail').val() == "" ||$('#txtMembersEmail').val() == null) {
                    alert("Please enter valid member's e-mail address!");
                    $('#txtMembersEmail').focus();
                    return false;

                } else {
                    var x = $('#txtMembersEmail').val();
                    var at_pos = x.indexOf("@")
                    var dot_pos = x.lastIndexOf(".")
                    if (at_pos < 1 || dot_pos < at_pos + 2 || dot_pos + 2 >= x.length) {
                        alert("The E-mail Address you have provided is not valid!");
                        $('#txtMembersEmail').focus();
                        return false;
                    }
                }
            }

            return true;
        }

        $(this).ready(function() {
            StartUp();

            $('#chkAll').click(function() {
                if ($(this).is(':checked')) {
                    $('#txtMailingVal').val('1');
                    $('#chkMember').attr('checked', false);
                    $('#txtMembersEmail').attr('disabled', true);
                    $('#txtMembersEmail').val(null);
                    $('.date-range').show();

                    var cssBg = {'background-color':'#ccc'}
                    $('#txtMembersEmail').css(cssBg);

                } else {
                    $('#txtMailingVal').val('2');
                    $('#chkMember').attr('checked', true);
                    $('#txtMembersEmail').attr('disabled', false);
                    $('#txtMembersEmail').val(null);
                    $('.date-range').hide();

                    var cssBg = {'background-color':'#fff'}
                    $('#txtMembersEmail').css(cssBg);
                }
            });

            $('#chkMember').click(function() {
                if ($(this).is(':checked')) {
                    $('#txtMailingVal').val('2');
                    $('#chkAll').attr('checked', false);
                    $('#txtMembersEmail').attr('disabled', false);
                    $('#txtMembersEmail').val(null);
                    $('.date-range').hide();

                    var cssBg = {'background-color':'#fff'}
                    $('#txtMembersEmail').css(cssBg);

                } else {
                    $('#txtMailingVal').val('1');
                    $('#chkAll').attr('checked', true);
                    $('#txtMembersEmail').attr('disabled', true);
                    $('#txtMembersEmail').val(null);
                    $('.date-range').show();

                    var cssBg = {'background-color':'#ccc'}
                    $('#txtMembersEmail').css(cssBg);
                }
            });
        });
</script>
</head>
<body>
<form id="cypherDistrubteVoucherForm" name="cypherDistrubteVoucherForm" method="POST" action="common/f_sendvoucher.php" onsubmit="return validateForm(this);">
  <table>
      <tr>
        <td class="label-fields">Voucher Template:</td>
        <td>
          <?php
              $sql = "SELECT VoucherTemplateID, VoucherName FROM Vouchers WHERE Status = '1' ORDER BY VoucherTemplateID DESC";
              //$num_rows = mysql_num_rows($sql);
              $rs = mysql_query($sql);

              echo "<select id='selVoucher' name='selVoucher' style='border: solid 1px  #945f34; padding: 2px 2px 2px 2px; width: 260px;'>";
              echo "<option value='Select a Voucher'>[Select a Voucher]</option>";

              while($row = mysql_fetch_array($rs)) {
                  $vcID = $row[0];
                  $vcTemplate = $row[1];
                  $voucherVal = $vcID."-".$vcTemplate;
                    echo "<option value='$voucherVal'>$vcTemplate</option>";
               }

              echo "</select>";
          ?>
        </td>
      </tr>
      <tr class="date-range">
          <td class="label-fields">Date Range (Period Cover):</td>
        <td>
            <div>
                <div class="label-fields" style="padding: 0px;">Date From:</div>
                <input type="text" id="txtDateRangeFrom" name="txtDateRangeFrom" class="cypher-FormField date-range-fields"/>
            </div>
            <div>
                <div class="label-fields" style="padding: 0px;">Date To:</div>
                <input type="text" id="txtDateRangeTo" name="txtDateRangeTo" class="cypher-FormField date-range-fields"/>
            </div>
        </td>
      </tr>
      <tr>
        <td class="label-fields">Send to all members:</td>
        <td><input type="checkbox" id="chkAll" name="chkAll"/></td>
      </tr>
      <tr>
        <td class="label-fields">Send to a specific member(s):</td>
        <td><input type="checkbox" id="chkMember" name="chkMember"/></td>
      </tr>
      <tr>
        <td class="label-fields">E-mail Address:</td>
        <td>
            <input type="text" id="txtMembersEmail" name="txtMembersEmail" class="cypher-FormField"/>
            <div class="label-fields" style="padding: 0px;">
                <em>(For more than one specific email address, please use semi-colon ";" as separator.)</em>
            </div>
        </td>
      </tr>

    </tr>
  </table>
  <input type="hidden" id="txtMailingVal" name="txtMailingVal" value=""/>
  <div class="form_buttons">
    <input id="cypher-Submit" type="Submit" value="Send" class="module-buttons"/>
    <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "voucher", "Cancel");?>
  </div>
</form>
  </div>
</body>