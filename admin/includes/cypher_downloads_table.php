<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>File ID</th>
                <th>File Title</th>
                <th>File Name</th>       
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM Downloadables WHERE Status = '1' ORDER BY FileID DESC";

        $num_rows = mysql_num_rows($sql);

        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            echo "<tr>";
            echo "<td style='width:100px;'>$row[0]</td>";
            echo "<td style='width:180px;'>$row[2]</td>";
            echo "<td>$row[1]</td>";
            echo "<td width='24'><a onclick=\"LoadUpdateDialog(this);\">Update</a></td>";
            echo "<td width='24'><a onclick=\"deleteRow(this);\">Delete</a></td>";
            echo "<td width='18'><a onclick=\"LoadViewDialog(this);\">View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
