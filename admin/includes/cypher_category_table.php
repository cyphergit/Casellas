<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>        
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM Product_Category WHERE Status = '1' ORDER BY CategoryID DESC";

        $num_rows = mysql_num_rows($sql);

        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            echo "<tr>";
            echo "<td width='10'>$row[0]</td>";
            echo "<td width='220'>$row[1]</td>";
            echo "<td width='24'><a href='$site_host/admin/index.php?pg=category&p=u&rec=$row[0]'>Update</a></td>";
            echo "<td width='24'><a onclick=\"deleteRow(this);\">Delete</a></td>";
            echo "<td width='18'><a href='$site_host/admin/index.php?pg=category&p=v&rec=$row[0]'>View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
