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

            $("#delete-wrap").append('<form name="deleteForm" id="deleteForm" action="common/q_articles.php" method="post"><input id="EntryID" name="EntryID" type="hidden" value="' + content + '"/><input id="Process" name="Process" type="hidden" value="Delete"/></form>');

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
                <h2>Reports</h2>
                <div id="crudControl">
                    Newsletter and voucher distribution reports.
                </div>
                <div style="margin-top:  16px;">
                    <?php
                    if ($_GET['d'] == 'a') {
                        include('modules/cypher_mod_reports.php');
                    } elseif ($_GET['d'] == 'n') {
                        include('modules/cypher_mod_reports.php');
                    } elseif ($_GET['d'] == 'v') {
                        include('modules/cypher_mod_reports.php');
                    } else {
                        include('includes/cypher_reports_table.php');
                    }
                    ?>
                </div>
            </div>
        </td>
    </tr>
</table>