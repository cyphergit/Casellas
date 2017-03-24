<?php $d = $_GET['d']; ?>

<div class="dataForm-wrapper">
    <div class="dataForm">
        <fieldset>
            <legend>All Reports</legend>
            <div id="crudForm">
                <forms id="cypherReportForm" name="cypherReportForm">
                    <?php if ($d == 'a') { ?>
                        <div>
                            <div class="spacer"></div>

                            <div class="label-fields"><em>NEWSLETTERS</em></div>
                            <div class="label-fields">
                                <a href="pages/view_report.php?r=nc" target="_blank">
                                    View Current distributed Newsletters to members
                                </a>                                
                            </div>
                            <div class="label-fields">
                                <a href="pages/view_report.php?r=np" target="_blank">
                                    View Previous distributed Newsletters to members
                                </a>                                      
                            </div>
                            <div class="date-range-n">
                                <div>
                                    <span class="date-label-fields">Date from:</span>
                                    <input type="text" id="n-date-from" name="n-date-from" class="cypher-FormField date-range-fields"/>
                                </div>
                                <div>
                                    <span class="date-label-fields">Date to:</span>
                                    <input type="text" id="n-date-to" name="n-date-to" class="cypher-FormField date-range-fields"/>
                                </div>
                            </div>
                            <div class="label-fields">
                                <a href="pages/view_report.php?r=nu" target="_blank">
                                    View Undistributed Newsletters to members
                                </a>                                
                            </div>

                            <div class="spacer"></div>

                            <div class="label-fields"><em>VOUCHERS</em></div>
                            <div class="label-fields">
                                <a href="pages/view_report.php?r=vc" target="_blank">
                                    View Current distributed Vouchers to members
                                </a>                                
                            </div>
                            <div class="label-fields">View Previous distributed Vouchers to members</div>
                            <div class="date-range-v">
                                <div>
                                    <span class="date-label-fields">Date from:</span>
                                    <input type="text" id="v-date-from" name="n-date-from" class="cypher-FormField date-range-fields"/>
                                </div>
                                <div>
                                    <span class="date-label-fields">Date to:</span>
                                    <input type="text" id="v-date-to" name="n-date-to" class="cypher-FormField date-range-fields"/>
                                </div>
                            </div>
                            <div class="label-fields">
                                <a href="pages/view_report.php?r=vu" target="_blank">
                                    View Undistributed Vouchers to members
                                </a>                                
                            </div>

                            <div class="spacer"></div>
                        </div>
                    <?php } elseif ($d == 'n') { ?>
                        <div>
                            <div class="spacer"></div>

                            <div class="label-fields"><em>NEWSLETTERS</em></div>
                            <div class="label-fields">View Current distributed Newsletters to members</div>
                            <div class="label-fields">View Previous distributed Newsletters to members</div>
                            <div class="date-range-n">
                                <div>
                                    <span class="date-label-fields">Date from:</span>
                                    <input type="text" id="n-date-from" name="n-date-from" class="cypher-FormField date-range-fields"/>
                                </div>
                                <div>
                                    <span class="date-label-fields">Date to:</span>
                                    <input type="text" id="n-date-to" name="n-date-to" class="cypher-FormField date-range-fields"/>
                                </div>
                            </div>
                            <div class="label-fields">View Undistributed Newsletters to members</div>

                            <div class="spacer"></div>
                        </div>
                    <?php } elseif ($d == 'v') { ?>
                        <div>
                            <div class="spacer"></div>

                            <div class="label-fields"><em>VOUCHERS</em></div>
                            <div class="label-fields">
                                <a href="pages/view_report.php?r=vc" target="_blank">
                                    View Current distributed Vouchers to members
                                </a>                                
                            </div>
                            <div class="label-fields">View Previous distributed Vouchers to members</div>
                            <div class="date-range-v">
                                <div>
                                    <span class="date-label-fields">Date from:</span>
                                    <input type="text" id="v-date-from" name="n-date-from" class="cypher-FormField date-range-fields"/>
                                </div>
                                <div>
                                    <span class="date-label-fields">Date to:</span>
                                    <input type="text" id="v-date-to" name="n-date-to" class="cypher-FormField date-range-fields"/>
                                </div>
                            </div>
                            <div class="label-fields">View Undistributed Vouchers to members</div>

                            <div class="spacer"></div>
                        </div>
                    <?php } else {
                        
                    } ?>
                </forms>
            </div>
        </fieldset>
    </div>
</div>
