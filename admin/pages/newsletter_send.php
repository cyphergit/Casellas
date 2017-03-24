<?php include 'includes/cypher_log_restrict.php'; ?>

<table id="cypher-store-table">
    <tr>
        <td class="cypher-store-left">
            <div class="v-menu">
                <?php include('includes/cypher_vmenu.php'); ?>
            </div>
        </td>
        <td class="cypher-store-right">
            <div id="con-admin">
                <h2>Newsletters</h2>
                <div id="crudControl">
                    <a href="index.php?pg=newsletter_create">Add Newsletter</a> |
                    <a href="index.php?pg=newsletter_send">Send Newsletter</a>
                    <div style="float: right;">
                        <a href="index.php?pg=newsletter">Newsletter Listing</a> |
                        <a href="index.php?pg=articles">Articles</a> |
                        <a href="index.php?pg=newsletter_image">Images</a>
                        <!--<a href="#">Images</a>-->
                    </div>
                </div>
                <div class="dataForm-wrapper" style="margin-top: 16px;">
                    <div class="dataForm">
                        <fieldset>
                            <legend>Issue Monthly Newsletter</legend>
                            <div id='crudForm'>
                                <?php include('modules/cypher_mod_newslettersend.php'); ?>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>