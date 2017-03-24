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
<div id="con-admin">
    <h2>Products</h2>
    <table id="cypher-store-table">
        <tr>
            <td class="cypher-store-left">
                <div class="cypher-vmenu">
                    <?php
                    include('includes/cypher_vmenu.php');
                    ?>
                </div>
            </td>
            <td class="cypher-store-right">
                <div id="crudControl">
                    <a href="index.php?pg=products&amp;p=c">Add Product</a> |
                    <a href="index.php?pg=products">Product Listing</a>
                </div>
                <div>
                    <?php
                    if ($_GET['p'] == 'c') {
                        include('modules/cypher_mod_product.php');
                    } elseif ($_GET['p'] == 'u') {
                        include('modules/cypher_mod_product.php');
                    } elseif ($_GET['p'] == 'v') {
                        include('modules/cypher_mod_product.php');
                    } else {
                        include('includes/cypher_product_table.php');
                    }
                    ?>          
                </div>
            </td>
        </tr>
    </table>
</div>