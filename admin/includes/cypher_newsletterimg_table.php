<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>#</th>
                <th>Image File</th>
                <th>File Info.</th>
                <th></th>
                <!--<th></th>-->
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM NewsletterImage ORDER BY ImageID ASC";

        $num_rows = mysql_num_rows($sql);

        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            $imgId = $row[0];
            $imgFile = $row[1];
            $imgLocation = $row[2];

            $imgURL = "../$imgLocation/$imgFile";
            $imgHtmlCode = "<img src='$site_host/$imgLocation/$imgFile' alt='$imgFile' style='max-width: 300px; height: auto;'/>";
            $imgHtmlCode = htmlspecialchars($imgHtmlCode);

            echo "<tr>";
            echo "<td width='15'>$row[0]</td>";
            echo "<td class='imgThumbCol'>";

            echo "<div class='gallery-image-wrapper'>";
            echo "<div class='gallery-image'>";
            echo "<a href='#gallery-catalogue-$imgId' id='$imgId'>";
            echo "<img src='$imgURL' style='width:150px; height: auto;'></img>";
            echo "</a>";
            echo "<span>Double-click Image To Enlarge</span>";
            echo "</div>";
            echo "</div>";

            echo "<div class='gallery-container'>";
            echo "<div id='gallery-catalogue-$imgId'>";
            echo "<div id='gallery-catalogue-wrapper'>";
            echo "<div class='g-container'>";
            echo "<img src='$imgURL' alt='$imgFilename'/>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            echo "</td>";
            echo "<td>";

            echo "<div><strong>File Name:</strong> $imgFile</div>";
            echo "<div><strong>Link Code:</strong>";
            echo "<div style='border: solid 1px #222; padding: 4px; background-color: #ccc;'>$site_host/$imgLocation/$imgFile</div>";
            echo "</div>";
            echo "<div><strong>HTML Code:</strong>";
            echo "<div style='border: solid 1px #222; padding: 4px; background-color: #ccc;'>$imgHtmlCode</div>";
            echo "</div>";
            echo "<span style='color:red;'><em>Copy and Paste the above code to include the image in to your Article.</em></span>";

            echo "</td>";
            echo "<td width='24'><a onclick=\"deleteRow(this);\">Delete</a></td>";
            //echo "<td width='18'><a onclick=\"LoadViewDialog(this);\">View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
