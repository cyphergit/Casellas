<p>
    Please fill in the form below. <u>ALL</u> fields are required. If not applicable simply put "N.A" in the field.
</p>
<form id="cypherEnquiryForm" name="cypherEnquiryForm" method="POST" action="common/f_sendenquiry.php">
    <div id="form-style">
        <table>
            <tr>
                <td class="col-label">First Name: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtFirstname" name="txtFirstname" class="form-field" type="text"/>
                </td>
            </tr>
            <tr>
                <td class="col-label">Last Name: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtLastname" name="txtLastname" class="form-field" type="text"/>
                </td>
            </tr>
            <tr>
                <td class="col-label">Contact No.: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtContact" name="txtContact" class="form-field" type="text"/>
                </td>
            </tr>
            <tr>
                <td class="col-label">Email Address: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtEmail" name="txtEmail" class="form-field" type="text"/>
                </td>
            </tr>
            <tr>
                <td class="col-label">Subject: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtSubject" name="txtSubject" class="form-field" type="text" value="Casellas Wine - Tapas - Grill - Online Enquiry"/>
                </td>
            </tr>
            <tr>
                <td class="col-label">Enquiry Reason: <span class="vip-requiredField">*</span></td>
                <td>
                    <select id="selReason" name="selReason" class="form-field" style="width: 255px;">
                        <option value="0">Please select a reason</option>
                        <option value="General Enquiry">General Enquiry</option>
                        <option value="Reservation">Reservation</option>
                    </select>
                </td>
            </tr>
            <tr class="r-field">
                <td class="col-label">Reservation Date: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtRDate" name="txtRDate" class="form-field" type="text"/>
                </td>
            </tr>
            <tr class="r-field">
                <td class="col-label">Time: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtTime" name="txtTime" class="form-field" type="text"/>
                </td>
            </tr>
            <tr class="r-field">
                <td class="col-label">Number of Guest: <span class="vip-requiredField">*</span></td>
                <td>
                    <input id="txtGuest" name="txtGuest" class="form-field" type="text"/>
                </td>
            </tr>
            <tr>
                <td class="col-label">Message: <span class="vip-requiredField">*</span></td>
                <td>
                    <textarea id="txtMessages" name="txtMessages" class="form-field" style="height: 50px;"></textarea>
                </td>
            </tr>
            <tr>
                <td class="col-label">Recaptcha code: <span class="vip-requiredField">*</span></td>
                <td>
                    <input  id="6_letters_code" name="6_letters_code" class="form-field" type="text"/><br/>
                    <img src="modules/cypher_mod_captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' style="border: solid 1px #000;"/><br/>
                    <small>Can't read the image? click <a href='javascript: refreshCaptcha();' style="color: yellow">here</a> to refresh</small>
                </td>
            </tr>
        </table>
    </div>
    <div class="subscription-option">
        <div>
            <input type="checkbox" id="chkNewsletter" name="chkNewsletter"/>
        </div>
        <div>
            <span>Subscribe to our Newsletter for updates of Casellas Wine - Tapas - Grill.</span>
        </div>
    </div>
    <input type="hidden" id="txtNewsletter" name="txtNewsletter" value="0" />
    <div class="crudForm">
        <div>
            <input type="submit" id="submitEnquiry" name="submit" class="enquiryButton" value=""/>
        </div>
        <div>
            <input type="button" id="cancelEnquiry" name="cancel" class="cancelButton" value=""/>
        </div>
        <div>
            <input type="button" id="closeEnquiry" name="close" class="closeButton" value=""/>
        </div>
    </div>
</form>