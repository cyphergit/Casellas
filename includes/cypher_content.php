<?php
if (isset($_GET['pg']) && $_GET['pg'] != "") 
{
  $pg = $_GET['pg'];
  if (file_exists('pages/'.$pg.'.php')) 
{
  @include ('pages/'.$pg.'.php');
} 
  elseif (!file_exists('pages/'.$pg.'.php')) 
{
  echo "<div style='margin-top: 50px; text-align: center;'>";
  echo "<h1>We’re sorry, but the page you requested could not be found.</h1>";
  echo "</div>";
}
} 
  else 
  {
  @include ('pages/home.php');
  }
?>