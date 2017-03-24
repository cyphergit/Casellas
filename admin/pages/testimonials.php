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
    <h2>Testimonials</h2>
    <div id="crudControl">        
        List of Customer Testimonials |
    </div>
    <div>
        <?php
        if ($_GET['p'] == 'v') {
            include('modules/cypher_mod_testimonial.php');
        } else {
            include('includes/cypher_testimonial_table.php');
        }
        ?>      
    </div>
</div>