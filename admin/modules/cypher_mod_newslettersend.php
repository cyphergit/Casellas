<head>
<script type="text/javascript">
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

        function validateForm(cypherSendNewsletterForm) {            
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
            
            if ($('#selNewsletter').val() == 'Select a Newsletter') {
                alert("Please select a Newsletter!");
                $('#selNewsletter').focus();
                return false;
            }

            return true;
        }

        $(this).ready(function () {
            StartUp();

            $('#chkAll').click(function (){
                if ($(this).is(':checked')) {
                    $('#txtMailingVal').val('1');
                    $('#chkMember').attr('checked', false);
                    $('#txtMembersEmail').attr('disabled', true);
                    $('#txtMembersEmail').val(null);

                    var cssBg = {'background-color':'#ccc'}
                    $('#txtMembersEmail').css(cssBg);

                } else {
                    $('#txtMailingVal').val('2');
                    $('#chkMember').attr('checked', true);
                    $('#txtMembersEmail').attr('disabled', false);
                    $('#txtMembersEmail').val(null);

                    var cssBg = {'background-color':'#fff'}
                    $('#txtMembersEmail').css(cssBg);
                }
            });

            $('#chkMember').click(function (){
                if ($(this).is(':checked')) {
                    $('#txtMailingValue').val('2');
                    $('#chkAll').attr('checked', false);
                    $('#txtMembersEmail').attr('disabled', false);
                    $('#txtMembersEmail').val(null);

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
<form id="cypherSendNewsletterForm" name="cypherSendNewsletterForm" method="POST" action="common/f_sendnewsletter.php" onsubmit="return validateForm(this);">
  <table>
    <tr>
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
        <td><input type="text" id="txtMembersEmail" name="txtMembersEmail" class="cypher-FormField"/></td>
      </tr>
      <tr>
        <td class="label-fields">Newsletter List:</td>
        <td>
          <?php
              $sql = "SELECT NewsletterName FROM Newsletter WHERE Status = '1' ORDER BY NewsletterID DESC";

              $num_rows = mysql_num_rows($sql);

              $rs = mysql_query($sql);

              echo "<select id='selNewsletter' name='selNewsletter' style='border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;'>";
              echo "<option value='Select a Newsletter'>[Select a Newsletter]</option>";

              while ($row = mysql_fetch_array($rs)) {
                    $newsletterVal = $row[0];
                    echo "<option value='$newsletterVal'>$newsletterVal</option>";
                }

              echo "</select>";
          ?>
        </td>
      </tr>
    </tr>
  </table>
  <input type="hidden" id="txtMailingVal" name="txtMailingVal" value=""/>
  <?php
    $m_sql = "SELECT Customers.Email
              FROM Customers, UserLogin
              WHERE Customers.CustomersID = UserLogin.UserNumber
              AND UserLogin.SystemLevel = '3'
              AND Customers.NewsletterSubscription = '0'
              AND UserLogin.Status = '1'";

    $m_num_rows = mysql_num_rows($m_sql);

    $m_rs = mysql_query($m_sql);

    echo "<input type='hidden' id='txtCMailingList' name='txtCMailingList' value='";

    while($m_row = mysql_fetch_array($m_rs))
    {
      $cList = $m_row[0];

      echo "$cList,";
    }

    echo "'/>";
  ?>
  <div class="form_buttons">
    <input id="cypher-Submit" type="Submit" value="Send" class="module-buttons"/>
    <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "newsletter", "Cancel");?>
  </div>
</form>
  </div>
</body>