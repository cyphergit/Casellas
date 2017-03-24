<?php
  //include('conf.inc.php');
  
  $sql = "SELECT * FROM Testimonials ORDER BY DateCreated DESC";
  
  $num_rows = mysql_num_rows($sql);
        
  $rs = mysql_query($sql);
  
  if (mysql_num_rows($rs) > 0) {
    
    echo "<div id='paging'>";
  
    while($row = mysql_fetch_array($rs))
	  { 
      $UserEmail = $row[CustomerEmail];
      $TestimonialMsg = $row[TestimonialMsg];
      $DatePosted = $row[DateCreated];
          
      echo "<p>";   
	    echo "<em>$TestimonialMsg</em><br/><br/>";
      echo "<em style='font-weight: bold;'>$UserEmail</em><br/>";
      echo "<em>Posted $DatePosted</em><br/>";
      echo "</p>";
  
	  }
  
    echo "</div>";
  
  } else {
  
    echo "<span style='padding-left: 10px; font-style: italic; color: red;'>";
    echo "No testimonial(s) as of the moment.";
    echo "</span>";
  
  }
  
?>