<form id="cypherEnquiryForm" class="cypherVIPForm" name="cypherEnquiryForm" method="POST" action="">
    <div class="table">
        <div class="table-row">
            <div class="row-label">
                <label>First Name: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtFirstname" name="txtFirstname" title="First name" class="cypher-VIPField"/>
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Last Name: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtLastname" name="txtLastname" title="Last name" class="cypher-VIPField"/>
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Contact No.: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtContact" name="txtContact" title="Contact No" class="cypher-VIPField"/>
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Email Address: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtEmail" name="txtEmail" title="Email" class="cypher-VIPField"/>
            </div>
        </div>          
        <div class="table-row">
            <div class="row-label">
                <label>Subject: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">                
                <?php 
                //Subject for reservation or enquiry
                $subject = "Casellas Wine - Tapas - Grill - ";
                if ($_GET['pg'] == "reservation") {
                    $subject = $subject . "Online Reservation";
                } else {
                    $subject = $subject . "Online Enquiry";
                }
                ?>
                <input type="text" id="txtSubject" name="txtSubject" title="Subject" value="<?php echo $subject; ?>" class="cypher-VIPField"/>
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Reason: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">                
                <?php 
                //Select reservation or enquiry
                if ($_GET['pg'] == "reservation") { 
                    $reason = "Reservation";
                } else {
                    $reason = "General Enquiry";
                }
                ?>
                <input type="text" id="selReason" name="selReason" title="Reason" class="cypher-VIPField" value="<?php echo $reason;?>"/>
            </div>
        </div>
        <?php 
        //Reservation
        if ($_GET['pg'] == "reservation") { 
        ?>        

        <div class="table-row">
            <div class="row-label">
                <label>Reservation Date: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtRDate" name="txtRDate" title="Reservation Date" class="cypher-VIPField"/>
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Time: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtTime" name="txtTime" title="Reservation Time" class="cypher-VIPField"/>
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Number of Guest: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtGuest" name="txtGuest" title="Guest" class="cypher-VIPField"/>
            </div>
        </div>
        
        <?php } ?>
        
        <div class="table-row">
            <div class="row-label">
                <label>Message: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <textarea id="txtMessages" name="txtMessages" style="height: 50px;" title="Message" class="cypher-VIPField"></textarea>
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label><span>Subscribe to our newsletter for updates.</span></label>
            </div>
            <div class="row-field">
                <input type="checkbox" id="chkNewsletter" name="chkNewsletter"/>
                <input type="hidden" id="txtNewsletter" name="txtNewsletter" value="0" />
            </div>
        </div> 
        <div class="table-row">
            <div class="row-label">
                <label>reCaptcha: <span class="vip-requiredField">*</span></label>
            </div>            
            <div class="row-field recaptcha-section">
                <div class="g-recaptcha" data-sitekey="6LfrFRIUAAAAAAh6ND-n7VyOPEMcwObpS7RzwsEJ"></div>
            </div>            
        </div> 
    </div>       
    <div class="table-row">
        <div></div>
        <div style="padding: 0px 5px 0px 5px;">
            <div id="submitEnquiry" class="vip-register-button">Submit</div>
        </div>
    </div>
    <?php include('includes/cypher_fancynotif.php'); ?>
</form>