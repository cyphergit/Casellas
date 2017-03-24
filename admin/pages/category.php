<?php
include('includes/cypher_log_restrict.php');
?>
<script type="text/javascript">
    function deleteRow(r) {

        var answer = confirm("Delete this entry?")
        if (answer) {
            var i = r.parentNode.parentNode.rowIndex;

            var table = document.getElementById('cypher-dataTable');
            var row = table.rows[i];
            var cell = row.cells[0];
            content = cell.firstChild.nodeValue;

            $("#delete-wrap").append('<form name="deleteForm" id="deleteForm" action="common/q_category.php" method="post"><input id="EntryID" name="EntryID" type="hidden" value="' + content + '"/><input id="Process" name="Process" type="hidden" value="Delete"/></form>');

            document.deleteForm.submit();

        } else {
            alert("Operation Cancelled.");
        }
    }

    function LoadUpdateDialog(r) {

        var i = r.parentNode.parentNode.rowIndex;

        var table = document.getElementById('cypher-dataTable');
        var row = table.rows[i];
        var cell = row.cells[0];
        content = cell.firstChild.nodeValue;

        document.cookie = 'IDValue = ' + content + '';
        document.cookie = 'Process = Update';

        var w = document.body.clientWidth, h = document.body.clientHeight;
        var popW = 500, popH = 350;
        var leftPos = (w - popW) / 2, topPos = (h - popH) / 2;

        window.open(sitehost + 'admin/views/view_category.php', 'categoryWindow', 'width=' + popW + ',height=' + popH + ',top=' + topPos + ',left=' + leftPos + ',resizable=yes,scrollbars=yes');
    }

    function LoadViewDialog(r) {

        var i = r.parentNode.parentNode.rowIndex;

        var table = document.getElementById('cypher-dataTable');
        var row = table.rows[i];
        var cell = row.cells[0];
        content = cell.firstChild.nodeValue;

        document.cookie = 'IDValue = ' + content + '';
        document.cookie = 'Process = View';

        var w = document.body.clientWidth, h = document.body.clientHeight;
        var popW = 500, popH = 350;
        var leftPos = (w - popW) / 2, topPos = (h - popH) / 2;

        window.open(sitehost + 'admin/views/view_category.php', 'categoryWindow', 'width=' + popW + ',height=' + popH + ',top=' + topPos + ',left=' + leftPos + ',resizable=yes,scrollbars=yes');
    }
</script>
<div id="con-admin">
    <h2>Product Category</h2>
    <table id="cypher-store-table">
        <tr>
            <td class="cypher-store-left">
                <div class="cypher-vmenu">
                    <?php include('includes/cypher_vmenu.php'); ?>  
                </div>      
            </td>
            <td class="cypher-store-right">
                <div id="crudControl">
                    <a href="index.php?pg=category&amp;p=c">Add Category</a> |
                    <a href="index.php?pg=subcategory">Subcategory</a>          
                </div>
                <div>
                    <?php
                    if ($_GET['p'] == 'c') {
                        include('modules/cypher_mod_category.php');
                    } elseif ($_GET['p'] == 'u') {
                        include('modules/cypher_mod_category.php');
                    } elseif ($_GET['p'] == 'v') {
                        include('modules/cypher_mod_category.php');
                    } else {
                        include('includes/cypher_category_table.php');
                    }
                    ?>            
                </div>        
            </td>
        </tr>
    </table>
</div>