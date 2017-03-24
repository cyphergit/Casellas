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

            var cell3 = row.cells[2];
            fileName = cell3.firstChild.nodeValue;

            $("#delete-wrap").append('<form name="deleteForm" id="deleteForm" action="common/q_downloads.php" method="post"><input id="EntryID" name="EntryID" type="hidden" value="' + content + '"/><input id="docFile" name="docFile" type="hidden" value="' + fileName + '"/><input id="Process" name="Process" type="hidden" value="Delete"/></form>');

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

        window.open(sitehost + 'admin/views/view_downloads.php', 'fileWindow', 'width=' + popW + ',height=' + popH + ',top=' + topPos + ',left=' + leftPos + ',resizable=yes,scrollbars=yes');
    }

    function LoadViewDialog(r) {

        var i = r.parentNode.parentNode.rowIndex;

        var table = document.getElementById('cypher-dataTable');
        var row = table.rows[i];
        var cell = row.cells[0];
        content = cell.firstChild.nodeValue;

        var w = document.body.clientWidth, h = document.body.clientHeight;
        var popW = 500, popH = 350;
        var leftPos = (w - popW) / 2, topPos = (h - popH) / 2;

        var cell3 = row.cells[2];
        fileName = cell3.firstChild.nodeValue;

        window.open(sitehost + 'downloadables/' + fileName, 'fileWindow', 'width=' + popW + ',height=' + popH + ',top=' + topPos + ',left=' + leftPos + ',resizable=yes,scrollbars=yes');
    }
</script>
<h2>Downloads</h2>
<div id="crudControl">
    <!--<a href="index.php?pg=upload_file">Add File</a> |-->  
    <a href="index.php?pg=downloads_create" class="crud-javalink">Add File</a>
    <div style="float: right;">
        <!--| <a href="index.php?pg=downloads">File Listing</a>-->
        <!--<a href="index.php?pg=useraccount">User Accounts</a>-->
    </div>
</div>
<div>
    <?php include('includes/cypher_downloads_table.php'); ?>
</div>
