<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>Voucher ID</th>
                <th>Title</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
        $p = $_GET['p'];

        if ($p == 'a') {
            $sql = "SELECT * FROM Vouchers WHERE Status = '1' ORDER BY VoucherTemplateID DESC";
            $rs = mysql_query($sql);
        } else if ($p == 'n') {
            $sql = "SELECT * FROM Vouchers WHERE Status = '1' ORDER BY VoucherTemplateID DESC";
            $rs = mysql_query($sql);
        } else if ($p == 'v') {
            $sql = "SELECT * FROM Vouchers WHERE Status = '1' ORDER BY VoucherTemplateID DESC";
            $rs = mysql_query($sql);
        }
        ?>

        <?php
        $sql = "SELECT * FROM Vouchers WHERE Status = '1' ORDER BY VoucherTemplateID DESC";
        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            echo "<tr>";
            echo "<td style='width:100px;'>$row[0]</td>";
            echo "<td>$row[2]</td>";
            echo "<td width='24'><a href='admin/index.php?pg=voucher&p=u&rec=$row[0]'>Update</a></td>";
            echo "<td width='24'><a onclick=\"deleteRow(this);\">Delete</a></td>";
            echo "<td width='18'><a href='admin/index.php?pg=voucher&p=v&rec=$row[0]'>View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
