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

            var cell2 = row.cells[2];
            fileName = cell2.firstChild.nodeValue;

            $("#delete-wrap").append('<form name="deleteForm" id="deleteForm" action="common/q_galleryimage.php" method="post"><input id="EntryID" name="EntryID" type="hidden" value="' + content + '"/><input id="imageFile" name="imageFile" type="hidden" value="' + fileName + '"/><input id="Process" name="Process" type="hidden" value="Delete"/></form>');

            document.deleteForm.submit();

            //alert(fileName);
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
                <h2>Gallery</h2>
                <div id="crudControl">
                    <a href="index.php?pg=gallery_image_upload">Add Image</a> |
                    <a href="index.php?pg=gallery">Image Listing</a>
                </div>
                <div>
                    <?php include('includes/cypher_gallery_table.php'); ?>
                </div>
            </div>
        </td>
    </tr>
</table>
