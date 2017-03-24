<?php include 'includes/cypher_log_restrict.php'; ?>

<script type="text/javascript">
    function deleteRow(r) {

        var answer = confirm("Delete this entry?")
        if (answer) {
            var i = r.parentNode.parentNode.rowIndex;

            var table = document.getElementById('cypher-dataTable');
            var row = table.rows[i];
            var cell = row.cells[0];
            content = cell.firstChild.nodeValue;

            $("#delete-wrap").append('<form name="deleteForm" id="deleteForm" action="common/q_voucher.php" method="post"><input id="EntryID" name="EntryID" type="hidden" value="' + content + '"/><input id="Process" name="Process" type="hidden" value="Delete"/></form>');

            document.deleteForm.submit();

        } else {
            alert("Operation Cancelled.");
        }
    }
</script>
<table id="cypher-store-table">
    <tr>
        <td class="cypher-store-left">
            <div class="v-menu">
                <?php include('includes/cypher_vmenu.php'); ?>
            </div>
        </td>
        <td class="cypher-store-right">
            <div id="con-admin">
                <h2>Vouchers</h2>
                <div id="crudControl">
                    <a href="index.php?pg=voucher&amp;p=c">Add Vouchers</a> |
                    <a href="index.php?pg=distribute_voucher">Distribute Voucher</a>
                    <div style="float: right;">
                        <a href="index.php?pg=reports">Reports</a> |
                        <a href="index.php?pg=voucher">Voucher Listing</a>
                    </div>
                </div>
                <div>
                    <?php
                    if ($_GET['p'] == 'c') {
                        include('modules/cypher_mod_vouchers.php');
                    } elseif ($_GET['p'] == 'u') {
                        include('modules/cypher_mod_vouchers.php');
                    } elseif ($_GET['p'] == 'v') {
                        include('modules/cypher_mod_vouchers.php');
                    } else {
                        include('includes/cypher_vouchers_table.php');
                    }
                    ?>
                </div>
            </div>
        </td>
    </tr>
</table>