<form id="cypherVIPForm" name="cypherVIPForm" class="cypherVIPForm" method="POST" action="">
    <div class="table">
        <div class="table-row">
            <div class="row-label">
                <label>First name: <span class="vip-requiredField">*</span></label>                
            </div>
            <div class="row-field">
                <input type="text" id="txtVipFname" name="txtVipFname" title="First name" class="cypher-VIPField"/>                
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Last name: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtVipLname" name="txtVipLname" title="Last name" class="cypher-VIPField"/>                
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Email Address: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtVipEmail" name="txtVipEmail" title="Email Address" class="cypher-VIPField"/>                
            </div>            
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Address: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-address">
                <input type="text" id="txtVipAddStreet" name="txtVipAddStreet" title="Street" class="cypher-VIPField"/>                
                <input type="text" id="txtVipAddCity" name="txtVipAddCity" title="City" class="cypher-VIPField"/>                
                <input type="text" id="txtVipAddState" name="txtVipAddState" title="State" class="cypher-VIPField"/>                
                <input type="hidden" id="txtVipAddCountry" name="txtVipAddCountry" class="cypher-VIPField"/>                
                <input type="text" id="txtVipAddPostal" name="txtVipAddPostal" title="Postal Code" class="cypher-VIPField"/>                
            </div>
        </div>
        <div class="table-row">
            <div class="row-label"><label>Contacts:</label></div>
            <div class="row-address">
                <input type="text" id="txtVipMobile" name="txtVipMobile" title="Mobile" class="cypher-VIPField"/>
                <input type="text" id="txtVipLandline" name="txtVipLandline" title="Landline" class="cypher-VIPField"/>                
            </div>
        </div>
        <div class="table-row">
            <div class="row-label">
                <label>Date of Birth: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input type="text" id="txtVipBirthDate" name="txtVipBirthDate" title="Birth Date" class="cypher-VIPField"/>                
            </div>
        </div>
        <div class="table-row">
            <div class="row-label"><label>Have you dined with us before?</label></div>
            <div class="row-field">
                <select id="selVipDined" name="selVipDined" class="cypher-VIPField">
                    <option value="0">Please select...</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="table-row-hidden">
            <div class="row-label"><label>How did you rate your experience?</label></div>
            <div class="row-field">
                <select id="selVipExpRate" name="selVipExpRate" class="cypher-VIPField">
                    <option value="0">Please select...</option>
                    <?php
                    for ($r = 1; $r <= 10; $r++) {
                        echo "<option value='$r'>$r</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="table-row-hidden">
            <div class="row-label"><label>Would you recommend us?</label></div>
            <div class="row-field">
                <select id="selVipRecommend" name="selVipRecommend" class="cypher-VIPField">
                    <option value="0">Please select...</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <br/>                
                <input type="text" id="taVipRecommend" name="taVipRecommend" title="Will you tell us why...?" class="cypher-VIPField"/>
<!--                <textarea id="taVipRecommend" name="taVipRecommend"></textarea>-->
            </div>
        </div>
<!--        <div class="table-row">
            <div class="row-label">
                <label>Enter Code: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field">
                <input  id="6_letters_code" name="6_letters_code" class="form-field" type="text" title="Provide Code Below"/><br/>
                    <img src="modules/cypher_mod_captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' style="border: solid 1px #000;"/><br/>
                    <small>Can't read the image? click <a href='javascript: refreshCaptcha();' style="color: yellow">here</a> to refresh</small>
            </div>
        </div>-->
        <div class="table-row">
            <div class="row-label">
                <label>reCaptcha: <span class="vip-requiredField">*</span></label>
            </div>
            <div class="row-field recaptcha-section">
                <div class="g-recaptcha" data-sitekey="6LfrFRIUAAAAAAh6ND-n7VyOPEMcwObpS7RzwsEJ"></div>
            </div>            
        </div>          
        <div class="table-row">
            <div></div>
            <div style="padding: 0px 5px 0px 5px;">
                <div id="cypherVIPSubmit" class="vip-register-button">Register</div>
            </div>
        </div>
    </div>
    <?php include('includes/cypher_fancynotif.php'); ?>
</form>