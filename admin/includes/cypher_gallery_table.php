<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>File Name</th>        
                <th></th>
                <!--<th></th>-->
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM Gallery ORDER BY ImageID ASC";

        $num_rows = mysql_num_rows($sql);

        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            $imgId = $row[0];
            $imgFilename = $row[1];
            $imgOrigLoc = $row[2];
            $imgThumbLoc = $row[3];

            $imgOrigFile = "../images/gallery/$imgOrigLoc/$imgFilename";
            $imgThumbFile = "../images/gallery/$imgThumbLoc/$imgFilename";

            echo "<tr>";
            echo "<td width='15'>$imgId</td>";
            echo "<td class='imgThumbCol'>";

            echo "<div class='gallery-image-wrapper'>";
            echo "<div class='gallery-image'>";
            echo "<a href='#gallery-catalogue-$imgId' id='$imgId'>";
            echo "<img src='$imgThumbFile' alt='$imgFilename'/>";
            echo "</a>";
            echo "<span>Double-click Image To Enlarge</span>";
            echo "</div>";
            echo "</div>";

            echo "<div class='gallery-container'>";
            echo "<div id='gallery-catalogue-$imgId'>";
            echo "<div id='gallery-catalogue-wrapper'>";
            echo "<div class='g-container'>";
            echo "<img src='$imgOrigFile' alt='$imgFilename'/>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            echo "</td>";
            echo "<td>$imgFilename</td>";
            echo "<td width='24' style='border-left: solid 1px #ccc;'><a onclick='deleteRow(this);'>Delete</a></td>";
            //echo "<td width='18'><a onclick=\"LoadViewDialog(this);\">View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
