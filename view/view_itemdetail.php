<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
  
    function ClosePopUp() {

        window.close();
        
    }

</script>
<title>Pre Owned Item Specs</title>
<?php
  include("../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];

  $q = "SELECT 
          ItemName
        , Brand
        , Model
        , Engine
        , Transmission
        , Description
        , Price
        FROM
          Preowned
        WHERE
          PreOwnedID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
      
  $pItem = $row[0];
  $pBrand = $row[1];
  $pModel = $row[2];
  $pEngine = $row[3];
  $pTransmission = $row[4];
  $pVDetails = $row[5];
  $pUDetails = br2space($row[5]);
  $pPrice = $row[6];
  
  if ($process == "View") {

	    echo "<div class='DialogForm'>";
	    echo "<h4>Pre Owned Item Specs</h4>";
      echo "<div class='DialogFormContent'>";
	    echo "<div><span class='itemfield'>Item:</span>  <em>$pItem</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Brand:</span>  <em>$pBrand</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Model:</span>  <em>$pModel</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Engine:</span>  <em>$pEngine</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Transmission:</span>  <em>$pTransmission</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Details:</span></div>";
	    echo "<br/>";
      echo "<div><em>$pVDetails</em></div>";
	    echo "<br/>";
      echo "<div><span class='itemfield'>Price:</span>  $<em>$pPrice</em></div>";
	    echo "<br/>";
      echo "</div>";
      echo "</div>";
      echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";
  
  } 
?>