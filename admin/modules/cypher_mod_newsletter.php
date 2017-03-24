<script type="text/javascript">
  function validateForm(cypherNewsletterForm) {
      if (document.cypherNewsletterForm.txtNTitle.value == "") {
          alert("Please enter your E-mail Address!");
          document.cypherNewsletterForm.txtNTitle.focus();
          return false;
      }

      return true;
  }

  function getLastRow() {
      var table = document.getElementById('articleTable');
      var rowCount = table.rows.length;

      document.getElementById('icounter').value = rowCount;
  }

  function throwValue() {
      var table = document.getElementById('articleTable');
      i = table.rows.length;

      document.getElementById('txtArticle' + i).value = document.getElementById('selNList').value;
  }

  function removeArticle(i) {
      var table = document.getElementById('articleTable');
      var rowCount = table.rows.length;

      i = rowCount - 1;

      if (i == 0) {
        alert("Minimum Entry Reached.");
        return false;
      }

      table.deleteRow(i);

      getLastRow();
  }

  function addArticle() {
      var table = document.getElementById('articleTable');
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      if (rowCount >= 5) {
          alert("Entries Exceeded. Only 5 entries are allowed.");
          return false;
      }

      iteration = rowCount;
      iteration = iteration + 1;

      var cell1 = row.insertCell(0);
      var element1 = document.createElement("input");
      element1.selectedIndex = 0;
      element1.name = 'txtArticle' + iteration;
      element1.id = 'txtArticle' + iteration;
      element1.setAttribute('style','margin: 4px 0px 4px 0px; padding: 2px; border: solid 1px gray; width: 255px;');
      element1.setAttribute('class','cypher-FormThrowField');
      cell1.appendChild(element1);

      getLastRow();
  }

  $(document).ready(function(){
      getLastRow();

      $('.cypher-FormThrowField').click(function(){
          var throwFieldID = $(this).attr('id');
          $('#throwField').val(throwFieldID);
      });
  });

</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

if ($p == 'c') {
?>
<div class="dataForm-wrapper">
<div class="dataForm">
  <fieldset>
    <legend>Create New Newsletter</legend>
    <div id="crudForm">
      <form id="cypherNewsletterForm" name="cypherNewsletterForm" method="POST" action="common/q_newsletters.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Newsletter Title:</label>
            </td>
            <td>
              <input type="text" id="txtNTitle" name="txtNTitle" class="cypher-FormField"/>
              <span class="requiredField">*</span>
            </td>
          </tr>
        </table>
        <input type="hidden" id="Process" name="Process" value="Add"/>
        <div class="form_buttons">
            <input id="cypher-Submit" type="Submit" value="Save" class="module-buttons"/>
            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "newsletter", "Cancel");?>
          <input id="reset" type="reset" value="Reset" class="module-buttons"/>
        </div>
      </form>
    </div>
  </fieldset>
