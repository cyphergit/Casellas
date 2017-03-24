<?php 
include('conf.inc.php');

$articleID = $_GET['aid'];

$sql = "SELECT ArticleID
            , ArticleTitle
            , ArticleContent
            , ArticleAuthor
            , DATE_FORMAT(DatePublished,'%M %d, %Y') 
        FROM NewsletterArticle WHERE ArticleID = '$articleID' AND STATUS = '1' LIMIT 1"; 

$rs = mysql_query($sql);

$num_rows = mysql_num_rows($rs);

$row = mysql_fetch_array($rs);

$title = $row[1];
$content = $row[2];
$author = $row[3];
$date_published = $row[4];
?>
<div id="con-home">
  <div id="content-left-wrapper">
    <div id="content-left">
      <?php        
        if ($num_rows == 0) {
          
          echo "<h1>We’re sorry, but the page you requested could not be found.</h1>";
          
        } else {
          
          echo "<h1>$title</h1>";
          echo "<p style='font-size: 11px; font-style: italic; text-transform: capitalize;'>";
          echo "By: $author<br/>";
          echo "$date_published";
          echo "</p>";
          echo "<p style='text-align: justify;'>$content</p>";
        }
      ?>
      <?php include('includes/cypher_content_contact.php');?>
    </div>
    <?php include('includes/cypher_footer.php');?>
  </div>
</div>