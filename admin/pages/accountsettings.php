<?php include('includes/cypher_log_restrict.php');?>
<table id="cypher-store-table">
  <tr>
    <td class="cypher-store-left">
      <div class="v-menu">
        <?php include('includes/cypher_vmenu.php');?>
      </div>
    </td>
    <td class="cypher-store-right">
      <div id="con-admin">
        <h2>Account Settings</h2>
        <div id="crudControl">
          Update your account credentials here.
        </div>
        <div class="dataForm-wrapper" style="margin-top: 16px;">
          <div class="dataForm">
            <fieldset>
              <legend>Account Credentials</legend>
              <div id='crudForm'>
                <?php include('modules/cypher_mod_accountsettings.php');?>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </td>
  </tr>
</table>