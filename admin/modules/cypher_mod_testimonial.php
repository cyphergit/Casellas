<script type="text/javascript">
  function CancelSubmission() {
    url = sitehost + 'admin/index.php?pg=testimonials';

    location.href = url;
  }
</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

if ($p == 'v') {
  $q = "SELECT * FROM Testimonials WHERE TestimonialID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);  
?>
<div class="dataForm">
  <fieldset>
    <legend>View Testimonials</legend>
    <div id="crudForm">
      <form id="cypherTestimonialForm" name="cypherTestimonialForm">
        <p>
          <?php echo stripslashes($row['TestimonialMsg']);?>
        </p>
        <p>
          From: <?php echo $row['CustomerEmail'];?><br/>
          Date: <?php echo $row['DateCreated'];?>
        </p>
        <div class="form_buttons">
          <input id="cypher-Cancel" type="button" value="Back" onclick="CancelSubmission();"/>          
        </div>
      </form>
    </div>
  </fieldset>
</div>
<?php
} else {}
?>