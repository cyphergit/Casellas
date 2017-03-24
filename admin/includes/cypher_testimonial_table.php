<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>Posted By</th>
                <!--<th>Testimonial</th>-->
                <th>Date Posted</th>
                <th></th>
                <!--<th></th>-->
                <th></th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT TestimonialID, CustomerName, DateCreated FROM Testimonials ORDER BY DateCreated DESC";

        $num_rows = mysql_num_rows($sql);

        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            echo "<tr>";
            echo "<td width='10' valign='top'>$row[0]</td>";
            echo "<td valign='top' width='150'>$row[1]</td>";
            //echo "<td>$row[2]</td>";
            echo "<td width='100' valign='top'>$row[2]</td>";
            //echo "<td width='24' valign='top'><a href='$site_host/admin/index.php?pg=testimonials&p=u&rec=$row[0]'>Update</a></td>";
            echo "<td width='15' valign='top'><a onclick=\"deleteRow(this);\">Delete</a></td>";
            echo "<td width='15' valign='top'><a href='index.php?pg=testimonials&p=v&rec=$row[0]'>View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
