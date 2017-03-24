<html>
<head>
<link href="DialogForm.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript">
    function addRow() {
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
        element1.style.margin = "0px 0px 0px 0px";
        element1.style.border = "solid 1px #222";
        element1.style.width = "358px";            
        cell1.appendChild(element1);

        getLastRow();
    }
  
    function deleteRow(i) {
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
  
    function throwValue() {
        var table = document.getElementById('articleTable');
        i = table.rows.length;

        document.getElementById('txtArticle' + i).value = document.getElementById('selNList').value;
    }
    
    function getLastRow() {
        
        var table = document.getElementById('articleTable');
        var rowCount = table.rows.length;

        document.getElementById('icounter').value = rowCount;
        
    }
    
    function ConfirmationMsg() {
    
			  alert("Newsletter has been updated.");
			  window.opener.location.href = window.opener.location.href;

			  if (window.opener.progressWindow) {
				  window.opener.progressWindow.close()
			  }
        
			  window.close();
        
		}
  
    function ClosePopUp() {
    
        window.close();
        
    }
  
    function SubmitForm() { 
    
		document.UpdateForm.submit();
        ConfirmationMsg();
          
    }    
</script>
<title>Newsletter</title>
</head>
<body onload="getLastRow();">
<?php
  include("../../conf.inc.php");
  $tempID = $_COOKIE['IDValue'];
  $process = $_COOKIE['Process'];
  
  $q = "SELECT 
          NewsletterName
        FROM 
          Newsletter
        WHERE 
          NewsletterID = '$tempID'";
          
  $rs = mysql_query($q);
  $row = mysql_fetch_array($rs);
 
  $NewsletterTitle = $row[0];

  if ($process == "View") {
  
    echo "<div class='DialogForm'>";
	echo "<h4>Newsletter Content</h4>";
    echo "<div class='DialogFormContent'>";
    echo "<div><span class='itemfield'>Newsletter Title:</span><span class='v-field'> <em>$NewsletterTitle</em><span></div>";
	echo "<br/>";
    echo "<div><span class='itemfield'>Content (Articles Included):</span></div>";
	echo "<br/>";
    
    $q_content = "SELECT NewsletterItem.Title                           
                  FROM NewsletterItem 
                  WHERE NewsletterItem.NewsletterID = '$tempID'";
                  
    $rs_content = mysql_query($q_content);
    $content_count = mysql_num_rows($rs_content);
    
    if ($content_count == 0) {
    
        echo "<div id='contentItems'>";
        echo "<li><span class='noDataFetch'>no content(s) yet</span></li>";
        echo "</div>";  
      
    } else {
        
        echo "<div id='contentItems'>";
                
        while($row = mysql_fetch_array($rs_content))
		    { 
          $nItems=$row[0];
		      $i=$i+1;
          echo "<div class='v-field'>$i.)<em> $nItems</em></div>";
			  }
        
        echo "</div>";  
        
    }
    echo "</div>";
    echo "</div>";
    echo "<div class='DialogFormClose'><a href='#' onclick=\"ClosePopUp();\">Close Window</a></div>";  
  
  } else {
  
      $q_article = "SELECT ArticleTitle FROM NewsletterArticle WHERE Status = '1' ORDER BY ArticleID";                  
      $rs_article = mysql_query($q_article);
      
      $q_icount = "SELECT Title FROM NewsletterItem WHERE NewsletterID = '$tempID'";                  
      $rs_icount = mysql_query($q_icount); 
      $c_icount = mysql_num_rows($rs_icount);
      
      echo "<form id='UpdateForm' name='UpdateForm' method='POST' action='../common/q_newsletters.php'>";
	  echo "<div class='DialogForm'>";
	  echo "<h4>Update Newsletter Content</h4>";
      echo "<div class='DialogFormContent'>";      
      echo "<table>";
      echo "<tr>";
      echo "<td class='itemfield'>Newsletter Title:</td>";
      echo "<td><input type='text' id='txtNTitle' name='txtNTitle' class='DialogEntry' value='$NewsletterTitle'/></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Article List:</td>";
      echo "<td>";
      echo "<select class='DialogEntry' id='selNList' name='selNList' onchange='throwValue();'>";
      echo "<option>[Select an Article]</option>";
        while($nrow = mysql_fetch_array($rs_article))
        { 
          $nVal = $nrow[0];
          echo "<option value='$nVal'>$nVal</option>";
        }
      echo "</select>";
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='itemfield'>Content:</td>";
      echo "<td></td>";
      echo "</tr>";
      echo "</table>";      
      echo "<div id='itemsCRUD'>";
      echo "<a onclick=\"addRow();\">Add an Article</a> | ";
      echo "<a onclick=\"deleteRow();\">Remove an Article</a>";			                
      echo "</div>";
        if ($c_icount == 0) {
          echo "<div>";
          echo "<table id='articleTable'>";
          echo "<tr>";
          echo "<td>";
          echo "<input class='DialogSubEntry2' type='text' id='txtArticle1' name='txtArticle1'/>";
          echo "</td>";
          echo "</tr>";
          echo "</table>";
          echo "</div>";
        } else {
          echo "<div>";
          echo "<table id='articleTable'>";
            while($arow = mysql_fetch_array($rs_icount))
            { 
              $aVal = $arow[0];
              $i=$i+1;
              echo "<tr>";
              echo "<td>";
              echo "<input class='DialogSubEntry2' type='text' id='txtArticle$i' name='txtArticle$i' value='$aVal'/>";
              echo "</td>";
              echo "</tr>";
            }
          echo "</table>";
          echo "</div>";
        }
      echo "<input type='hidden' name='icounter' id='icounter' />";
	  echo "<input type='hidden' id='Process' name='Process' value='Update'/>";
      echo "<div class='DialogFormClose'>";
      echo "<a onclick=\"SubmitForm();\" alt='Update Entry'>Update Entry</a> | ";
      echo "<a onclick=\"ClosePopUp();\" alt='Close'>Close Window</a>";
      echo "</div>";
      echo "<input type='hidden' id='EntryID' name='EntryID' value='$tempID'/>";
      echo "</form>";    
  
  }  
?>
</body>
</html>  