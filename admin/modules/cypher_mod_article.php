<script type="text/javascript">
    function validateForm(cypherArticleForm) {

        if (document.cypherArticleForm.txtATitle.value == "") {
            alert("Please provide a title for your Article!");
            document.cypherArticleForm.txtATitle.focus();
            return false;
        }
            
        if (document.cypherArticleForm.txtAAuthor.value == "") {
            alert("Please provide an author for your Article!");
            document.cypherArticleForm.txtAAuthor.focus();
            return false;
        }            
            
        //if (document.cypherArticleForm.txtAContent.value == "") {
        //    alert("Please provide a content for your Article!");
        //    document.cypherArticleForm.txtAContent.focus();
        //    return false;
        //}
            
        return true;
    }
        
</script>
<?php
$p = $_GET['p'];
$recID = $_GET['rec'];

$q = "SELECT * FROM NewsletterArticle WHERE ArticleID = '$recID'";
$rs = mysql_query($q);
$row = mysql_fetch_array($rs);

if ($p == 'c') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>New</legend>
                <div id="crudForm">
                    <form id="cypherArticleForm" name="cypherArticleForm" method="POST" action="common/q_articles.php" onsubmit="return validateForm(this);">
                        <p>
                            Please fill-up the required fields (<span class="requiredField">*</span>) below.
                        </p>
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>Title:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtATitle" name="txtATitle" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Author:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtAAuthor" name="txtAAuthor" class="cypher-FormField"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Content:</label>
                                </td>
                                <td>
                                    <textarea id="txtAContent" name="txtAContent" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;"></textarea>
                                    <!--<span class="requiredField">*</span>-->
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="Process" name="Process" value="Add"/>
                        <div class="form_buttons">
                            <input id="cypher-Submit" type="Submit" value="Save" class="module-buttons"/>
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "articles", "Cancel"); ?>
                            <input id="reset" type="reset" value="Reset" class="module-buttons"/>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} elseif ($p == 'u') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>Update</legend>
                <div id="crudForm">
                    <form id="cypherArticleForm" name="cypherArticleForm" method="POST" action="common/q_articles.php" onsubmit="return validateForm(this);">
                        <p>
                            Please fill-up the required fields (<span class="requiredField">*</span>) below.
                        </p>
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>Title:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtATitle" name="txtATitle" class="cypher-FormField" value="<?php echo stripslashes($row[ArticleTitle]); ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Author:</label>
                                </td>
                                <td>
                                    <input type="text" id="txtAAuthor" name="txtAAuthor" class="cypher-FormField" value="<?php echo $row[ArticleAuthor]; ?>"/>
                                    <span class="requiredField">*</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Content:</label>
                                </td>
                                <td>
                                    <textarea id="txtAContent" name="txtAContent" col="10" style="height: 150px; width: 500px; border: solid 1px Gray; padding: 0px 0px 4px 4px;">
                                        <?php echo stripslashes($row[ArticleContent]); ?>
                                    </textarea>
                                    <!--<span class="requiredField">*</span>-->
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="EntryID" name="EntryID" value="<?php echo $row['ArticleID'] ?>"/>
                        <input type="hidden" id="Process" name="Process" value="Update"/>
                        <div class="form_buttons">
                            <input id="cypher-Submit" type="Submit" value="Update" class="module-buttons"/>
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "articles", "Cancel"); ?>
                            <input id="reset" type="reset" value="Reset" class="module-buttons"/>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
} elseif ($p == 'v') {
    ?>
    <div class="dataForm-wrapper">
        <div class="dataForm">
            <fieldset>
                <legend>View</legend>
                <div id="crudForm">
                    <form id="cypherArticleForm" name="cypherArticleForm">
                        <table>
                            <tr>
                                <td class="label-fields">
                                    <label>Title:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo stripslashes($row[ArticleTitle]); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Author:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo $row[ArticleAuthor]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-fields">
                                    <label>Content:</label>
                                </td>
                                <td class="item-field">
                                    <?php echo stripslashes($row[ArticleContent]); ?>
                                </td>
                            </tr>
                        </table>        
                        <div class="form_buttons">
                            <?php moduleUpdate("../admin/index.php?pg=", "", "module-buttons", "", "articles", "Edit", $recID); ?> | 
                            <?php moduleCancel("../admin/index.php?pg=", "", "module-buttons", "", "articles", "Back"); ?>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
    <?php
}
?>