</div>
</div>
<?php
} elseif ($p == 'u') {
  $q = "SELECT * FROM Newsletter WHERE NewsletterID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);

  $nID = $row[0];
?>
<div class="dataForm-wrapper">
<div class="dataForm">
  <fieldset>
    <legend>Update Newsletter</legend>
    <div id="crudForm">
      <form id="cypherNewsletterForm" name="cypherNewsletterForm" method="POST" action="common/q_newsletters.php" onsubmit="return validateForm(this);">
        <p>
          Please fill-up the required fields (<span style="color: red;">*</span>) below.
        </p>
        <table>
          <tr>
            <td class="label-fields">
              <label>Newsletter Title:</label>
            </td>
            <td>
                <?php
                $newsletterName = stripslashes($row[NewsletterName]);
                $newsletterId = stripslashes($row[NewsletterID]);

                echo "<input type='text' id='txtNTitle' name='txtNTitle' class='cypher-FormField' value='$newsletterName'/>";
                echo "<input type='hidden' id='txtNTID' name='txtNTID' class='cypher-FormField' value='$newsletterId'/>";
                ?>
              <span class="requiredField">*</span>
            </td>
          </tr>
          <tr>
            <td  class="label-fields" colspan ="2" style="vertical-align: top;">
              <label>Contents (Current Articles Included):</label>
            </td>
          </tr>
          <tr class="itemsCRUD-header">
            <td class="label-fields">
              <label style="color:#482819;">Select An Article:</label>
            </td>
            <td>
              <?php
                $q_article = "SELECT ArticleTitle FROM NewsletterArticle WHERE Status = '1' ORDER BY ArticleID";
                $rs_article = mysql_query($q_article);

                echo "<select id='selNList' name='selNList' onchange='throwValue();' style='border: solid 1px Gray; padding: 2px 2px 2px 2px; width: 260px;'>";
                echo "<option>[Select an Article]</option>";
                  while($nrow = mysql_fetch_array($rs_article))
                  {
                    $nVal = $nrow[0];
                    echo "<option value='$nVal'>$nVal</option>";
                  }
                echo "</select>";
              ?>
            </td>
          </tr>
          <tr class="itemsCRUD-content">
            <td colspan="2">
              <div id="itemsCRUD">
                <a onclick="addArticle();">Add an Article</a> |
                <a onclick="removeArticle();">Remove an Article</a>
              </div>
              <?php
                $q_icount = "SELECT Title FROM NewsletterItem WHERE NewsletterID = '$nID'";
                $rs_icount = mysql_query($q_icount);
                $c_icount = mysql_num_rows($rs_icount);

                if ($c_icount == 0) {
              ?>
              <div id="itemsContent">
                <table id="articleTable">
                  <tr>
                    <td>
                      <input type='text' id='txtArticle1' name='txtArticle1' class='cypher-FormThrowField'/>
                    </td>
                  </tr>
                </table>
              </div>
              <?php
                } else {
              ?>
              <div id="itemsContent">
                <table id='articleTable'>
                  <?php
                    while($arow = mysql_fetch_array($rs_icount))
                    {
                      $aVal = $arow[0];
                      $i=$i+1;
                      echo "<tr>";
                      echo "<td>";
                      echo "<input type='text' id='txtArticle$i' name='txtArticle$i' value='$aVal' class='cypher-FormThrowField'/>";
                      echo "</td>";
                      echo "</tr>";
                    }
                  ?>
                </table>
              </div>
              <?php
              }
              ?>
            </td>
          </tr>
        </table>

        <input type="hidden" id="throwField" name="throwField"/>
        <input type="hidden" id="icounter" name="icounter"/>
        <?php echo "<input type='hidden' id='EntryID' name='EntryID' value='$nID'/>";?>
        <input type="hidden" id="Process" name="Process" value="Update"/>
        <div class="form_buttons">
            <input id="cypher-Submit" type="Submit" value="Update" class="module-buttons"/>
            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "newsletter", "Cancel");?>
          <input id="reset" type="reset" value="Reset" class="module-buttons"/>
        </div>
      </form>
    </div>
  </fieldset>
</div>
</div>
<?php
} elseif ($p == 'v') {
  $q = "SELECT * FROM Newsletter WHERE NewsletterID = '$recID'";
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
?>
<div class="dataForm-wrapper">
  <div class="dataForm">
    <fieldset>
      <legend>View</legend>
      <div id="crudForm" style="margin: 16px 0px 0px 0px;">
        <form id="cypherNewsletterForm" name="cypherNewsletterForm">
          <table>
            <tr>
              <td class="label-fields">
                <label>Newsletter Title:</label>
              </td>
              <td class="item-field">
                <?php echo stripslashes($row[NewsletterName]);?>
              </td>
            </tr>
            <tr>
              <td class="label-fields" style="vertical-align: top;">
                <label>Article Titles &amp; Contents:</label>
              </td>
              <td style="width: 85%;">
                <div id="article-list">
                  <?php
                $c_q = "SELECT * FROM NewsletterItem WHERE NewsletterID = '$recID'";
                $c_rs = mysql_query($c_q);

                while($c_row = mysql_fetch_array($c_rs)) {

                  $articleTitle = $c_row[3];

                  $a_q = "SELECT * FROM NewsletterArticle WHERE ArticleTitle = '$articleTitle'";
                  $a_rs = mysql_query($a_q);
                  $a_row = mysql_fetch_array($a_rs);
                  ?>

                  <h3 class="article-title">
                    <?php echo stripslashes($articleTitle);?>
                  </h3>
                  <div>
                    <div class="article-list-signature">
                      Written By: <?php echo stripslashes($a_row[ArticleAuthor]);?><br/>
                      Date Published: <?php echo stripslashes($a_row[DatePublished]);?>
                    </div>
                    <p class="article-content">
                      <?php echo stripslashes($a_row[ArticleContent]);?>
                    </p>
                    <div class="article-list-link">
                        <?php moduleUpdate('../admin/index.php?pg=', '', '', '', 'articles', 'Edit', $a_row[0]);?>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </td>
            </tr>
          </table>
          <div class="form_buttons">
            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "newsletter", "Back");?>
          </div>
        </form>
      </div>
    </fieldset>
  </div>
</div>
<?php
}
?>