        <!-- Enquiry-->
        <div id="enquiry-container">
            <div id="enquiry-form-wrapper">
                <div id="enquiry-title"></div>
                <?php include 'modules/cypher_mod_enquiry.php'; ?>
            </div>
        </div>
        <!-- Recaptcha-->
        <script language='JavaScript' type='text/javascript'>
            function refreshCaptcha() {
                var img = document.images['captchaimg'];
                img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
            }
        </script>
        