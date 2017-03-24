<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
  function ClosePopUp(){
  window.close();
  }
</script>
<title>Testimonials</title>
<?php
	include("../../conf.inc.php");
	$tempID = $_COOKIE['IDValue'];
  
  $q = "SELECT 
          TestimonialID
          , CustomerName
          , CustomerEmail
          , TestimonialMsg          
          , DateCreated
        FROM
          Testimonials
        WHERE
          Testimonials.TestimonialID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
    
  $UserName    = $row[1];
  $UserEmail   = $row[2];
  $Testimonial = $row[3];
  $PostingDate = $row[4];
  
	echo "<div class='DialogForm'>";
	echo "<h4>Testimonial Content</h4>";
  echo "<div class='DialogFormContent'>";
	echo "<div><span class='itemfield'>Name:</span>  <em>$UserName</em></div>";
	echo "<br/>";
  echo "<div><span class='itemfield'>E-mail:</span>  <em>$UserEmail</em></div>";
	echo "<br/>";
  echo "<div><span class='itemfield'>Date and Time Posted:</span>  <em>$PostingDate</em></div>";
	echo "<br/>";
  echo "<div><span class='itemfield'>Message:</span></div>";
	echo "<br/>";
  echo "<div><em>$Testimonial</em></div>";
	echo "<br/>";  
  echo "</div>";
  echo "</div>";
  echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";
?>