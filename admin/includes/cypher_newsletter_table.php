<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>Newsletter ID</th>
                <th>Newsletter Title</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM Newsletter WHERE Status = '1' ORDER BY NewsletterID DESC";

        $num_rows = mysql_num_rows($sql);

        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            echo "<tr>";
            echo "<td style='width:100px;'>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td width='24'><a href='index.php?pg=newsletter&p=u&rec=$row[0]'>Update</a></td>";
            echo "<td width='24'><a onclick=\"deleteRow(this);\">Delete</a></td>";
            echo "<td width='18'><a href='index.php?pg=newsletter&p=v&rec=$row[0]'>View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
