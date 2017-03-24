<?php
  if($_SESSION['logged'] == 1) {
  
    echo "<a href='http://localhost/Panuccio/admin/common/f_logout.php' class='cypherLogs'>Logout</a>";
    
  } else {
  
    echo "<a href='#' title='Login'>Login</a>";
    echo "<a href='#' class='cypherLogs' title='Register'>Register</a>";
    
  }
?>
