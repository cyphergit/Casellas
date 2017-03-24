<?php
  include('conf.inc.php');
  
  $sql = "SELECT EventTitle, EventDesc, EventDate, EventVenue FROM Events WHERE Status = '1' ORDER BY EventID DESC";
  
  $num_rows = mysql_num_rows($sql);
        
  $rs = mysql_query($sql);
  
  if (mysql_num_rows($rs) > 0) {
  
    while($row = mysql_fetch_array($rs))
	  { 
      $eTitle = $row[0];
      $eDetails = $row[1];
      $eDate = $row[2];
      $eVenue = $row[3];
    
      echo "<table style='position: relative; top: -10px;'>";
      echo "<tr>";
      echo "<td class='itemlabel'>What:</td>";
      echo "<td><em>$eTitle</em></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemlabel'>When:</td>";
      echo "<td><em>$eDate</em></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemlabel'>Where:</td>";
      echo "<td><em>$eVenue</em></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemlabel'>Details:</td>";
      echo "<td><em>$eDetails<br/><br/></em></td>";
      echo "</tr>";
      echo "</table>";
    }
  
  } else {
    
    echo "<table style='position: relative; top: -10px;'>";
    echo "<tr>";
    echo "<td><em>No Event(s) as of the moment.</em></td>";
    echo "</tr>";
    echo "</table>";
  }
  
?>