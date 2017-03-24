<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
  function ClosePopUp(){
  window.close();
  }
</script>
<title>Pre-Owned Image</title>
<?php
	include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  
  $q = "SELECT 
          PreownedImage.ImageID
          , Preowned.ItemName
          , PreownedImage.ItemImage
        FROM PreownedImage, Preowned
        WHERE 
          PreownedImage.PreOwnedID = Preowned.PreOwnedID
        AND
          PreownedImage.ImageID = '$tempID'";

  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
    
  $FileSet = $row[1];
  $ImageFile = $row[2];
  
	echo "<div class='DialogForm'>";
	echo "<h4>Pre Owned Image</h4>";
  echo "<div class='DialogFormContent'>";
	echo "<div><span class='itemfield'>Pre Owned Item Set:</span>  <em>$FileSet</em></div>";
	echo "<br/>";
  echo "<div><span class='itemfield'>File Name:</span>  <em>$ImageFile</em></div>";
	echo "<br/>";
  echo "<div><span class='itemfield'>File Preview:</span></div>";
	echo "<br/>";
  echo "<img src='$site_host/images_preowned/$ImageFile' alt='' style='max-width: 300px; height: auto;'>";
  echo "</div>";
  echo "</div>";
  echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";
?>