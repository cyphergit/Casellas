<div id="con-events">
  <div id="content-left-wrapper">
    <div id="content-left">
      <h1>Events</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce fermentum tincidunt nunc,
        in euismod massa ultrices eget. Donec in ultrices odio. Donec ac lorem ut nibh viverra vulputate id in lectus.
        Donec gravida mi in diam euismod sed convallis felis lobortis.
        Vivamus nisi est, suscipit nec luctus et, cursus sit amet eros. Sed dictum sollicitudin facilisis.
        Vivamus sit amet ullamcorper lectus. Quisque iaculis augue ipsum, ut rutrum sapien.
      </p>
      <?php
        include('conf.inc.php');
          
        $sql = "SELECT EventTitle, EventDate, EventVenue, EventDesc FROM Events ORDER BY EventDate ASC";
          
        $num_rows = mysql_num_rows($sql);
          
        $rs = mysql_query($sql);
          
        if (mysql_num_rows($rs) > 0) {
    
          echo "<div id='paging'>";
  
            while($row = mysql_fetch_array($rs))
	          { 
              $eTitle = $row[0];
              $eDate  = $row[1];
              $eVenue = $row[2];
              $eDesc  = $row[3];
          
              echo "<p>";
	            echo "<em>What: <b>$eTitle</b></em><br/>";
              echo "<em>When: <b>$eDate</b></em><br/>";
              echo "<em>Where: <b>$eVenue</b></em><br/><br/>";
              echo "<em>Event Details:</em><br/><br/>";
              echo "<em>$eDesc</em><br/>";
              echo "</p>";
            }
  
          echo "</div>";
  
        } else {
            echo "<p><em>No scheduled event(s) as of the moment.</em></p>";
        }
      ?>
      <?php include('includes/cypher_content_contact.php');?>
    </div>
    <?php
      include('includes/cypher_footer.php');
    ?>
  </div>
</div>