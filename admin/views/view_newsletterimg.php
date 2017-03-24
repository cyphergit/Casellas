<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
  function ClosePopUp(){
    window.close();
  }
</script>
<title>Newsletter Image</title>
<?php
	include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  
  $q = "SELECT * FROM NewsletterImage
        WHERE ImageID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
    
  $ImageFile = $row[1];
  
	echo "<div class='DialogForm'>";
	echo "<h4>Newsletter Image</h4>";
  echo "<div class='DialogFormContent'>";
	echo "<div><span class='itemfield'>File Name:</span>  <em>$ImageFile</em></div>";
	echo "<br/>";
  echo "<div><span class='itemfield'>File Preview:</span></div>";
	echo "<br/>";
  echo "<img src='$site_host/images_articles/$ImageFile' alt='' style='max-width: 300px; height: auto;'><br/><br/>";
  echo "<div><span class='itemfield'>Link Code:</span></div>";
	echo "<br/>";
  echo "<input style='width: 450px; border: solid 1px gray' value='$site_host/images_articles/$ImageFile'></input>";
  echo "<div style='margin-top: 10px;'><span class='itemfield'>File Code:</span></div>";
	echo "<br/>";
  echo "<textarea style='width: 450px; border: solid 1px gray'>";
  echo "<img src='$site_host/images_articles/$ImageFile' alt='$ImageFile' style='max-width: 300px; height: auto;'/>";
  echo "</textarea>";
  echo "<br/><span><em>Copy and Paste the above code to include the image in to your Article.</em></span>";
  echo "</div>";
  echo "</div>";
  echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";
?>