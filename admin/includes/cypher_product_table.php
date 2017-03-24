<div id="dataTable-container">
    <table id="cypher-dataTable" class="display">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT
                  md5(Product.ProductID)
                  , Product.ProductID
                  , Product.ProductName
                  , Brand.BrandName
                  , Product_Category.CategoryName
                FROM 
                  Product,
                  Product_Category,
                  Brand
                WHERE
                  Product.CategoryID = Product_Category.CategoryID
                AND
                  Product.BrandID = Brand.BrandID
                AND
                  Product.Status = '1' ORDER BY Product.ProductID DESC";

        $num_rows = mysql_num_rows($sql);

        $rs = mysql_query($sql);

        while ($row = mysql_fetch_array($rs)) {
            echo "<tr>";
            echo "<td width='10'>$row[1]</td>";
            echo "<td width='220'>$row[2]</td>";
            echo "<td width='150'>$row[3]</td>";
            echo "<td width='150'>$row[4]</td>";
            echo "<td width='24'><a href='$site_host/admin/index.php?pg=products&p=u&rec=$row[0]'>Update</a></td>";
            echo "<td width='24'><a onclick=\"deleteRow(this);\">Delete</a></td>";
            echo "<td width='18'><a href='$site_host/admin/index.php?pg=products&p=v&rec=$row[0]'>View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div id="delete-wrap"></div>
