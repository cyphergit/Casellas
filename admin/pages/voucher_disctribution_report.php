<?php include 'includes/cypher_log_restrict.php'; ?>

<div id="con-admin">
    <h2>Vouchers</h2>
    <div id="crudControl">
        <a href="index.php?pg=voucher&amp;p=c">Add Vouchers</a> |
        <a href="index.php?pg=voucher_disctribute">Distribute Voucher</a>
        <div style="float: right;">
            <a href="index.php?pg=voucher_distribution_report">Reports</a> |
            <a href="index.php?pg=voucher">Voucher Listing</a>
        </div>
    </div>
    <div class="dataForm-wrapper" style="margin-top: 16px;">
        <div class="dataForm">
            <fieldset>
                <legend>Distribute Vouchers</legend>
                <div id='crudForm'>
                    <?php include('modules/cypher_mod_newslettersend.php'); ?>
                </div>
            </fieldset>
        </div>
    </div>
</div>